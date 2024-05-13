<?php
   require_once 'C:/xampp/htdocs/Nourprojet/cnx.php';
   require_once 'C:/xampp/htdocs/Nourprojet/controller/exam.php';
if (isset($_GET['id'])) {
    // Récupérer l'identifiant de l'examen à supprimer
    $idExamenASupprimer = $_GET['id'];
    $examenManager = new Exam();
    $suppressionReussie = $examenManager->delete($idExamenASupprimer, $pdo);
    if ($suppressionReussie) {
        header('Location: afficherexam.php');
        exit();
    } else {
        // Gérer l'erreur
        echo "Une erreur s'est produite lors de la suppression de la formation.";
    }
} else {
    echo "ID de la formation non spécifié.";
}

?>
