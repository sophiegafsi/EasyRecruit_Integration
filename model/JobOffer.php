<?php
include_once __DIR__ . '\..\config\config.php';

class JobOffer
{
    private $title;
    private $description;
    private $salary;
    private $experience;
    private $contractType;
    private $vacantJobs;
    private $expirationDate;
    private $recruiterId;
    private $active;
    private $dateAdd;
    private $dateUpd;

    // Constructor
    public function __construct()
    {
    }

    // Getters and Setters
    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getSalary()
    {
        return $this->salary;
    }

    public function getContractType()
    {
        return $this->contractType;
    }

    public function getExperience()
    {
        return $this->experience;
    }

    public function getVacantJobs()
    {
        return $this->vacantJobs;
    }

    public function getExpirationDate()
    {
        return $this->expirationDate;
    }

    public function getRecruiterId()
    {
        return $this->recruiterId;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function getDateAdd()
    {
        return $this->dateAdd;
    }

    public function getDateUpd()
    {
        return $this->dateUpd;
    }

    // Setters
    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setSalary($salary)
    {
        $this->salary = $salary;
    }

    public function setContractType($contractType)
    {
        $this->contractType = $contractType;
    }

    public function setVacantJobs($vacantJobs)
    {
        $this->vacantJobs = $vacantJobs;
    }

    public function setExperience($experience)
    {
        $this->experience = $experience;
    }

    public function setExpirationDate($expirationDate)
    {
        $this->expirationDate = $expirationDate;
    }

    public function setRecruiterId($recruiterId)
    {
        $this->recruiterId = $recruiterId;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }

    public function setDateAdd($dateAdd)
    {
        $this->dateAdd = $dateAdd;
    }

    public function setDateUpd($dateUpd)
    {
        $this->dateUpd = $dateUpd;
    }

    public function getAll()
    {
        $query = "SELECT * FROM job_offer ORDER BY id DESC";
        try {
            $stmt = Config::getConnexion()->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }

    public function search($search = '', $secteur = 0)
    {

        $conditions = '';
        if ($search != '') {
            $conditions .= ' AND j.title LIKE :search';
        }
        if ($secteur != 0) {
            $conditions .= ' AND r.activity_sector = :secteur';
        }


        $query = "
            SELECT j.*, r.company_name, r.website, r.phone, r.email, r.address 
            FROM job_offer j
            INNER JOIN recruiter r ON r.id = j.recruiter_id
            WHERE j.active = 1
            AND j.expiration_date >= CURRENT_DATE
            " . $conditions . "
            ORDER BY j.id DESC";
        try {
            $stmt = Config::getConnexion()->prepare($query);
            // Ajoutez les wildcards % à la variable de recherche
            if ($search != '') {
                $searchParam = '%' . $search . '%';
                $stmt->bindParam(':search', $searchParam, PDO::PARAM_STR);
            }
            if ($secteur != 0) {
                $stmt->bindParam(':secteur', $secteur, PDO::PARAM_STR);
            }
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }

    public function getLast()
    {
        $query = "
            SELECT j.*, r.company_name, r.website, r.phone, r.email, r.address 
            FROM job_offer j
            INNER JOIN recruiter r ON r.id = j.recruiter_id
            WHERE j.active = 1
            AND j.expiration_date >= CURRENT_DATE
            ORDER BY j.id DESC LIMIT 5";
        try {
            $stmt = Config::getConnexion()->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }


    public function getLastActiveJobOffers() {
        $query = "
            SELECT jo.*, e.company_name, u.email, u.phone, u.location
            FROM job_offer jo
            INNER JOIN employers e ON e.user_id = jo.recruiter_id
            INNER JOIN users u ON u.user_id = e.user_id
            WHERE jo.active = 1 AND jo.expiration_date >= CURRENT_DATE
            ORDER BY jo.id DESC
            LIMIT 5";
        try {
            $stmt = Config::getConnexion()->prepare($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }
    
    public function getJobOffersByEmployerId($employerId) {
        $query = "
            SELECT jo.*, e.company_name, u.email, u.phone, u.location
            FROM job_offer jo
            INNER JOIN employers e ON e.user_id = jo.recruiter_id
            INNER JOIN users u ON u.user_id = e.user_id
            WHERE e.user_id = :employerId";
        try {
            $stmt = Config::getConnexion()->prepare($query);
            $stmt->execute(array(':employerId' => $employerId));
            $stmt->execute();
            if (!$stmt->execute()) {
                die('Query execution failed: ' . implode(", ", $stmt->errorInfo()));
            }
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }
    
    public function getJobOfferById($jobOfferId) {
        $query = "
            SELECT jo.*, e.company_name, u.email, u.phone, u.location
            FROM job_offer jo
            INNER JOIN employers e ON e.user_id = jo.recruiter_id
            INNER JOIN users u ON u.user_id = e.user_id
            WHERE jo.id = :jobOfferId";
        try {
            $stmt = Config::getConnexion()->prepare($query);
            $stmt->bindParam(':jobOfferId', $jobOfferId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }
    
    public function getFrontAll()
    {
        $query = "
            SELECT j.*, r.company_name, r.website, r.phone, r.email, r.address 
            FROM job_offer j
            INNER JOIN recruiter r ON r.id = j.recruiter_id
            WHERE j.active = 1
            AND j.expiration_date >= CURRENT_DATE
            ORDER BY j.id DESC";
        try {
            $stmt = Config::getConnexion()->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }

    public function view($id)
    {
        $query = "
            SELECT j.*, r.company_name, r.website, r.phone, r.email, r.address, 
                   r.description AS company_description, r.activity_sector
            FROM job_offer j
            INNER JOIN recruiter r ON r.id = j.recruiter_id
            WHERE j.active = 1
            AND j.id = :id
            AND j.expiration_date >= CURRENT_DATE
            ORDER BY j.id DESC";
        try {
            $stmt = Config::getConnexion()->prepare($query);
            $stmt->execute(array(':id' => $id));
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }

    public function add()
    {
        try {
            // Préparation de la requête SQL
            $sql = "INSERT INTO `job_offer`(`title`, `description`, `experience`, `salary`, `contract_type`, `vacant_jobs`, `expiration_date`, `recruiter_id`, `active`, `date_add`, `date_upd`)
                VALUES(:title, :description, :experience, :salary, :contract_type, :vacant_jobs, :expiration_date, :recruiter_id, :active, :date_add, :date_upd)
                ";

            // Préparation de la requête
            $req = Config::getConnexion()->prepare($sql);

            // Liaison des valeurs aux paramètres
            $req->bindParam(':title', $this->title);
            $req->bindParam(':description', $this->description);
            $req->bindParam(':experience', $this->experience);
            $req->bindParam(':salary', $this->salary);
            $req->bindParam(':contract_type', $this->contractType);
            $req->bindParam(':vacant_jobs', $this->vacantJobs);
            $req->bindParam(':expiration_date', $this->expirationDate);
            $req->bindParam(':recruiter_id', $this->recruiterId);
            $req->bindParam(':active', $this->active);
            $req->bindParam(':date_add', $this->dateAdd);
            $req->bindParam(':date_upd', $this->dateUpd);

            // Exécution de la requête
            $req->execute();

            return true; // Succès de l'ajout
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false; // Échec de l'ajout
        }
    }

    public function update($id)
    {
        try {
            // Préparation de la requête SQL
            $sql = "UPDATE job_offer SET ";
            $updates = [];
            $fields = [
                'title',
                'description',
                'experience',
                'salary',
                'contract_type',
                'vacant_jobs',
                'expiration_date',
                'recruiter_id',
                'active',
                'date_upd'
            ];

            foreach ($fields as $field) {
                $updates[] = "$field = :$field";
            }
            $sql .= implode(', ', $updates);
            $sql .= " WHERE id = :id";


            // Préparation de la requête
            $stmt = Config::getConnexion()->prepare($sql);

            // Liaison des valeurs aux paramètres
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':experience', $this->experience);
            $stmt->bindParam(':salary', $this->salary);
            $stmt->bindParam(':contract_type', $this->contractType);
            $stmt->bindParam(':vacant_jobs', $this->vacantJobs);
            $stmt->bindParam(':expiration_date', $this->expirationDate);
            $stmt->bindParam(':recruiter_id', $this->recruiterId);
            $stmt->bindParam(':active', $this->active);
            $stmt->bindParam(':date_upd', $this->dateUpd);
            $stmt->bindParam(':id', $id);

            // Exécution de la requête
            $stmt->execute();
            return true; // Mise à jour réussie
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false; // En cas d'erreur, retourne false
        }
    }


    // Méthode pour récupérer un recruteur par son identifiant
    public function getById($id)
    {
        try {
            // Préparation de la requête SQL
            $sql = "SELECT * FROM job_offer WHERE id = :id";

            // Préparation de la requête
            $stmt = Config::getConnexion()->prepare($sql);

            // Liaison des valeurs aux paramètres
            $stmt->bindParam(':id', $id);

            // Exécution de la requête
            $stmt->execute();

            // Récupération du résultat
            $recruiter = $stmt->fetch(PDO::FETCH_ASSOC);

            // Fermeture de la connexion à la base de données
            $db = null;

            return $recruiter; // Retourne le recruteur trouvé
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return null; // En cas d'erreur, retourne null
        }
    }

    public function delete($id)
    {
        try {
            // Préparation de la requête SQL
            $sql = "DELETE FROM job_offer WHERE id = :id";

            // Préparation de la requête
            $stmt = Config::getConnexion()->prepare($sql);

            // Liaison de la valeur du paramètre :id
            $stmt->bindParam(':id', $id);

            // Exécution de la requête
            $stmt->execute();

            return true; // Suppression réussie
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false; // En cas d'erreur, retourne false
        }
    }
}


