<?php
include "../../Controller/PostController.php";
$idPost = $_GET['id'];
$postController = new PostController();
$result = $postController->setPostStatusToResolved($idPost);
if ($result) {
    header("Location: AfficherPosts.php");
    exit;
} else {
    echo "Error: Failed to toggle post status.";
}
?>