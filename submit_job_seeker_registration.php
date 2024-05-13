<?php
require_once 'config/connexion.php';  // Assuming this is your PDO connection setup
require_once 'controller/UserController.php';
require_once 'controller/JobSeekerController.php';

// Collecting data from the form
$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$phone = htmlspecialchars($_POST['phone']);
$location = htmlspecialchars($_POST['location']);
$dateOfBirth = htmlspecialchars($_POST['date_of_birth']);
$resumeUrl = htmlspecialchars($_POST['resume_url']);
$category_id = isset($_POST['category_id']) ? (int)$_POST['category_id'] : null;
$subcategory_id = isset($_POST['subcategory_id']) ? (int)$_POST['subcategory_id'] : null;

$userController = new UserController($pdo);
$jobSeekerController = new JobSeekerController($pdo);

try {
    $pdo->beginTransaction();

    // Register user and get user_id
    $userId = $userController->register($email, $password, $phone, $location, 'job_seeker');
    if (!$userId) {
        throw new Exception("Failed to create user account.");
    }

    // Register job seeker with additional details
    $jobSeekerSuccess = $jobSeekerController->registerJobSeeker($userId, $name, $dateOfBirth, $resumeUrl, $category_id, $subcategory_id);
    if (!$jobSeekerSuccess) {
        throw new Exception("Failed to register job seeker details.");
    }

    $pdo->commit();
    echo 'Registration successful!';
    header('Location: index.php');
} catch (Exception $e) {
    $pdo->rollBack();
    die('Registration failed: ' . $e->getMessage());
}
?>
