<?php
require_once 'C:/xampp/htdocs/Nourprojet/controller/exam.php';
require_once 'C:/xampp/htdocs/Nourprojet/controller/form.php'; 
require_once 'C:/xampp/htdocs/Nourprojet/cnx.php';

// Récupérer l'ID de l'examen spécifique depuis les paramètres GET
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);}
else
{
    echo("nestpas recu");
}


// Créer une instance de la classe Exam
$examManager = new Exam();

// Appeler la méthode getExamenById pour obtenir les détails de l'examen
$listeExamens = $examManager->getExamenById($pdo, $id);

// Vérifier si l'examen existe
if ($listeExamens) {
    // Si l'examen existe, récupérer l'ID de la formation associée à cet examen
    $formationId = $listeExamens->getFormationId();

    // Créer une instance de la classe Form
    $formManager = new form();

    // Appeler la méthode getFormationById pour obtenir les détails de la formation associée à cet examen
    $formation = $formManager->getFormationById($pdo, $formationId);

    // Afficher les détails de la formation
    
} else {
    // Si l'examen n'existe pas, afficher un message d'erreur ou rediriger l'utilisateur vers une autre page
    echo "L'examen avec l'ID $id n'existe pas.";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la formation et de l'examen</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Personnalisation du style */
        body {
            padding: 20px;
            background-color: #f0f0f0; /* Couleur de fond du corps de la page */
        }
        .title {
            text-align: center;
            color: #0000FF; /* Titre en bleu */
            font-size: 2.5em;
            margin-bottom: 50px;
        }
        .btn {
            margin: 20px;
            padding: 10px 20px;
            color: white;
            background-color: #008000; /* Boutons en vert */
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #006400; /* Couleur de survol des boutons en vert foncé */
        }
        .details {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 20px rgba(0,0,0,0.15);
            padding: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="title">Détails de la formation et de l'examen</h1>
        <div class="row">
            <div class="col-md-6 details">
                <h2>Formation</h2>
                <?php
                   if ($formation) {
                    // Afficher les détails de la formation
                    echo "<p>ID : " . $formation->getIdForm() . "</p>";
                    echo "<p>Nom : " . $formation->getNom() . "</p>";
                    echo "<p>Type : " . $formation->getType() . "</p>";
                    echo '<p><img src="img/' . $formation->getImage() . '" alt="' . $formation->getNom() . '" class="img-fluid"></p>';
                    echo "<p>Description : " . $formation->getDescription() . "</p>";
                } else {
                    // Si la formation n'existe pas, afficher un message d'erreur
                    echo "La formation associée à l'examen avec l'ID $id n'existe pas.";
                }
                ?>
                
            </div>
            <div class="col-md-6 details">
                <h2>Examen</h2>
                <?php
                if ($listeExamens) {
                    // Afficher les détails de l'examen
                    echo "<p>ID de l'examen : " . $listeExamens->getId() . "</p>";
                    echo "<p>Nom de l'examen : " . $listeExamens->getNom() . "</p>";
                    echo "<p>Date de l'examen : " . $listeExamens->getDate() . "</p>";
                    echo "<p>ID de la formation associée : " . $listeExamens->getFormationId() . "</p>";
                    // Ajoutez ici d'autres champs de l'examen selon votre structure de classe Exam
                } else {
                    // Si l'examen n'existe pas, afficher un message d'erreur
                    echo "L'examen avec l'ID $id n'existe pas.";
                }
                ?>
            </div>
        </div>
    </div>
    <!-- Ajout de Bootstrap JS (optionnel) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
