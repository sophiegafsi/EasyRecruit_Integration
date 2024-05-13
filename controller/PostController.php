
<?php

include_once __DIR__ . '\..\config\connexion.php';
include_once __DIR__ . '\..\Model\PostModel.php';

class PostController {

    static function getPosts() {
        $query = "SELECT 
    idPost AS id,
    TITRE AS post_title,
    Content AS post_content,
    Create_At AS created_at,
    Updated_At AS updated_at,
    Upvote AS up_votes,
    Status AS status ,
    user_id AS user_id ,
    is_resolved AS is_resolved
FROM 
    Post;
";

        $db = Connection::getConnection(); // Correct the class name if it's Connection
        return $db->query($query)->fetchAll();
    }

    public static function getPostsPaginator($limit = 5, $offset = 0) {
        $query = "SELECT 
            idPost AS id,
            TITRE AS post_title,
            Content AS post_content,
            Create_At AS created_at,
            Updated_At AS updated_at,
            Upvote AS up_votes,
            Status AS status,
            user_id AS user_id,
            is_resolved AS is_resolved
        FROM 
            Post
        ORDER BY 
            idPost DESC
        LIMIT :limit OFFSET :offset"; // Adding LIMIT and OFFSET

        $db = Connection::getConnection();

        $stmt = $db->prepare($query);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getTotalPosts() {
        $query = "SELECT COUNT(*) AS total FROM Post";
        $db = Connection::getConnection();
        $result = $db->query($query)->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    static function getPost($id) {
        $query = "SELECT idPost AS id,
                    TITRE AS post_title,
                    Content AS post_content,
                    Create_At AS created_at,
                    Updated_At AS updated_at,
                    Upvote AS up_votes,
                    Status AS status,
                    user_id AS user_id ,
                    is_resolved AS is_resolved
                        FROM Post WHERE idPost = $id";
        $db = Connection::getConnection();
        return $db->query($query)->fetch();
    }

    public static function incrementUpvotes(int $postId): bool {
        try {
            // Get a PDO connection
            $db = Connection::getConnection();

            // Prepare a SQL UPDATE query to increment upvotes by 1
            $query = "UPDATE Post SET Upvote = Upvote + 1 WHERE idPost = :postId";

            // Prepare the statement
            $stmt = $db->prepare($query);

            // Bind the post ID to the query to avoid SQL injection
            $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);

            // Execute the statement
            $result = $stmt->execute();

            // Return true if the operation is successful
            return $result;
        } catch (PDOException $e) {
            // Handle exceptions
            error_log("Error incrementing upvotes for post ID {$postId}: " . $e->getMessage());
            return false;  // Return false if there's an error
        }
    }

    static function addPost(PostModel $post) {
        try {
            // Get a database connection
            $db = Connection::getConnection(); // Correct the class name if it's Connection

            $query = "INSERT INTO post (user_id ,TITRE, Content, Create_At, Updated_At,Upvote,Status,is_resolved) VALUES (:user_id ,:title, :content, :createdAt, :updatedAt, :upVotes ,:status,:is_resolved)";
            $req = $db->prepare($query);

            $createdAt = $post->getCreatedAt()->format('Y-m-d H:i:s');
            $updatedAt = $post->getUpdatedAt()->format('Y-m-d H:i:s');
            // Execute the query with the provided parameters from the PostModel object
            $req->execute([
                'user_id' => $post->getIdAuthor(),
                'title' => $post->getTitle(),
                'content' => $post->getContent(),
                'createdAt' => $createdAt,
                'updatedAt' => $updatedAt,
                'upVotes' => $post->getUpVotes(),
                'status' => false,
                'is_resolved' => $post->isIsResolved()
            ]);

            // Optionally, you can return the ID of the inserted post
            return $db->lastInsertId();
        } catch (Exception $e) {
            // Handle any exceptions that occur during the process
            echo $e->getMessage(); // You might want to log the error instead of echoing it
        }
    }

    static function updatePost($id, $title, $content, $Upvote) {
        $query = "UPDATE Post SET TITRE = '$title', Content = '$content' , Upvote = '$Upvote' WHERE idPost = $id";
        $db = Connection::getConnection(); // Correct the class name if it's Connection
        return $db->exec($query);
    }
    public static function togglePostStatus(int $postId): bool {
        try {
            // Get the current status of the post
            $db = Connection::getConnection();
            $stmt = $db->prepare("SELECT status FROM Post WHERE idPost = :postId");
            $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);
            $stmt->execute();
            $currentStatus = $stmt->fetchColumn();  // Fetch the current status

            // Determine the new status by toggling the current status
            $newStatus = ($currentStatus == 'true') ? 'false' : 'true';

            // Update the status in the Post table
            $updateStmt = $db->prepare("UPDATE Post SET status = :newStatus WHERE idPost = :postId");
            $updateStmt->bindParam(':newStatus', $newStatus, PDO::PARAM_STR);
            $updateStmt->bindParam(':postId', $postId, PDO::PARAM_INT);

            // Execute the update
            $result = $updateStmt->execute();

            return $result;  // Return true if the update is successful
        } catch (PDOException $e) {
            error_log("Error toggling post status: " . $e->getMessage());
            return false;  // Return false if an error occurs
        }
    }

    public static function setPostStatusToTrue(int $postId): bool {
        try {
            $db = Connection::getConnection();
            $stmt = $db->prepare("UPDATE Post SET Status = 1 WHERE idPost = :postId");
            $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);
            $result = $stmt->execute();
            return $result;
        } catch (PDOException $e) {
            error_log("Error updating post status to 'true': " . $e->getMessage());
            return false;
        }
    }

    public static function setPostStatusToResolved(int $postId): bool {
        try {
            $db = Connection::getConnection();
            $stmt = $db->prepare("UPDATE Post SET is_resolved = 1 WHERE idPost = :postId");
            $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);
            $result = $stmt->execute();
            return $result;
        } catch (PDOException $e) {
            error_log("Error updating post status to 'true': " . $e->getMessage());
            return false;
        }
    }

    public static function setPostStatusToUnResolved(int $postId): bool {
        try {
            $db = Connection::getConnection();
            $stmt = $db->prepare("UPDATE Post SET is_resolved = 0 WHERE idPost = :postId");
            $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);
            $result = $stmt->execute();
            return $result;
        } catch (PDOException $e) {
            error_log("Error updating post status to 'true': " . $e->getMessage());
            return false;
        }
    }

    static function deletePost($id) {
        $query = "DELETE FROM post WHERE idPost = $id";
        $db = Connection::getConnection(); // Correct the class name if it's Connection
        return $db->exec($query);
    }

    public static function getConfirmedPostsCount() {
        $db = Connection::getConnection();
        $query = "SELECT COUNT(*) as count FROM post WHERE status = 1";
        $result = $db->query($query)->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }
    public static function getNotConfirmedPostsCount() {
        $db = Connection::getConnection();
        $query = "SELECT COUNT(*) as count FROM post WHERE status = 0";
        $result = $db->query($query)->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }

    public static function getPostsWithMostComments() {
        $db = Connection::getConnection();
        $query = "SELECT p.TITRE as title, COUNT(c.id) as comment_count
                  FROM post p
                  LEFT JOIN commentaire c ON p.idPost = c.idPost
                  GROUP BY p.idPost
                  ORDER BY comment_count DESC
                  LIMIT 5"; // Top 5 posts with the most comments
        return $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getPostsGroupedByDate() {
        $db = Connection::getConnection();
        $query = "SELECT DATE(Create_At) as date, COUNT(*) as count
                  FROM post
                  GROUP BY date
                  ORDER BY date ASC";
        return $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>