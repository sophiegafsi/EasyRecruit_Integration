<?php
include_once __DIR__ . '\..\config\connexion.php';
include_once __DIR__ . '\..\model\CommentaireModel.php';

class CommentaireController {

    public function addCommentaire(CommentaireModel $comment) : bool
    {
        // Get a PDO connection
        $pdo = Connection::getConnection();

        // Prepare an SQL statement for inserting a new comment
        $sql = "INSERT INTO commentaire (user_id, content, created_at, idPost) VALUES (:user_id, :content, :created_at, :idPost)";

        // Prepare the statement
        $stmt = $pdo->prepare($sql);

        // Store model data in variables
        $userId = $comment->getIdUser();
        $content = $comment->getContent();
        $createdAt = $comment->getCreatedAt()->format('Y-m-d H:i:s');
        $idPost = $comment->getIdPost();

        // Bind the variables to the statement
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->bindParam(':created_at', $createdAt, PDO::PARAM_STR);
        $stmt->bindParam(':idPost', $idPost, PDO::PARAM_INT);

        try {
            // Execute the statement
            $result = $stmt->execute();
            if ($result) {
                // Return true if insertion is successful
                return true;
            } else {
                // Return false if something goes wrong
                return false;
            }
        } catch (PDOException $e) {
            // Handle exception
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function incrementUpvotes(int $commentId): bool {
        try {
            // Get a PDO connection
            $pdo = Connection::getConnection();

            // Prepare a SQL UPDATE query to increment upvotes by 1
            $sql = "UPDATE commentaire SET upvotes = upvotes + 1 WHERE id = :commentId";

            // Prepare the statement
            $stmt = $pdo->prepare($sql);

            // Bind the comment ID to the SQL query
            $stmt->bindParam(':commentId', $commentId, PDO::PARAM_INT);

            // Execute the statement
            $result = $stmt->execute();

            // Return true if the update is successful
            return $result;
        } catch (PDOException $e) {
            // Handle exceptions and return false if an error occurs
            error_log("Error incrementing upvotes: " . $e->getMessage());
            return false;
        }
    }
    public function deleteComment(int $commentId): bool {
        try {
            // Get a PDO instance from the Connection class
            $pdo = Connection::getConnection();

            // Prepare a SQL DELETE query
            $stmt = $pdo->prepare("DELETE FROM commentaire WHERE id = :commentId");

            // Bind the parameter to prevent SQL injection
            $stmt->bindParam(':commentId', $commentId, PDO::PARAM_INT);

            // Execute the query
            $result = $stmt->execute();

            // Return true if the deletion is successful
            return $result;
        } catch (PDOException $e) {
            // Handle errors if any occur
            error_log("Error deleting comment: " . $e->getMessage());
            return false;
        }
    }
    static function getCommentsByPostId(int $postId): array {
        // Initialize an empty array to store comments
        $comments = [];

        try {
            // Get a PDO instance from the Connection class
            $pdo = Connection::getConnection();

            // Prepare the SQL query
            $stmt = $pdo->prepare("SELECT * FROM commentaire WHERE idPost = :postId");

            // Bind the parameter to prevent SQL injection
            $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);

            // Execute the query
            $stmt->execute();

            // Fetch all results as associative arrays
            $commentData = $stmt->fetchAll();

            // Loop through the results and create CommentaireModel objects
            foreach ($commentData as $row) {
                $comment = new CommentaireModel(
                    $row['user_id'],
                    $row['content'],
                    new DateTime($row['created_at']),
                    $row['idPost']
                );

                // Set the ID for the comment
                $comment->setIdComment($row['id']);

                // Add the comment object to the comments array
                $comments[] = $comment;
            }
        } catch (PDOException $e) {
            // Handle errors if any occur
            error_log("Error fetching comments: " . $e->getMessage());
        }

        return $comments; // Return the array of CommentaireModel objects
    }

    static function getCommentsById(int $Id): array {
        // Initialize an empty array to store comments
        $comments = [];

        try {
            // Get a PDO instance from the Connection class
            $pdo = Connection::getConnection();

            // Prepare the SQL query
            $stmt = $pdo->prepare("SELECT * FROM commentaire WHERE idPost = :Id");

            // Bind the parameter to prevent SQL injection
            $stmt->bindParam(':Id', $Id, PDO::PARAM_INT);

            // Execute the query
            $stmt->execute();

            // Fetch all results as associative arrays
            $commentData = $stmt->fetchAll();

            // Loop through the results and create CommentaireModel objects
            foreach ($commentData as $row) {
                $comment = new CommentaireModel(
                    $row['user_id'],
                    $row['content'],
                    new DateTime($row['created_at']),
                    $row['idPost']
                );

                // Set the ID for the comment
                $comment->setIdComment($row['id']);

                // Add the comment object to the comments array
                $comments[] = $comment;
            }
        } catch (PDOException $e) {
            // Handle errors if any occur
            error_log("Error fetching comments: " . $e->getMessage());
        }

        return $comments; // Return the array of CommentaireModel objects
    }
}
