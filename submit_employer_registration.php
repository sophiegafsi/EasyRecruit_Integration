<?php
require_once 'config/connexion.php';  // Database connection setup
require_once 'controller/UserController.php';
require_once 'controller/EmployerController.php';

// Collecting data from the form
$companyName = htmlspecialchars($_POST['company_name']);
$email = htmlspecialchars($_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encrypt the password
$phone = htmlspecialchars($_POST['phone']);
$location = htmlspecialchars($_POST['location']);
$category_id = (int) $_POST['category_id'];

$userController = new UserController($pdo);
$employerController = new EmployerController($pdo);

try {
    $pdo->beginTransaction();

    // Register user and get user_id
    $userId = $userController->register($email, $password, $phone, $location, 'employer');
    if (!$userId) {
        throw new Exception("Failed to create user account.");
    }
   

    // Register employer with the new user_id
    $employerSuccess = $employerController->registerEmployer($userId, $companyName, $category_id);
    if (!$employerSuccess) {
        throw new Exception("Failed to register employer details.");
    }

    $pdo->commit();
    echo 'Registration successful!';
    header('Location: index.php');
} catch (Exception $e) {
    $pdo->rollBack();
    echo 'Registration failed: ' . $e->getMessage();
}
?>

