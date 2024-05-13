<?php
require_once 'C:/xampp/htdocs/Nourprojet/controller/exam.php'; // Importer la classe Exam
require_once 'C:/xampp/htdocs/Nourprojet/cnx.php';
require_once 'C:/xampp/htdocs/Nourprojet/controller/form.php'; 

// Créer une instance de la classe Exam
$examManager = new Exam();

// Récupérer la liste des examens avec les détails de formation associée
$listeExamens = $examManager->afficherjoin($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affichage des Examens et Formations Associées</title>
    <!-- Ajout de Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
        .btn-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .btn {
            margin: 0 10px;
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
        .table {
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0,0,0,0.15);
        }
        .table thead tr {
            background-color: #33475b;
            color: #ffffff;
        }
        .table tbody tr:last-child {
            border-bottom: 2px solid #33475b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="title">Liste des Examens et Formations Associées</h1>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        
                        <th>Nom Examen</th>
                        <th>Date Examen</th>
                        <th>ID Formation</th>
                        <th>Nom Formation</th>
                        <th>Type Formation</th>
                        <th>Image</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    require_once 'C:/xampp/htdocs/Nourprojet/controller/exam.php'; // Importer la classe Exam
                    require_once 'C:/xampp/htdocs/Nourprojet/cnx.php';
                    require_once 'C:/xampp/htdocs/Nourprojet/controller/form.php'; 

                    // Créer une instance de la classe Exam
                    $examManager = new Exam();

                    // Récupérer la liste des examens avec les détails de formation associée
                    $listeExamens = $examManager->afficherjoin($pdo);

                    foreach ($listeExamens as $examen) : ?>
                        <tr>
                           
                            <td><?php echo $examen['nom']; ?></td>
                            <td><?php echo $examen['date']; ?></td>
                            <td><?php echo $examen['formation_id']; ?></td>
                            <?php
                                $formationManager=new form();
                                $formation = $formationManager->getFormationById($pdo, $examen['formation_id']);

                                if ($formation) {
                                    // Afficher les détails de la formation dans les cellules du tableau
                                   
                                    echo '<td>' . $formation->getNom() . '</td>';
                                    echo '<td>' . $formation->getType() . '</td>';
                                    echo '<td><img src="img/' . $formation->getImage() . '" alt="' . $formation->getNom() . '" width="100"></td>';
                                    echo '<td>' . $formation->getDescription() . '</td>';
                                } else {
                                    // Si la formation n'est pas trouvée, afficher un message d'avertissement
                                    echo '<td colspan="5">Formation non trouvée</td>';
                                }
                            ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="btn-container">
            <a href="http://localhost/Nourprojet/views/afficherexam.php" class="btn">Page Examen</a>
            <a href="http://localhost/Nourprojet/views/afficherform.php" class="btn">Page Formation</a>
        </div>
    </div>

    <!-- Ajout de Bootstrap JS (optionnel) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
