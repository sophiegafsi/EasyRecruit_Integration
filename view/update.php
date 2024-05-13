<?php
require_once 'C:/xampp/htdocs/Nourprojet/model/formation.php'; // Importer la classe Formation
require_once 'C:/xampp/htdocs/Nourprojet/cnx.php';
require_once 'C:/xampp/htdocs/Nourprojet/controller/form.php';

// Récupérer l'ID de la formation à modifier
if (isset($_GET['id'])) {
    $idFormationAModifier = intval($_GET['id']);

    // Récupérer la formation à modifier à partir de la base de données
    $form = new form();
    $formationAModifierData = $form->getFormationById($pdo, $idFormationAModifier);

    if (!$formationAModifierData) {
        echo "Formation non trouvée.";
        exit; // Arrêter l'exécution du script si la formation n'est pas trouvée
    }

    // Vérifier si le formulaire de modification a été soumis
    if (isset($_POST['modifier'])) {
        // Récupérer les nouvelles valeurs des champs du formulaire
        $nouveauNom = $_POST['nouveau_nom'] ?? '';
        $nouveauType = $_POST['nouveau_type'] ?? '';
        $nouvelleImage = $_POST['nouvelle_image'] ?? '';
        $nouvelleDescription = $_POST['nouvelle_description'] ?? '';
        if (isset($_FILES['nouvelle_image']) && $_FILES['nouvelle_image']['error'] === 0) {
            // Déplacer le fichier téléchargé vers le répertoire souhaité
            $dossierTelechargement = 'img';
            $nomFichier = $_FILES['nouvelle_image']['name'];
            $cheminFichier = $dossierTelechargement . '/' . $nomFichier;
            if (move_uploaded_file($_FILES['nouvelle_image']['tmp_name'], $cheminFichier)) {
                // Le fichier a été téléchargé avec succès, vous pouvez l'utiliser comme vous le souhaitez
                $nouvelleImage = $nomFichier;
            } else {
                // Gérer l'erreur de téléchargement du fichier
                echo "Une erreur s'est produite lors du téléchargement de l'image.";
                exit;
            }
        } else {
            // Aucun fichier n'a été téléchargé ou une erreur s'est produite lors du téléchargement
            // Vous pouvez choisir de définir une valeur par défaut pour $nouvelleImage ou afficher un message d'erreur
            $nouvelleImage = '';
        }
        

        // Créer un objet Formation avec les nouvelles valeurs
        $formationModifiee = new Formation($idFormationAModifier, $nouveauNom, $nouveauType, $nouvelleImage, $nouvelleDescription);

        // Mettre à jour la formation avec les nouvelles valeurs
        $modificationReussie = $form->update($formationModifiee, $pdo);

        // Vérifier si la modification a réussi
        if ($modificationReussie) {
            echo "Formation modifiée avec succès.";
        } else {
            echo "Une erreur s'est produite lors de la modification de la formation.";
        }
    }
} else {
    echo "ID de la formation non spécifié.";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une Formation</title>
    <style>
        /* Style minimal pour le formulaire de modification */
        .contact-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }

        .contact-form {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .contact-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .contact-form label {
            display: block;
            margin-bottom: 5px;
        }

        .contact-form input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .contact-form input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .contact-form input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .contact-form input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="contact-container">
    <div class="contact-form">
        <h2>Modifier une Formation</h2>
        <!-- Formulaire de modification -->
        <form id="formation-form" action="" method="post" enctype="multipart/form-data">
            <label for="nouveau_nom">Nouveau Nom :</label>
            <input type="text" id="nouveau_nom" name="nouveau_nom" value="<?php echo htmlspecialchars($formationAModifierData->getNom()); ?>"><br>
            
            <label for="nouveau_type">Nouveau Type :</label>
            <input type="text" id="nouveau_type" name="nouveau_type" value="<?php echo htmlspecialchars($formationAModifierData->getType()); ?>"><br>
            
            <label for="nouvelle_image">Nouvelle Image :</label>
            <input type="file" id="nouvelle_image" name="nouvelle_image"><br>
            
            <label for="nouvelle_description">Nouvelle Description :</label>
            <input type="text" id="nouvelle_description" name="nouvelle_description" value="<?php echo htmlspecialchars($formationAModifierData->getDescription()); ?>"><br>

            <input type="submit" name="modifier" value="Modifier">
        </form>
    </div>
</div>

</body>
</html>
