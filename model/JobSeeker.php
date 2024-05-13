<?php

include_once __DIR__ . '\..\config\connexion.php';


class JobSeeker {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function createJobSeeker($user_id, $name, $date_of_birth, $resume_url, $category_id = null, $subcategory_id = null) {
        $stmt = $this->db->prepare("INSERT INTO jobseekers (user_id, name, date_of_birth, resume_url, category_id, subcategory_id) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$user_id, $name, $date_of_birth, $resume_url, $category_id, $subcategory_id]);
        return $this->db->lastInsertId();
    }

    public function getJobSeekerByUserId($user_id) {
        $stmt = $this->db->prepare("SELECT * FROM jobseekers WHERE user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetch();
    }

    public function updateJobSeeker($user_id, $name, $date_of_birth, $resume_url, $category_id, $subcategory_id) {
        $stmt = $this->db->prepare("UPDATE jobseekers SET name = ?, date_of_birth = ?, resume_url = ?, category_id = ?, subcategory_id = ? WHERE user_id = ?");
        $stmt->execute([$name, $date_of_birth, $resume_url, $category_id, $subcategory_id, $user_id]);
        return $stmt->rowCount();
    }

    public function deleteJobSeeker($user_id) {
        $stmt = $this->db->prepare("DELETE FROM jobseekers WHERE user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->rowCount();
    }

    public function getAllJobSeekers() {
        $sql = "SELECT js.*, u.email, u.phone, u.location, u.role, u.Join_date, u.Last_active, u.Status 
                FROM jobseekers js
                INNER JOIN users u ON js.user_id = u.user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getJobSeekersByEmployerCategory($employerCategoryId) {
        $sql = "SELECT j.name, j.date_of_birth, j.resume_url, s.name AS subcategory_name, u.email, u.phone, u.location 
                FROM jobseekers j
                JOIN users u ON j.user_id = u.user_id
                JOIN subcategories s ON j.subcategory_id = s.subcategory_id
                WHERE j.category_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$employerCategoryId]);
        return $stmt->fetchAll();
    }

    public function countJobSeekersByCategory() {
        $sql = "SELECT c.name, COUNT(*) as count FROM jobseekers js
                JOIN categories c ON js.category_id = c.category_id
                GROUP BY js.category_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function toggleVerified($userId) {
        $stmt = $this->db->prepare("UPDATE jobseekers SET Verified = NOT Verified WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->rowCount();
    }

    
}
?>
