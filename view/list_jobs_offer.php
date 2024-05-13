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
   
    <div class="">
    <header class="header-style">
        <div class="logo-header">
        <img src="../assets/images/home/EasyRecruit-logo.svg" alt="logo" width="200" height="90"/>
        </div>
        <div >
            <h1 class="wlcm"> <?php
    
                if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                    echo "Welcome back, " .   $_SESSION['username'] . "!";
                    // You can also use role-based features here
                } 
                ?></h1>
           
        </div>
        <div class="links-header">


            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
            <?php if ($_SESSION['role'] === 'job_seeker'): ?>
                <a href="../../index.php?url=Espace_perso" class="btn-recrut">Espace Personnel</a>
            <?php elseif ($_SESSION['role'] === 'employer'): ?>
                <a href="../../index.php?url=Espace_perso" class="btn-recrut">Espace Recruteur</a>
            <?php elseif ($_SESSION['role'] === 'admin'): ?>
                <a href="../../index.php?url=Espace_perso" class="btn-recrut">Espace Admin</a>
            <?php endif; ?>
        <?php endif; ?>

    

        <a href="add_front_joboffer.php" class="btn-recrut">Ajouter une nouvelle offre</a>
            <a href="../index.php?url=register" class="btn-inscri"> <img src="../assets/images/home/icon-inscription.svg" alt="Inscription" width="30" height="30">Inscription</a>
            <a href="../index.php?url=login" class="btn-compte"> <img src="../assets/images/home/icon-compte.svg" alt="mon compte" width="30" height="30"> Login</a>
            <a href="../index.php?url=login" class="btn-compte"> <img src="../assets/images/home/icon-compte.svg" alt="mon compte" width="30" height="30"> Mon compte</a>
           
            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
            <a href="../index.php?url=logout" class="btn-logout">logout</a>

            <?php endif; ?>

         </div>
    </header>
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
          

       


            <div class="block-intro">
        <div class="overlay">
        
       
    </div>
    </div>
    <a href="add_front_joboffer.php" class="btn-recrut-listingpage">Ajouter une nouvelle offre</a>

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



        </div>
    </div>
    <a href="list_jobs_offerfiltre.php" class="btn-recrut-listingpage"> filtre</a>
</body>
</html>

