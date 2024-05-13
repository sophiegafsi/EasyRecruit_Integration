<?php
session_start();
require_once 'C:\xampp\htdocs\EasyRecruit_User\config\connexion.php';
require_once 'C:\xampp\htdocs\EasyRecruit_User\controller\UserController.php';
require_once 'C:\xampp\htdocs\EasyRecruit_User\controller\EmployerController.php';

$userController = new UserController($pdo);

$action = $_POST['action'] ?? '';
$user_id = $_POST['user_id'] ?? 0;

switch ($action) {
    case 'delete':
        $userController->deactivateAccount($user_id);
        break;
    case 'toggle_verify':
        $userController->toggleVerification($user_id);
        break;
    case 'toggle_status':
        $userController->toggleStatus($user_id);
        break;
    default:
        header("Location: /EasyRecruit_User/view/backoffice/user.php"); 
        break;
}

header("Location: /EasyRecruit_User/view/backoffice/user.php");  // Redirect back to the dashboard
exit;
