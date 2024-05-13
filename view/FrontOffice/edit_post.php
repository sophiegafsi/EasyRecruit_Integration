<?php
include "../../Controller/PostController.php";
if (isset($_GET['id']))
    $post = PostController::getPost($_GET['id']);
else
    header("Location: index.php");

if (isset($_POST['Envoyer'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $upVotes = $_POST['upVotes'];
    $newPost = new PostModel(1,$title, $content, $upVotes);
    $id = PostController::updatePost($post['id'], $title, $content, $upVotes);
    header("Location: AfficherPosts.php");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactez-nous</title>
    <link rel="stylesheet" href="../Assets/reclamation.css">

</head>
<body>

<header class="header-style">
    <div class="logo-header">
        <img src="../Assets/photos/EasyRecruit-logo.svg" alt="logo" width="150" height="60"/> <!-- Réduction de la taille du logo -->
    </div>
    <div class="links-header">
        <a href="#" class="btn-recrut">Espace Recruteur</a>
        <a href="#" class="btn-inscri"> <img src="../Assets/photos/icon-inscription.svg" alt="Inscription" width="30" height="30">Inscription</a>
        <a href="#" class="btn-compte"> <img src="../Assets/photos/icon-compte.svg" alt="mon compte" width="30" height="30"> Mon compte</a>
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
        <img src="../Assets/photos/condidat.png" alt="Image de contact">
    </div>
    <div class="contact-form">
        <h2>Create Post</h2>
        <form id="contact-form" name="ForumPost" method="post">
            <input type="text" name="title" id="title" placeholder="Post Title" value="<?php echo $post['post_title']; ?>">
            <span id="titleError" class="error-message"></span><br>

            <textarea name="content" id="content" placeholder="Post Content"><?php echo $post['post_content']; ?></textarea><br>
            <span id="contentError" class="error-message"></span><br>


            <input type="number" name="upVotes" id="upVotes" placeholder="Up Votes" value="<?php echo $post['up_votes']; ?>">
            <span id="upvoteError" class="error-message"></span><br>



            <input type="submit" value="Envoyer" name="Envoyer">
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
                <a href="#" class="link-footer">Espace Recruteur</a>
                <a href="#" class="link-footer">Mon Compte</a>
                <a href="#" class="link-footer">Nous Contacter</a>
            </div>
        </div>
        <div class="footer-social">
            <h3 class="titre-footer">Suivez-nous</h3>
            <div class="block-links-style-rs">
                <a href="#" class="link-footer-rs"><img src="../Assets/photos/fb.png" alt="Facebook"></a>
                <a href="#" class="link-footer-rs"><img src="../Assets/photos/insta.png" alt="Instagram"></a>
                <a href="#" class="link-footer-rs"><img src="../Assets/photos/linkidin.png" alt="LinkedIn"></a>
                <a href="#" class="link-footer-rs"><img src="../Assets/photos/twitter.png" alt="Twitter"></a>
            </div>
        </div>
    </div>
    <div class="copy-right">
        <p>Copyright © 2024 EasyRecruit</p>
    </div>
</footer>
<script src="../Assets/Post_form_validation.js"></script>



</body>
</html>
