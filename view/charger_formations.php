<?php
// Démarrer la session
session_start();
// Inclure le fichier de configuration de la base de données
require_once 'C:/xampp/htdocs/Nourprojet/cnx.php';
// Inclure la classe form
require_once 'C:/xampp/htdocs/Nourprojet/controller/form.php';

// Vérifier si le tableau des formations existe dans la session
if (!isset($_SESSION['formations'])) {
    // Si le tableau des formations n'existe pas, le créer
    $_SESSION['formations'] = [];

    // Charger toutes les formations depuis la base de données
    $formManager = new form();
    $allFormations = $formManager->afficher($pdo);

    // Ajouter les formations à $_SESSION['formations']
    foreach ($allFormations as $formation) {
        $_SESSION['formations'][] = $formation;
    }
}

// Fonction pour charger les informations sur une formation par son ID
function chargerFormationParId($pdo, $idFormation) {
    $formManager = new form();
    $formation = $formManager->getFormationById($pdo, $idFormation);

    if ($formation instanceof formation) {
        $_SESSION['formations'][] = $formation;
    } else {
        echo 'Aucune formation valide trouvée pour l\'ID spécifié.';
    }
}

// Vérifier si l'ID de la formation est fourni dans la requête GET
if (isset($_GET['id'])) {
    // Récupérer l'ID de la formation depuis la requête GET
    $idFormation = $_GET['id'];

    // Appeler la fonction pour charger les informations sur la formation
    chargerFormationParId($pdo, $idFormation);
} else {
    // Si l'ID de la formation n'est pas fourni dans la requête GET, afficher un message d'erreur
    echo 'ID de formation non spécifié.';
}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>EasyRecrute</title>
  <link rel="stylesheet" href="style/custom.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <section class="block-formations">
        <h2>Formations</h2>
        <div class="existing-formations" id="existing-formations">
            <!-- Afficher les informations sur les formations -->
            <?php foreach ($_SESSION['formations'] as $formation): ?>
                <?php if ($formation instanceof formation): ?>
                    <div class="formation">
                        <h2><?= htmlspecialchars($formation->getNom()) ?></h2>
                        <p>Type: <?= htmlspecialchars($formation->getType()) ?></p>
                        <p>Description: <?= htmlspecialchars($formation->getDescription()) ?></p>
                    </div>
                <?php else: ?>
                    <p>Erreur: Donnée de formation incorrecte.</p>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </section>
</body>
</html>
