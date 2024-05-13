<?php

require_once 'C:/xampp/htdocs/Nourprojet/controller/exam.php'; // Importer la classe Examen
require_once 'C:/xampp/htdocs/Nourprojet/model/examen.php'; // Importer la classe ExamenManager
require_once 'C:/xampp/htdocs/Nourprojet/cnx.php'; // Importer la connexion à la base de données
if (isset($_GET['id'])) {
    $idForm = intval($_GET['id']);
     
}
 else {
    // Rediriger l'utilisateur vers une autre page s'il manque l'ID de la formation
    header("Location: afficherform.php");
    exit();
}
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $date = $_POST['date'];


    $examenManager = new Exam();
    
// Créer une instance de la classe ExamenManager
   
    $lastId = $examenManager->getLastId($pdo);
    $lastId = $lastId+1;
    $examen = new Examen($lastId, $nom, $date,$idForm);

    // Ajouter l'examen à la base de données en utilisant ExamenManager
    
    $examenManager->ajouter($pdo, $examen);

    // Redirection vers une page de confirmation ou autre page souhaitée
    header("Location: afficherform.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Examen</title>
    <style>
        /* Style adapté du formulaire de modification pour le formulaire d'ajout */
        .exam-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4; /* Couleur de fond gris clair */
        }

        .exam-form {
            background-color: white; /* Fond blanc pour le formulaire */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Ombre portée légère */
        }

        .exam-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .exam-form label {
            display: block;
            margin-bottom: 5px;
        }

        .exam-form input[type="text"],
        .exam-form input[type="date"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc; /* Bordure grise */
            border-radius: 4px; /* Bordures arrondies */
            box-sizing: border-box;
        }

        .exam-form input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50; /* Bouton vert */
            color: white; /* Texte blanc */
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .exam-form input[type="submit"]:hover {
            background-color: #45a049; /* Vert foncé au survol */
        }
    </style>
</head>
<body>

<div class="exam-container">
    <div class="exam-form">
        <h2>Ajouter un Examen</h2>
        <!-- Formulaire d'ajout d'examen -->
        <form action="" method="post">
            <label for="nom">Nom de l'examen:</label>
            <input type="text" id="nom" name="nom" required><br>
            
            <label for="date">Date de l'examen:</label>
            <input type="date" id="date" name="date" required><br>
            
            <input type="submit" value="Ajouter">
        </form>
    </div>
</div>

</body>
</html>



