<?php
include_once __DIR__ . '\..\model\User.php';

class UserController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
    }

  
    public function login($email, $password, $captcha) {
        if ($_SESSION['captcha'] !== $captcha) {
            return ['error' => 'Captcha invalid.'];
        }
        
        $user = $this->userModel->findByEmail($email);
      
        if (!$user) {
            return ['error' => 'Email does not exist.'];
        }
        if ($user['status'] == 0) { 
            return ['error' => 'Your account is suspended. Contact admin for more info.'];
        }
        if (!password_verify($password, $user['password'])) {
            return ['error' => 'Incorrect password.'];
        }
        $this->userModel->updateLastActive($user['user_id']);

        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['logged_in'] = true;

        $detail = $this->userModel->getUserDetails($user['user_id'], $user['role']);
        $_SESSION['username'] = $detail['name'] ? $detail['name'] : 'Unknown';

        // Redirect based on role
        return ['redirect' => $this->redirectBasedOnRole($user['role'])];
    }

    private function redirectBasedOnRole($role) {
        switch ($role) {
            case 'admin':
                return 'view/backoffice/dashboard.php';
            default:
                return 'index.php';
        }
    }
    public function logout() {
        session_destroy();
        header("Location: login.php");
    }

    public function register($email, $password, $phone, $location, $role) {
         return $this->userModel->createUser($email, $password, $phone, $location, $role);
         
    }

    public function editProfile($user_id, $email, $password, $phone, $location, $role) {
        return $this->userModel->updateUser($user_id, $email, $password, $phone, $location, $role);
    }

    public function deactivateAccount($user_id) {
        return $this->userModel->deleteUser($user_id);
    }
    public function toggleStatus($user_id) {
        return $this->userModel->toggleUserStatus($user_id);
    }

    public function toggleVerification($user_id) {
        return $this->userModel->toggleEmployerVerification($user_id);
    }
    public function updateUserProfile($userId, $email, $phone, $location) {
        return $this->userModel->updateUserProfileData($userId, $email, $phone, $location);
    }
    
}
?>
