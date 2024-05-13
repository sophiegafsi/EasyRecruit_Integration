<?php


$request = $_GET['url'] ?? '';

switch ($request) {
    case '':
        // Include the home.php that will in turn load index.html
        header('Location: view/home/home.php');
        break;
    case 'user':
        $controller = new UserController();
        $controller->show($_GET['id']);
        break;
        
    case 'register':
        // Serve the registration choice page
        header('Location: view/register.php');

        break;

    case 'login':
        // Serve the registration choice page
        header('Location: view/login.php');

        break;
        
    case 'logout':
        // Serve the registration choice page
        header('Location: logout.php');

        break;

    case 'Espace_perso':
        session_start();
            switch ($_SESSION['role']) {
                case 'job_seeker':
                    header('Location: view/face_verification.php');
                    exit;
                case 'employer':
                    header('Location: view/recruiter_space.php');
                    exit;
                case 'admin':
                    header('Location: view/backoffice/dashboard.php');
                    exit;
                default:
                    // Default action if role is not recognized
                    header('Location: view/login.php');
                    exit;
            }
        
        break;
    default:
       ;
}

?>