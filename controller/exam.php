<?php
require_once 'C:/xampp/htdocs/Nourprojet/model/examen.php'; // Importer la classe Formation
require_once 'C:/xampp/htdocs/Nourprojet/cnx.php';
class Exam {
    public function afficher($pdo) {
        try {
            $query = $pdo->prepare('SELECT * FROM examen');
            $query->execute();
            $res = $query->fetchAll();
            return $res;
        } catch(PDOException $e) {
            echo $e->getMessage();
            return array();
        }
    }

    public function ajouter($pdo, Examen $examen) {
        try {
            $query = $pdo->prepare('INSERT INTO examen (nom, date, formation_id) VALUES (:nom, :date, :formation_id)');
            $query->bindValue(':nom', $examen->getNom(), PDO::PARAM_STR);
            $query->bindValue(':date', $examen->getDate(), PDO::PARAM_STR);
            $query->bindValue(':formation_id', $examen->getFormationId(), PDO::PARAM_INT);
            $query->execute();
        } catch(PDOException $e) {
            echo 'Error ajouter: ' . $e->getMessage();
        }
    }

    public function update(Examen $examen, $pdo) {
        try {
            $query = $pdo->prepare('UPDATE examen SET nom = :nom, date = :date, formation_id = :formation_id WHERE id = :id');
            $query->bindValue(':id', $examen->getId(), PDO::PARAM_INT);
            $query->bindValue(':nom', $examen->getNom(), PDO::PARAM_STR);
            $query->bindValue(':date', $examen->getDate(), PDO::PARAM_STR);
            $query->bindValue(':formation_id', $examen->getFormationId(), PDO::PARAM_INT);
            $query->execute();
            return true;
        } catch(PDOException $e) {
            echo 'Error update: ' . $e->getMessage();
            return false;
        }
    }

    public function delete($id, $pdo) {
        try {
            $query = $pdo->prepare('DELETE FROM examen WHERE id = :id');
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
            $query = $pdo->prepare('SELECT MAX(id) AS max_id FROM examen');
            $query->execute();
            $res = $query->fetch(PDO::FETCH_ASSOC);
            $lastId = $res['max_id']; 
        } catch(PDOException $e) {
            echo $e->getMessage();
            $lastId = 0; 
        }
        return $lastId;
    }

    public function getExamenById($pdo, $id)
    {
        try {
            $query = $pdo->prepare('SELECT * FROM examen WHERE id = :id');
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();
            $examenData = $query->fetch(PDO::FETCH_ASSOC);

            if ($examenData) {
                // Créer une instance de Examen à partir des données récupérées
                $examen = new Examen(
                    $examenData['id'], 
                    $examenData['nom'], 
                    $examenData['date'], 
                    $examenData['formation_id']
                );
                return $examen;
            } else {
                return null;
            }
        } catch(PDOException $e) {
            echo 'Error getExamenById: ' . $e->getMessage();
            return null;
        }
    }
        public function countExamens($pdo) {
            try {
                $query = $pdo->query('SELECT COUNT(*) AS count FROM examen');
                $result = $query->fetch(PDO::FETCH_ASSOC);
                return $result['count'];
            } catch(PDOException $e) {
                echo 'Erreur lors du comptage des examens : ' . $e->getMessage();
                return 0;
            }
        }
        public function afficherjoin($pdo) {
            try {
                $query = $pdo->prepare('SELECT e.*, f.* FROM examen e INNER JOIN formation f ON e.formation_id = f.id');
                $query->execute();
                $res = $query->fetchAll();
                return $res;
            } catch(PDOException $e) {
                echo $e->getMessage();
                return array();
            }
        }
        








}


?>
