<?php

include_once "../../Controller/PostController.php";
include_once '../../Model/CommentaireModel.php';
include_once "../../Controller/CommentaireController.php";
$IDpost = $_GET['id'];
$post = PostController::getPost($IDpost);
function insert_line_breaks($string, $interval) {
    // Break the string into segments of the specified interval
    $pattern = "/.{1,$interval}/";
    preg_match_all($pattern, $string, $matches);

    // Join the segments with a line break
    return implode("<br />", $matches[0]);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['commentaire-content'];
    if (!empty($content)) {
        $postId = $_POST['post_id'];
        $comment = new CommentaireModel(
            1,
            $content,
            new DateTime(),
            $postId
        );

        $commentController = new CommentaireController();
        $result = $commentController->addCommentaire($comment);

        if ($result) {

        } else {
            // Handle error
        }
    } else {
        // Handle validation error (content is empty)
    }

}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactez-nous</title>
    <link rel="stylesheet" href="../Assets/reclamation.css">
    <link rel="stylesheet" href="./assets/style.css">
    <style>
        .resolved-comment {
            color: #eb0000;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
        }
    </style>

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
            <a href="../BackOffice/AddTest.php" class="btn-decouvrir">découvrir plus</a>
        </div>
    </div>
</div>



<?php



    $comments = CommentaireController::getCommentsByPostId($IDpost);
    $commentsLength = count($comments);
    $isResolved = $post['is_resolved'];
    ?>

    <div class="fb-post" id="fpost0" style="background-color: <?= $isResolved ? 'lightgreen' : 'white'; ?>;">

        <!-- Top Section -->

        <div class="top-s">
            <div class="top-info">
                <div class="profile-picture">
                    <img src="./assets/assets/profile-pic.jpg">
                </div>
                <div class="top-title">
                    <div class="profile-name">
                        <a href="#">Melek Rabboudi</a>
                    </div>
                    <div class="post-time">
                        <span> <?php echo $post['created_at']?> </span>
                        <img src="./assets/svg/lock.svg">
                    </div>
                </div>
                <div class="top-options">
                    <div class="top-options">
                        <?php
                        echo '<a href="edit_post.php?id=' . $post['id'] . '" class="button-style">
                                <img src="./assets/assets/edit.png" width="30" alt="Edit">
                              </a>';
                        ?>
                        <?php
                        echo '<a href="delete_post.php?id=' . $post['id'] . '" class="button-style">
                                <img src="./assets/assets/delete.png" width="30" alt="Edit">
                              </a>';
                        ?>
                    </div>

                </div>
            </div>
            <div class="post-content">
                <strong> <?php echo $post['post_title']?> </strong><br />
                <br />
                <?php echo insert_line_breaks($post['post_content'], 40)?>
            </div>
        </div>

        <!-- Like section -->

        <div class="like-section">
            <div class="top-part">
                <div class="left-part">
                    <div class="react">
                        <img src="./assets/svg/love.svg" alt="">
                        <img src="./assets/svg/care.svg" alt="">
                        <img src="./assets/svg/like.svg" alt="">
                    </div>
                    <div class="id-name">
                        <p><span> <?php echo $post['up_votes'];?></span> votes</p>
                    </div>
                </div>
                <div class="right-part">
                    <p><span><?php echo $commentsLength; ?></span>Comments</p>
                </div>
            </div>
            <div class="bottom-part">
                <div class="like-btn" fpost="0">
                    <img src="./assets/svg/thumbs-up.svg" alt="">
                    <span>Like</span>
                </div>
                <div class="comment-btn" fpost="0">
                    <img src="./assets/svg/message-square.svg" alt="">
                    <span>Comment</span>
                </div>
                <div class="share-btn">
                    <img src="./assets/svg/share-2.svg" alt="">
                    <span>Share</span>
                </div>
            </div>
        </div>

        <!-- Comment section-->

        <div class="all-comments">
            <h4>All comments <img src="./assets/svg/sort-down.svg" class="all-comments-h4-i" alt=""></h4>
        </div>
        <?php

        foreach ($comments as $comment) {
            ?>
            <div class="comment-box">
                <div class="comment-container">
                    <div class="comment">
                        <img src="./assets/assets/maruf.jpg" alt="" class="comment-img">
                        <div class="comment-text">
                            <div class="comment-header">
                                <p><strong>Abdullah Al Maruf</strong></p>
                            </div>
                            <p><?php echo $comment->getContent(); ?></p>
                        </div>
                        <?php
                        echo '<a href="edit_commentaire.php?id=' . $post['id'] . '&idComment=' . $comment->getIdComment() . '" class="button-style">
                                <img src="./assets/assets/edit.png" width="30" alt="edit">
                              </a>';
                        ?>
                        <?php
                        echo '<a href="delete_comment.php?id=' . $post['id'] . '&idComment=' . $comment->getIdComment() . '" class="button-style">
                                <img src="./assets/assets/delete.png" width="30" alt="Delete">
                              </a>';
                        ?>

                    </div>
                    <div class="comment-lks">
                        <p>
                            <span>Like</span><span class="dot"> . </span>
                            <span>Reply</span><span class="dot"> . </span>
                            <span>Share</span><span class="dot"> . </span>
                            <span>2 m</span>
                        </p>
                    </div>
                </div>
            </div>
            <?php
        }

        ?>
        <?php if ($isResolved): ?>
            <p class="resolved-comment" >This post has been resolved.</p>
        <?php else: ?>
        <div class="comment-s">
            <div class="comment-area">
                <div class="comment-profile-pic">
                    <img src="./assets/assets/profile-pic.jpg" alt="user">
                </div>
                <div class="comment-input-area">
                    <form method="post" id="comment-form">
                        <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                        <input type="text" placeholder="Write a comment..." id="commentaire-content" name="commentaire-content">
                        <span id="comment-error" class="text-danger" style="color: red;"></span> <!-- Error message span -->
                        <button type="submit">Comment</button>
                    </form>
                    <div class="comment-icon">
                        <div class="icon-comment"><img src="./assets/svg/smile-1.svg" alt=""></div>
                        <div class="icon-comment"><img src="./assets/svg/camera.svg" alt=""></div>
                        <div class="icon-comment"><img src="./assets/svg/gif%20(1).svg" alt=""></div>
                        <div class="icon-comment"><img src="./assets/svg/circular-sticker.svg" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

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

<script src="./assets/script.js"></script>
<script>
    function validateComment(event) {
        const commentInput = document.getElementById('commentaire-content');
        const commentError = document.getElementById('comment-error');

        const comment = commentInput.value.trim();

        let hasError = false;

        if (comment === '') {
            commentError.textContent = 'Comment cannot be blank.';
            hasError = true;
        } else if (comment.length > 200) {
            commentError.textContent = 'Comment cannot be longer than 200 characters.';
            hasError = true;
        } else {
            const validPattern = /^[A-Za-z\s]*$/;
            if (!validPattern.test(comment)) {
                commentError.textContent = 'Comment cannot contain numbers or special characters.';
                hasError = true;
            }
        }
        if (hasError) {
            event.preventDefault();
        } else {
            commentError.textContent = '';
        }

        return !hasError;
    }
    document.getElementById('comment-form').onsubmit = validateComment;

</script>




</body>
