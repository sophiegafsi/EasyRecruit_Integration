<?php
include_once __DIR__ . '\..\config\connexion.php';


class User {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }
   
    public function getUserById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE user_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT user_id, email, password, role, status FROM Users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function getUserDetails($userId, $role) {
        switch ($role) {
            case 'job_seeker':
                $sql = "SELECT name FROM JobSeekers WHERE user_id = ?";
                break;
            case 'employer':
                $sql = "SELECT company_name AS name FROM Employers WHERE user_id = ?";
                break;
            case 'admin':
                $sql = "SELECT role AS name FROM users WHERE user_id = ?";
                break;

        }
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
        return $stmt->fetch();
    }

    public function createUser($email, $password, $phone, $location, $role) {
        $stmt = $this->db->prepare("INSERT INTO users (email, password, phone, location, role, Join_date) VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->execute([$email, $password, $phone, $location, $role]);
        return $this->db->lastInsertId();
    }

    public function updateUser($id, $email, $password, $phone, $location, $role) {
        $stmt = $this->db->prepare("UPDATE users SET email = ?, password = ?, phone = ?, location = ?, role = ? WHERE user_id = ?");
        $stmt->execute([$email, $password, $phone, $location, $role, $id]);
        return $stmt->rowCount();
    }

    public function deleteUser($id) {
        // First, determine the role of the user to know from which table to delete first
        $roleCheckStmt = $this->db->prepare("SELECT role FROM users WHERE user_id = ?");
        $roleCheckStmt->execute([$id]);
        $roleResult = $roleCheckStmt->fetch();
        
        if ($roleResult) {
            $role = $roleResult['role'];
            // Depending on the role, delete from the corresponding table
            switch ($role) {
                case 'job_seeker':
                    $deleteStmt = $this->db->prepare("DELETE FROM jobseekers WHERE user_id = ?");
                    break;
                case 'employer':
                    $deleteStmt = $this->db->prepare("DELETE FROM employers WHERE user_id = ?");
                    break;
                default:
                    // Handle other roles or do nothing if needed
                    return 0;
            }
            $deleteStmt->execute([$id]);  // Execute deletion from jobseekers or employers
    
            // Now delete from users table
            $stmt = $this->db->prepare("DELETE FROM users WHERE user_id = ?");
            $stmt->execute([$id]);
            return $stmt->rowCount();  // Return the count of rows affected
        }
        return 0;  // Return 0 if no user found
    }
    

    public function authenticateUser($email, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
        $stmt->execute([$email, $password]);
        return $stmt->fetch();
    }
    public function toggleUserStatus($id) {
        $stmt = $this->db->prepare("UPDATE users SET status = NOT status WHERE user_id = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }
    public function toggleEmployerVerification($id) {
        $stmt = $this->db->prepare("UPDATE employers SET verified = NOT verified WHERE user_id = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }

    public function updateLastActive($userId) {
        $stmt = $this->db->prepare("UPDATE users SET Last_active = NOW() WHERE user_id = ?");
        $stmt->execute([$userId]);
    }
    
    public function fetchUserProfileData($userId) {
        $stmt = $this->db->prepare("SELECT email, phone, location FROM users WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function updateUserProfileData($userId, $email, $phone, $location) {
        $stmt = $this->db->prepare("UPDATE users SET email = ?, phone = ?, location = ? WHERE user_id = ?");
        $stmt->execute([$email, $phone, $location, $userId]);
        return $stmt->rowCount();
    }
    
}
?>
