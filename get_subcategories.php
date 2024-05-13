<?php
require_once 'config/connexion.php';
require_once 'controller/SubcategoryController.php';

  // Get the category ID from POST request
  $category_id = $_POST['category_id'] ?? 1;
  $subCategoryModel = new SubcategoryController($pdo);
$subcategories = $subCategoryModel->listSubcategoriesByCategory($category_id);
$subcategories = is_array($subcategories) ? $subcategories : [$subcategories];  // Wrap single object in an array
$subcategories = $subcategories ?? [];  // Ensure null results become an empty array

header('Content-Type: application/json');
echo json_encode($subcategories);
?>