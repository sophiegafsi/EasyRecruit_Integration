<?php


include_once __DIR__ . '\..\config\connexion.php';

class Category {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function createCategory($name) {
        $stmt = $this->db->prepare("INSERT INTO categories (name) VALUES (?)");
        $stmt->execute([$name]);
        return $this->db->lastInsertId();
    }

    public function getCategoryById($id) {
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE category_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function updateCategory($id, $name) {
        $stmt = $this->db->prepare("UPDATE categories SET name = ? WHERE category_id = ?");
        $stmt->execute([$name, $id]);
        return $stmt->rowCount();
    }

    public function deleteCategory($id) {
        $stmt = $this->db->prepare("DELETE FROM categories WHERE category_id = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }

    public function getAllCategories() {
        $stmt = $this->db->prepare("SELECT * FROM categories");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>
