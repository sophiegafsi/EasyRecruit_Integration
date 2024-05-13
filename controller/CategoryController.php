<?php
include_once '../model/Category.php';

class CategoryController {
    private $categoryModel;

    public function __construct() {
        $this->categoryModel = new Category();
    }

    public function addCategory($name) {
        return $this->categoryModel->createCategory($name);
    }

    public function editCategory($id, $name) {
        return $this->categoryModel->updateCategory($id, $name);
    }

    public function deleteCategory($id) {
        return $this->categoryModel->deleteCategory($id);
    }

    public function listCategories() {
        return $this->categoryModel->getAllCategories();
    }
}
?>


