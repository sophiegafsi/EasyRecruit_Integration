<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    // Include the necessary files and establish database connection
    //include "Connection.php";
    include "../../Controller/PostController.php";

    // Get the post ID from the form data
    $postId = $_GET["id"];

    // Delete the post using the deletePost method from PostController
    try {
        $result = PostController::deletePost($postId);
        if ($result) {
            // Redirect back to the page displaying posts after deletion
            header("Location: AfficherPosts.php");
            exit();
        } else {
            echo "Error deleting post.";
        }
    } catch (PDOException $e) {
        // Handle any errors that occur during deletion
        echo "Error deleting post: " . $e->getMessage();
    }
} else {
    // Redirect to the main page if accessed directly without a POST request
    header("Location: AfficherPosts.php");
    exit();
}
?>

