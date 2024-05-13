<?php
include_once __DIR__ . '\..\model\JobSeeker.php';

class JobSeekerController {
    private $jobSeekerModel;

    public function __construct($pdo) {
        $this->jobSeekerModel = new JobSeeker($pdo);
    }

    public function registerJobSeeker($user_id, $name, $date_of_birth, $resume_url, $category_id, $subcategory_id) {
        return $this->jobSeekerModel->createJobSeeker($user_id, $name, $date_of_birth, $resume_url, $category_id, $subcategory_id);
    }

    public function updateProfile($user_id, $name, $date_of_birth, $resume_url, $category_id, $subcategory_id) {
        return $this->jobSeekerModel->updateJobSeeker($user_id, $name, $date_of_birth, $resume_url, $category_id, $subcategory_id);
    }

    public function getJobSeekerDetails($user_id) {
        return $this->jobSeekerModel->getJobSeekerByUserId($user_id);
    }

    public function deactivateJobSeeker($user_id) {
        return $this->jobSeekerModel->deleteJobSeeker($user_id);
    }

    public function listAllJobSeekers() {
        return $this->jobSeekerModel->getAllJobSeekers();
    }
    
}
?>
