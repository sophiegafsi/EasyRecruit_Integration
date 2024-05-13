<?php
include_once __DIR__ . '\..\config\connexion.php';

class Employer {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function createEmployer($user_id, $company_name, $category_id, $verified = 0) {
        $stmt = $this->db->prepare("INSERT INTO employers (user_id, company_name, category_id, Verified) VALUES (?, ?, ?, ?)");
        $stmt->execute([$user_id, $company_name, $category_id, $verified]);
        return $this->db->lastInsertId();
    }

    public function getEmployerByUserId($user_id) {
        $stmt = $this->db->prepare("SELECT * FROM employers WHERE user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetch();
    }

    public function updateEmployer($user_id, $company_name, $category_id, $verified) {
        $stmt = $this->db->prepare("UPDATE employers SET company_name = ?, category_id = ?, Verified = ? WHERE user_id = ?");
        $stmt->execute([$company_name, $category_id, $verified, $user_id]);
        return $stmt->rowCount();
    }

    public function deleteEmployer($user_id) {
        $stmt = $this->db->prepare("DELETE FROM employers WHERE user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->rowCount();
    }

    public function getAllEmployers() {
        $sql = "SELECT e.*, u.email, u.phone, u.location, u.role, u.Join_date, u.Last_active, u.Status 
                FROM employers e
                INNER JOIN users u ON e.user_id = u.user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function fetchEmployerProfileData($userId) {
        $stmt = $this->db->prepare("SELECT e.company_name, e.description, e.category_id, e.Active_Jobs ,e.application_count, u.email, u.phone, u.location 
                                    FROM employers e 
                                    JOIN users u ON e.user_id = u.user_id 
                                    WHERE e.user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateEmployerProfileData($userId, $companyName, $description, $categoryId, $email, $phone, $location,$Active_Jobs,$application_count) {
        // Update user data
        $userStmt = $this->db->prepare("UPDATE users SET email = ?, phone = ?, location = ? WHERE user_id = ?");
        $userStmt->execute([$email, $phone, $location, $userId]);
    
        // Update employer data
        $employerStmt = $this->db->prepare("UPDATE employers SET company_name = ?,Active_Jobs = ?,application_count = ?, description = ?, category_id = ? WHERE user_id = ?");
        $employerStmt->execute([$companyName,$Active_Jobs,$application_count, $description, $categoryId, $userId]);
        
        return $employerStmt->rowCount();
    }

    public function getLogo($userId) {
        $stmt = $this->db->prepare("SELECT logo FROM employers WHERE user_id = ?");
        $stmt->execute([$userId]);
        $result = $stmt->fetch();
        return $result ? $result['logo'] : null; // Returns the binary data of the logo
    }

    public function updateLogo($userId, $logo) {
        $stmt = $this->db->prepare("UPDATE employers SET logo = ? WHERE user_id = ?");
        $stmt->execute([$logo, $userId]);
        return $stmt->rowCount(); // Returns the number of affected rows
    }
   
    public function countEmployersByCategory() {
        $sql = "SELECT c.name, COUNT(*) as count FROM employers e
                JOIN categories c ON e.category_id = c.category_id
                GROUP BY e.category_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
        
    
    
}
?>
