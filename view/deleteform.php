<?php
require_once 'C:/xampp/htdocs/Nourprojet/controller/form.php';
require_once 'C:/xampp/htdocs/Nourprojet/cnx.php';

// Récupérer l'ID de la formation à supprimer
if (isset($_GET['id'])) {
    $idFormationASupprimer = $_GET['id'];

    // Créer une instance de la classe Form
    $formationManager = new form();

    // Supprimer la formation avec l'ID spécifié
    $suppressionReussie = $formationManager->delete($idFormationASupprimer, $pdo);

    // Vérifier si la suppression a réussi
    if ($suppressionReussie) {
        // Rediriger vers la page d'affichage des formations
        header('Location: afficherform.php');
        exit();
    } else {
        // Gérer l'erreur
        echo "Une erreur s'est produite lors de la suppression de la formation.";
    }
} else {
    echo "ID de la formation non spécifié.";
}
?>
