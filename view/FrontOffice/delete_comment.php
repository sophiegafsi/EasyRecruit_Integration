<?php
// Include the controller for handling comment-related actions
include_once __DIR__ . '/../../Controller/CommentaireController.php';

// Check if `idComment` is set in the query parameters and validate it
if (isset($_GET['idComment']) && is_numeric($_GET['idComment'])) {
    $idComment = (int) $_GET['idComment'];  // Convert to integer for safety

    // Create a new instance of CommentaireController
    $commentaireController = new CommentaireController();

    // Attempt to delete the comment with the given ID
    $result = $commentaireController->deleteComment($idComment);

    if ($result) {
        // If successful, redirect to the relevant page or show a success message
        echo "Comment deleted successfully.";
        // Redirect to a specific page, e.g., the post page
        header("Location: ShowPost.php?id=" . $_GET['id']);
        exit;
    } else {
        // If the deletion fails, display an error message
        echo "Error: Failed to delete comment.";
    }
} else {
    // If `idComment` is not set or invalid, handle the error
    echo "Error: Invalid comment ID.";
    // Optionally, redirect to an error page or the previous page
    header("Location: error_page.php");
    exit;
}
?>


