<?php
require_once '../controller/EmployerController.php';
require_once '../controller/UserController.php';
require_once '../controller/CategoryController.php';
require_once '../config/connexion.php';
session_start();

$employerController = new EmployerController($pdo);
$categoryModel = new Category($pdo);
$user_id = $_SESSION['user_id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $company_name = $_POST['company_name'] ?? '';
    $description = $_POST['description'] ?? '';
    $category_id = $_POST['category_id'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $location = $_POST['location'] ?? '';   
    $Active_Jobs = $_POST['Active_Jobs'] ?? '';
    $application_count = $_POST['application_count'] ?? '';
    $logo = $_FILES['logo']['tmp_name'] ? file_get_contents($_FILES['logo']['tmp_name']) : null;

    // Update Employer details

    $employerController->updateEmployerProfile($user_id, $company_name, $description, $category_id, $email, $phone, $location,$Active_Jobs,$application_count);
   
   if($logo){
    $updateSuccess = $employerController->changeLogo($user_id, $logo);

   }

    
    // Update User details
    if ($logo){
        echo "<script>alert('Profile updated successfully!');</script>";
    } else {
        echo "<script>alert('Updated successfuly ( logo not updated )');</script>";
    }
    // Refresh to get updated data
}

$employerDetails = $employerController->getEmployerProfile($user_id);
$categories = $categoryModel->getAllCategories();
$logoData = $employerController->fetchLogo($user_id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employer Profile - EasyRecruit</title>
    <link rel="stylesheet" href="../assets/css/recruiter_space.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h1>Dashboard</h1>
            <a href="recruiter_space.php">Home</a>
            <a href="manage_jobs.php">Manage Jobs</a>
            <a href="view_applications.php">Applications</a>
            <a href="update_profile.php" class="active">Profile</a>
            <a href="../index.php">Return</a>
            <a href="../index.php?url=logout">Logout</a>
        </div>

        <div class="main-content">
            <form  method="POST" enctype="multipart/form-data">
                <div class="profile-card">
                    <?php if ($employerDetails): ?><?php if ($logoData) {
    echo '<img src="data:image/jpeg;base64,' . base64_encode($logoData) . '" alt="Company Logo">';
}   ?>
                    <input type="file" name="logo">
                    <input type="text" name="company_name" value="<?= htmlspecialchars($employerDetails['company_name']) ?>">
                    <textarea name="description"><?= htmlspecialchars($employerDetails['description']) ?></textarea>
                    <select name="category_id">
                        <?php
                        foreach ($categories as $category) {
                            $selected = $category['category_id'] == $employerDetails['category_id'] ? 'selected' : '';
                            echo "<option value='{$category['category_id']}' {$selected}>{$category['name']}</option>";
                        }
                        ?>
                    </select>
                    <input type="email" name="email" value="<?= htmlspecialchars($employerDetails['email']) ?>">
                    <input type="text" name="phone" value="<?= htmlspecialchars($employerDetails['phone']) ?>">
                    <input type="text" name="location" value="<?= htmlspecialchars($employerDetails['location']) ?>">
                    <?php else: ?>
                    <p>No company details available. Please update your profile.</p>
                    <?php endif; ?>
                </div>
                <div class="stats">
                    <div class="stat-box">
                        <p class="text-primary">  <input type="text" name="Active_Jobs" value="<?= htmlspecialchars($employerDetails['Active_Jobs'] ?? '0') ?>"></p>
                        <p>Active Jobs</p>
                    </div>
                    <div class="stat-box">
                    <p class="text-primary">  
                        <input type="text" name="application_count" value="<?= htmlspecialchars($employerDetails['application_count'] ?? '0') ?>"></p>
                        <p>Applications Received</p>
                    </div>
                </div>
                <input type="submit" value="Update Profile">
            </form>
        </div>
    </div>
    <script src="path_to_your_js/dashboard_functions.js"></script>
</body>
</html>
