<?php
require '../config/config.php';

class Recruiter
{
    private $db;
    private $email;
    private $name;
    private $password;
    private $companyName;
    private $website;
    private $phone;
    private $address;
    private $description;
    private $activitySector;

    // Constructor
    public function __construct()
    {
       
    }

    // Getters and Setters
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getCompanyName()
    {
        return $this->companyName;
    }

    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
    }

    public function getWebsite()
    {
        return $this->website;
    }

    public function setWebsite($website)
    {
        $this->website = $website;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getActivitySector()
    {
        return $this->activitySector;
    }

    public function setActivitySector($activitySector)
    {
        $this->activitySector = $activitySector;
    }

    public function getAll()
    {
        $query = "SELECT * FROM recruiter";
        try {
            $stmt = Config::getConnexion()->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }

    public function add()
    {
        try {
            // Préparation de la requête SQL
            $sql = "INSERT INTO recruiter (email, name, password, company_name, website, phone, address, description, activity_sector) 
                    VALUES (:email, :name, :password, :company_name, :website, :phone, :address, :description, :activity_sector)";

            // Préparation de la requête
            $req = Config::getConnexion()->prepare($sql);
            
            // Liaison des valeurs aux paramètres
            $req->bindParam(':email', $this->email);
            $req->bindParam(':name', $this->name);
            $req->bindParam(':password', $this->password);
            $req->bindParam(':company_name', $this->companyName);
            $req->bindParam(':website', $this->website);
            $req->bindParam(':phone', $this->phone);
            $req->bindParam(':address', $this->address);
            $req->bindParam(':description', $this->description);
            $req->bindParam(':activity_sector', $this->activitySector);

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
            $sql = "UPDATE recruiter SET ";
            $updates = [];
            $fields = ['email', 'name', 'company_name', 'website', 'phone', 'address', 'description', 'activity_sector'];

            foreach ($fields as $field) {
                $updates[] = "$field = :$field";
            }
            $sql .= implode(', ', $updates);
            $sql .= " WHERE id = :id";

            // Préparation de la requête
            $stmt = Config::getConnexion()->prepare($sql);

            // Liaison des valeurs aux paramètres
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':company_name', $this->companyName);
            $stmt->bindParam(':website', $this->website);
            $stmt->bindParam(':phone', $this->phone);
            $stmt->bindParam(':address', $this->address);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':activity_sector', $this->activitySector);
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
            $sql = "SELECT * FROM recruiter WHERE id = :id";

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
            $sql = "DELETE FROM recruiter WHERE id = :id";

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
