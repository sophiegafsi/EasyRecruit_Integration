<?php
require_once 'C:/xampp/htdocs/Nourprojet/model/formation.php'; 
require_once 'C:/xampp/htdocs/Nourprojet/controller/form.php';// Importer la classe Formation
require_once 'C:/xampp/htdocs/Nourprojet/cnx.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    
    // Vérifier si une image a été uploadée
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image']['name']; // Nom du fichier image
        $image_temp = $_FILES['image']['tmp_name']; // Emplacement temporaire du fichier image
        
        // Déplacer l'image vers le dossier de destination
        move_uploaded_file($image_temp, 'img/' . $image);
    } else {
        // Aucune image n'a été uploadée
        $image = ''; // Valeur par défaut
    }
    
   
    $form_manager = new form();
    $lastId = $form_manager->getLastId($pdo);
    $lastId = $lastId+1;
    $nouvelle_formation = new formation($lastId, $nom, $type, $image, $description);
    $form_manager->ajouter($pdo, $nouvelle_formation);
    header("Location: afficherform.php");
    
   
   
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ajouter-formations</title>
    <link rel="stylesheet" href="style/reclamation.css">
</head>
<body>
<header class="header-style">
    <div class="logo-header">
        <img src="style/photos/EasyRecruit-logo.svg" alt="logo" width="150" height="60"/>
    </div>
    <div class="links-header">
        <a href="http://localhost/Nourprojet/views/afficherform.php" class="btn-recrut">Espace Recruteur</a>
        <a href="#" class="btn-inscri"> <img src="style/photos/icon-inscription.svg" alt="Inscription" width="30" height="30">Inscription</a>
        <a href="#" class="btn-compte"> <img src="style/photos/icon-compte.svg" alt="mon compte" width="30" height="30"> Mon compte</a>
    </div>
</header>
<div class="block-intro">
    <div class="overlay">
        <div class="desc-intro">
            <h1 class="desc-style">Forgez votre avenir, <br>
                <span> trouvez votre voie professionnelle ici !</span> </h1>
            <a href="#" class="btn-decouvrir">découvrir plus</a>
        </div>
    </div>
</div>

<div class="contact-container">
    <div class="contact-image">
        <img src="style/photos/condidat.png" alt="Image de contact">
    </div>
    <div class="contact-form">
        <h2>Ajouter une nouvelle formation</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="nom">Nom:</label><br>
            <input type="text" id="nom" name="nom"placeholder="Entrez votre nom de formation"><br>
            
            <label for="type">Type:</label><br>
            <select id="type" name="type">
                <option value="informatique">Informatique</option>
                <option value="programmation">Programmation</option>
                <option value="economie">Économie</option>
            </select><br>
            
            <label for="description">Description:</label><br>
            <textarea id="description" name="description"placeholder="Entrez votre description"></textarea><br>
            
            <label for="image">Image:</label><br>
            <input type="file" id="image" name="image"><br>
            
            <input type="submit" value="Ajouter">
        </form>
    </div>
    <div id="message"></div> 
</div>

<footer>
    <div class="footer-container">
        <div class="footer-links">
            <h3 class="titre-footer">Liens rapides</h3>
            <div class="block-links-style">
                <a href="#" class="link-footer">Inscription</a>
                <a href="http://localhost/Nourprojet/views/afficherform.php" class="link-footer">Espace Recruteur</a>
                <a href="#" class="link-footer">Mon Compte</a>
                <a href="#" class="link-footer">Nous Contacter</a>
            </div>
        </div>
        <div class="footer-social">
            <h3 class="titre-footer">Suivez-nous</h3>
            <div class="block-links-style-rs">
                <a href="#" class="link-footer-rs"><img src="style/photos//fb.png" alt="Facebook"></a>
                <a href="#" class="link-footer-rs"><img src="style/photos/insta.png" alt="Instagram"></a>
                <a href="#" class="link-footer-rs"><img src="style/photos/linkidin.png" alt="LinkedIn"></a>
                <a href="#" class="link-footer-rs"><img src="style/photos/twitter.png" alt="Twitter"></a>
            </div>
        </div>
    </div>
    <div class="copy-right">
        <p>Copyright © 2024 EasyRecruit</p>
    </div>
</footer>

<script>
    // Vous pouvez ajouter ici votre script de validation de formulaire si nécessaire
</script>

</body>
</html>



