<?php
include_once __DIR__ . '\..\model\Employer.php';

class EmployerController {
    private $employerModel;

    public function __construct($pdo) {
        $this->employerModel = new Employer($pdo);
    }

    public function registerEmployer($user_id, $company_name, $category_id) {
        return $this->employerModel->createEmployer($user_id, $company_name, $category_id);
    }

    public function updateProfile($user_id, $company_name, $category_id, $verified) {
        return $this->employerModel->updateEmployer($user_id, $company_name, $category_id, $verified);
    }

    public function getEmployerDetails($user_id) {
        return $this->employerModel->getEmployerByUserId($user_id);
    }

    public function verifyEmployer($user_id) {
        return $this->updateProfile($user_id, null, null, 1);  // Assuming nulls won't update other fields
    }

    public function deactivateEmployer($user_id) {
        return $this->employerModel->deleteEmployer($user_id);
    }

    public function listAllEmployers() {
        return $this->employerModel->getAllEmployers();
    }

  
    public function getEmployerProfile($userId) {
        return $this->employerModel->fetchEmployerProfileData($userId);
    }

    public function updateEmployerProfile($userId, $companyName, $description, $categoryId, $email, $phone, $location,$Active_Jobs,$application_count) {
        return $this->employerModel->updateEmployerProfileData($userId, $companyName, $description, $categoryId, $email, $phone, $location,$Active_Jobs,$application_count);
    }

    public function fetchLogo($userId) {
        return $this->employerModel->getLogo($userId);
    }

    public function changeLogo($userId, $logo) {
        return $this->employerModel->updateLogo($userId, $logo);
    }
    
    
    
}
?>
