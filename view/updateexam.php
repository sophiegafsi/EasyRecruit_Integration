<?php
require_once 'C:/xampp/htdocs/Nourprojet/model/examen.php'; // Importer la classe Examen
require_once 'C:/xampp/htdocs/Nourprojet/cnx.php';
require_once 'C:/xampp/htdocs/Nourprojet/controller/exam.php';

// Récupérer l'ID de l'examen à modifier
if (isset($_GET['id'])) {
    $idExamenAModifier = intval($_GET['id']);

    // Récupérer l'examen à modifier à partir de la base de données
    $exam = new Exam();
    $examenAModifierData = $exam->getExamenById($pdo, $idExamenAModifier);
    
    // Vérifier si le formulaire de modification a été soumis
    if (isset($_POST['modifier'])) {
        // Récupérer les nouvelles valeurs des champs du formulaire
        $nouveauNom = $_POST['nouveau_nom'];
        $nouvelleDate = $_POST['nouvelle_date'];
        
        // Créer un objet Examen avec les nouvelles valeurs
        $examenModifie = new Examen($idExamenAModifier, $nouveauNom, $nouvelleDate,$examenAModifierData->getFormationId());

        // Mettre à jour l'examen avec les nouvelles valeurs
        $modificationReussie = $exam->update($examenModifie, $pdo);

        // Vérifier si la modification a réussi
        if ($modificationReussie) {
            echo "Examen modifié avec succès.";
        } else {
            echo "Une erreur s'est produite lors de la modification de l'examen.";
        }
    }
} else {
    echo "ID de l'examen non spécifié.";
} 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Examen</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa; /* Couleur de fond */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .card {
            max-width: 500px;
            background-color: #fff; /* Couleur de fond des cartes */
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1); /* Effet d'ombre */
            padding: 30px;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 30px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Modifier un Examen</h1>
        <form action="" method="post">
            <div class="form-group">
                <label for="nouveau_nom">Nouveau Nom :</label>
                <input type="text" id="nouveau_nom" name="nouveau_nom" class="form-control" value="<?php echo htmlspecialchars($examenAModifierData->getNom()); ?>">
            </div>
            <div class="form-group">
                <label for="nouvelle_date">Nouvelle Date :</label>
                <input type="text" id="nouvelle_date" name="nouvelle_date" class="form-control" value="<?php echo htmlspecialchars($examenAModifierData->getDate()); ?>">
            </div>
            <button type="submit" name="modifier" class="btn btn-primary">Modifier</button>
        </form>
    </div>
</body>
</html>


