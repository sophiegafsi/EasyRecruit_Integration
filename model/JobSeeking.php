<?php

class JobSeeker
{
    private $id;
    private $user_id;
    private $phone;
    private $fichier;
    private $email;
    private $joboffer_id;
    private $date_add;

    // Getters et Setters

    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getFichier()
    {
        return $this->fichier;
    }

    public function setFichier($fichier)
    {
        $this->fichier = $fichier;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getJobOfferId()
    {
        return $this->joboffer_id;
    }

    public function setJobOfferId($joboffer_id)
    {
        $this->joboffer_id = $joboffer_id;
    }

    public function getDateAdd()
    {
        return $this->date_add;
    }

    public function setDateAdd($date_add)
    {
        $this->date_add = $date_add;
    }

    public function add()
    {
        try {
            // Préparation de la requête SQL
            $sql = "INSERT INTO `job_seeker`(`user_id`, `fichier`, `email`, `joboffer_id`,phone,date_add)
                VALUES(:user_id, :fichier, :email , :joboffer_id , :phone, :date_add)
                ";

            // Préparation de la requête
            $req = Config::getConnexion()->prepare($sql);

            // Liaison des valeurs aux paramètres
            $req->bindParam(':user_id', $this->user_id);
            $req->bindParam(':fichier', $this->fichier);
            $req->bindParam(':email', $this->email);
            $req->bindParam(':joboffer_id', $this->joboffer_id);
            $req->bindParam(':phone', $this->phone);
            $req->bindParam(':date_add', $this->date_add);

            // Exécution de la requête
            $req->execute();

            return true; // Succès de l'ajout
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false; // Échec de l'ajout
        }
    }

    public function getUserCondidatures($id_user)
    {
        $query = "
            SELECT s.*, o.title, o.contract_type, r.company_name
            FROM `job_seeker` s
            LEFT JOIN `job_offer` o ON s.`joboffer_id` = o.id
            LEFT JOIN `recruiter` r ON (o.recruiter_id = r.id)
            WHERE s.`user_id` = :user_id;
            ORDER BY s.id DESC";
        try {
            $stmt = Config::getConnexion()->prepare($query);
            $stmt->bindParam(':user_id', $id_user, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }
}
