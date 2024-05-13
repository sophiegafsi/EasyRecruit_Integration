<?php
session_start();
require_once 'config/connexion.php';
require_once 'model/User.php';
require_once 'controller/UserController.php';




$userController = new UserController($pdo);

$result = $userController->login($_POST['email'], $_POST['password'], $_POST['captcha']);

if (isset($result['error'])) {
    header('Location: view/login.php?error=' . urlencode($result['error']));
    exit();
}

header('Location: ' . $result['redirect']);
exit();

