<?php
require_once 'C:/xampp/htdocs/Nourprojet/model/formation.php'; // Importer la classe Formation
require_once 'C:/xampp/htdocs/Nourprojet/cnx.php';

class form {
   
    public function afficher($pdo) {
        try {
            $query = $pdo->prepare('SELECT * FROM formation');
            $query->execute();
            $res = $query->fetchAll();
            return $res;
        } catch(PDOException $e) {
            echo $e->getMessage();
            return array();
        }
    }

    public function ajouter($pdo, formation $x) {
        try {
            $query = $pdo->prepare('INSERT INTO formation (id, nom, type, image, description) VALUES (:id, :nom, :type, :image, :description)');
            $query->bindValue(':id', $x->getIdForm(), PDO::PARAM_INT);
            $query->bindValue(':nom', $x->getNom(), PDO::PARAM_STR);
            $query->bindValue(':type', $x->getType(), PDO::PARAM_STR);
            $query->bindValue(':image', $x->getImage(), PDO::PARAM_STR);
            $query->bindValue(':description', $x->getDescription(), PDO::PARAM_STR);
            $query->execute();
        } catch(PDOException $e) {
            echo 'Error ajouter: ' . $e->getMessage();
        }
    }
    public function update(formation $x2,$pdo) {
        try {
            $query = $pdo->prepare('UPDATE formation SET nom = :nom, type = :type, image = :image, description = :description WHERE id = :id');
            $query->bindValue(':id', $x2->getIdForm(), PDO::PARAM_INT);
            $query->bindValue(':nom', $x2->getNom(), PDO::PARAM_STR);
            $query->bindValue(':type', $x2->getType(), PDO::PARAM_STR);
            $query->bindValue(':image', $x2->getImage(), PDO::PARAM_STR);
            $query->bindValue(':description', $x2->getDescription(), PDO::PARAM_STR);
            $query->execute();
            return true;
        } catch(PDOException $e) {
            echo 'Error update: ' . $e->getMessage();
            return false;
        }
    }

    public function delete($id, $pdo) {
        try {
            $query = $pdo->prepare('DELETE FROM formation WHERE id = :id');
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->execute();
            return true;
        } catch(PDOException $e) {
            echo 'Error delete: ' . $e->getMessage();
            return false;
        }
    }

    public function getLastId($pdo) {
        try {
            $query = $pdo->prepare('SELECT MAX(id) AS max_id FROM formation');
            $query->execute();
            $res = $query->fetch(PDO::FETCH_ASSOC);
            $lastId = $res['max_id']; 
        } catch(PDOException $e) {
            echo $e->getMessage();
            $lastId = 0; 
        }
        return $lastId;
    }

    public function getFormationById($pdo, $id)
{
    try {
        $query = $pdo->prepare('SELECT * FROM formation WHERE id = :id');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $formationData = $query->fetch(PDO::FETCH_ASSOC);

        if ($formationData) {
            // Créer une instance de formation à partir des données récupérées
            $formation = new formation(
                $formationData['id'], 
                $formationData['nom'], 
                $formationData['type'], 
                $formationData['image'], 
                $formationData['description']
            );
            return $formation;
        } else {
            return null;
        }
    } catch(PDOException $e) {
        echo 'Error getFormationById: ' . $e->getMessage();
        return null;
    }
}
public function filtrer($pdo) {
    try {
        $query = $pdo->prepare('SELECT * FROM formation ORDER BY type');
        $query->execute();
        $res = $query->fetchAll();
        return $res;
    } catch(PDOException $e) {
        echo $e->getMessage();
        return array();
    }
}
public function countFormationsByType($pdo, $type) {
    try {
        $query = $pdo->prepare('SELECT COUNT(*) AS count FROM formation WHERE type = :type');
        $query->bindValue(':type', $type, PDO::PARAM_STR);
        $query->execute();
        $res = $query->fetch(PDO::FETCH_ASSOC);
        return $res['count'];
    } catch(PDOException $e) {
        echo 'Error countFormationsByType: ' . $e->getMessage();
        return 0;
    }
}

public function countInformatiqueFormations($pdo) {
    try {
        $query = $pdo->prepare('SELECT COUNT(*) AS count FROM formation WHERE type = "informatique"');
        $query->execute();
        $res = $query->fetch(PDO::FETCH_ASSOC);
        return $res['count'];
    } catch(PDOException $e) {
        echo $e->getMessage();
        return 0;
    }
}


public function countProgrammationFormations($pdo) {
    return $this->countFormationsByType($pdo, 'programmation');
}

public function countEconomieFormations($pdo) {
    return $this->countFormationsByType($pdo, 'economie');
}
public function countFormations($pdo) {
    try {
        $query = $pdo->query('SELECT COUNT(*) AS count FROM formation');
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    } catch(PDOException $e) {
        echo 'Erreur lors du comptage des formations : ' . $e->getMessage();
        return 0;
    }
}
public function afficherUnique($pdo, $id) {
    try {
        $query = $pdo->prepare('SELECT * FROM formation WHERE id=:id');
        $query->bindValue(':id', $id, PDO::PARAM_INT);

        $query->execute();
        $data = $query->fetch();
    
        // Vérifier si des données ont été trouvées
        if ($data) {
            // Créer un nouvel objet formation avec les données récupérées
            $formation = new formation($data['id'], $data['nom'], $data['type'], $data['image'], $data['description']);
    
            // Retourner l'objet formation
            return $formation;
        } else {
            // Si aucune donnée n'est trouvée, retourner null
            return null;
        }
    } catch(PDOException $e) {
        echo $e->getMessage();
        return null;
    }
    
}





    
    
    
}
?>
