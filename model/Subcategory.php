<?php

include_once __DIR__ . '\..\config\connexion.php';


class Subcategory {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function createSubcategory($category_id, $name) {
        $stmt = $this->db->prepare("INSERT INTO subcategories (category_id, name) VALUES (?, ?)");
        $stmt->execute([$category_id, $name]);
        return $this->db->lastInsertId();
    }

    public function getSubcategoryById($id) {
        $stmt = $this->db->prepare("SELECT * FROM subcategories WHERE subcategory_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function updateSubcategory($id, $category_id, $name) {
        $stmt = $this->db->prepare("UPDATE subcategories SET category_id = ?, name = ? WHERE subcategory_id = ?");
        $stmt->execute([$category_id, $name, $id]);
        return $stmt->rowCount();
    }

    public function deleteSubcategory($id) {
        $stmt = $this->db->prepare("DELETE FROM subcategories WHERE subcategory_id = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }

    public function getSubcategoriesByCategoryId($category_id) {
        $stmt = $this->db->prepare("SELECT * FROM subcategories WHERE category_id = ?");
        $stmt->execute([$category_id]);
        return $stmt->fetchAll();
    }
}