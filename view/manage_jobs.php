<?php

    require_once '../model/JobOffer.php';
    require_once '../controller/front/HomepageController.php';
    require_once '../model/JobSeeker.php';
    require_once '../controller/EmployerController.php';
    require_once '../config/connexion.php';
    session_start();
    $employerController = new EmployerController($pdo);
    $jobSeekerModel = new JobSeeker($pdo);
    $employerModel = new Employer($pdo);
    $user_id = $_SESSION['user_id'] ?? null; // Ensure you start the session at the beginning of your script

    $employerDetails = $employerController->getEmployerDetails($user_id);
    $employerAll = $employerModel->fetchEmployerProfileData($user_id);
    $jobSeekers = $jobSeekerModel->getJobSeekersByEmployerCategory($employerAll['category_id']);


    

    $job_offer = new JobOffer();
    $job_offers = $job_offer->getJobOffersByEmployerId($user_id);

    ?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recruiter Dashboard - EasyRecruit</title>
    <link rel="stylesheet" href="../assets/css/recruiter_space.css">
    <link rel="stylesheet" href="css/custom.css">
    
</head>
<body>
   
    <div class="container">
        <!-- Sidebar Navigation -->
        <div class="sidebar">
            <h1>Dashboard</h1>
            <a href="recruiter_space.php" >Home</a>
            <a href="manage_jobs.php" class="active">Manage Jobs</a>
            <a href="view_applications.php">Applications</a>
            <a href="../view/recruiter_profile.php">Profile</a>
            <a href="../index.php">Return</a>
            <a href="../index.php?url=logout">Logout</a>
        </div>

        <!-- Main Content Area -->
        <div class="main-content">
            <div class="profile-card">
                <?php if ($employerDetails): ?>
                <img src="data:image/jpeg;base64,<?= base64_encode($employerDetails['logo']) ?>" alt="Company Logo">
                <h1><?= htmlspecialchars($employerDetails['company_name']) ?></h1>
                <p><?= htmlspecialchars($employerDetails['description']) ?></p>
                <?php else: ?>
                <p>No company details available. Please update your profile.</p>
                <?php endif; ?>
            </div>

            <div class="stats">
                <div class="stat-box">
                <p class="text-primary"><?= htmlspecialchars($employerDetails['Active_Jobs'] ?? '0') ?></p>
               
                    <p>Active Jobs</p>
                </div>
                <div class="stat-box">
                <p class="text-primary"><?= htmlspecialchars($employerDetails['application_count'] ?? '0') ?></p>
                    <p>Applications Received</p>
                </div>
            </div>

            <!-- Additional Sections -->
          

            <div class="card">
                <h2>Manage Your Posts</h2>
                <p>Quick links to create, view, and edit job postings.</p>
            </div>


            <div class="block-intro">
        <div class="overlay">
        
       
    </div>
    </div>
    <a href="add_joboffer.php" class="btn-recrut-listingpage">Ajouter une nouvelle offre</a>

    <h2 class="header-block-style">Dernières Offres d'emploi</h2>
    <div class="block-emploi">
        
        <div class="elements-blocks-emplois">
        </div>
        <div class="element-block-emploi">
            
        <?php
// Debug output
//cho "<pre>";
//var_dump($job_offers);
//echo "</pre>";

if (!empty($job_offers)) {
    foreach ($job_offers as $job_offer) {
        echo "<a href='index.php?controller=joboffer&action=view&id=" . htmlspecialchars($job_offer['id']) . "' class='link-emploi'>";
        echo "<h3 class='titre-link-emploi'>" . htmlspecialchars($job_offer['title']) . "</h3>";
        echo "<p class='desc-link-emploi'>Société : " . htmlspecialchars($job_offer['company_name']) . "</p>";
        echo "<p class='desc-link-emploi'>Telephone : " . htmlspecialchars($job_offer['phone']) . "</p>";
        echo "<p class='desc-link-emploi'>Adresse : " . htmlspecialchars($job_offer['location']) . "</p>";
        echo "<a href='edit_job_offer.php?id=" . $job_offer['id'] . "' class='btn-edit'>Edit</a>";
        // Delete button
        echo "<a href='delete_job_offer.php?id=" . $job_offer['id'] . "' class='btn-delete' onclick='return confirm(\"Are you sure you want to delete this job offer?\");'>Delete</a>";
       
        
        echo "</a>";
    }
} else {
    echo "No job offers found.";
}
?>
  




        </div>
        </div>
    </div>



            <div class="card">
                <h2>Link with jobseekers in same category</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date of Birth</th>
                            <th>Resume URL</th>
                            <th>Subcategory</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Location</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($jobSeekers as $jobSeeker): ?>
                        <tr>
                            <td><?= htmlspecialchars($jobSeeker['name']) ?></td>
                            <td><?= htmlspecialchars($jobSeeker['date_of_birth']) ?></td>
                            <td><a href="<?= htmlspecialchars($jobSeeker['resume_url']) ?>">View Resume</a></td>
                            <td><?= htmlspecialchars($jobSeeker['subcategory_name']) ?></td>
                            <td><?= htmlspecialchars($jobSeeker['email']) ?></td>
                            <td><?= htmlspecialchars($jobSeeker['phone']) ?></td>
                            <td><?= htmlspecialchars($jobSeeker['location']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
</div>



        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- Link to your JavaScript file -->
    <script src="path_to_your_js/dashboard_functions.js"></script>
</body>
</html>

