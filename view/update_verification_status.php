<?php
session_start();

require_once '../model/jobseeker.php';
require_once '../config/connexion.php';
$jobSeekerModel = new JobSeeker($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $verified = $data['verified'] ?? false;
    $userId = $_SESSION['user_id'];

    if ($verified) {
        $jobSeekerModel->toggleVerified($userId);
        echo json_encode(['message' => 'User verified successfully']);
    } else {
        echo json_encode(['message' => 'Failed to verify']);
    }
}

header('Location: ../view/face_verification.php'); // Redirect to login page
?>
