<?php
require 'config/connexion.php'; // Ensure this points to your database connection config

function fetchUsersByRole($role) {
    global $pdo;
    $sql = "SELECT user_id, email, role FROM Users WHERE role = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$role]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Default role to fetch if none is selected
$role = isset($_GET['role']) ? $_GET['role'] : 'job_seeker'; 
$users = fetchUsersByRole($role);

?>