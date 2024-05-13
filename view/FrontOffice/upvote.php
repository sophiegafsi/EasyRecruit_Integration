<?php
include_once __DIR__ . '/../../Controller/PostController.php';
$idPost = $_GET['postId'];
//$commentId = $_GET['post_id'];
$postController = new PostController();
//echo  $commentId;
$result = $postController->incrementUpvotes($idPost);
if ($result) {
//    header("Location: ShowPost.php?id=" . $idPost);
    header("Location: AfficherPosts.php");
    exit;
} else {
    echo "Error: Failed to upvote comment.";
}