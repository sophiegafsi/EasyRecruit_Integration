<?php
include_once __DIR__ . '\..\model\Subcategory.php';

class SubcategoryController {
    private $subcategoryModel;

    public function __construct($pdo) {
        $this->subcategoryModel = new Subcategory($pdo);
    }

    public function addSubcategory($category_id, $name) {
        return $this->subcategoryModel->createSubcategory($category_id, $name);
    }

    public function listSubcategoriesByCategory($category_id) {
        return $this->subcategoryModel->getSubcategoriesByCategoryId($category_id);
    }

    public function editSubcategory($id, $category_id, $name) {
        return $this->subcategoryModel->updateSubcategory($id, $category_id, $name);
    }

    public function deleteSubcategory($id) {
        return $this->subcategoryModel->deleteSubcategory($id);
    }
}
?>
