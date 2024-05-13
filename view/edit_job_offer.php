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
    $jobId = $_GET['id'] ?? null; // Get job ID from URL

    $employerDetails = $employerController->getEmployerDetails($user_id);
    $employerAll = $employerModel->fetchEmployerProfileData($user_id);
    $jobSeekers = $jobSeekerModel->getJobSeekersByEmployerCategory($employerAll['category_id']);


    

    $job_offer = new JobOffer();
    $ExistingJob = new JobOffer();

    $ExistingJob->getJobOfferById($jobId);
    
    if (isset($_POST['submit']) && $_POST['submit'] == 1) {
        if (1) {
            $job_offer->setTitle($_POST['title']);
            $job_offer->setDescription($_POST['description']);
            $job_offer->setExperience($_POST['experience']);
            $job_offer->setSalary($_POST['salary']);
            $job_offer->setContractType($_POST['contract_type']);
            $job_offer->setVacantJobs($_POST['vacant_jobs']);
            $job_offer->setExpirationDate($_POST['expiration_date']);
            $job_offer->setRecruiterId($user_id);
            $job_offer->setActive($_POST['active']);
            $job_offer->setDateAdd(date('Y-m-d H:i:s'));
            $job_offer->setDateUpd(date('Y-m-d H:i:s'));
            if ($job_offer->update($jobId)) {
                header("Location: manage_jobs.php");
            } else {
            }
        }
    }



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
        <div class="block-intro">
            <div class="overlay">

                <div class="desc-into">
                <h1 class="desc-style">Ajouter une nouvelle offre d'emploi</h1>
                </div>
            </div>
        </div>

            <form action="" method="post" class="joboffer-form">
                <div  class="style-form-input">
                    Nom de l'offre
                    <input type="text" name="title" placeholder="Title*" required value="<?php if(isset($_POST['title'])) echo $_POST['title']; ?>">
                </div>
                <div class="style-form-input">
                    Description de l'offre
                    <textarea name="description"><?php if(isset($_POST['description'])) echo $_POST['description']; ?></textarea>
                </div>
                <div class="style-form-input">  
                    Experience
                    <select name="experience">
                        <option value="Débutant" <?php if(isset($_POST['experience']) && $_POST['experience'] == 'Débutant') echo 'selected'; ?>>Débutant</option>
                        <option value="Junior (1 - 2 ans)" <?php if(isset($_POST['experience']) && $_POST['experience'] == 'Junior (1 - 2 ans)') echo 'selected'; ?>>Junior (1 - 2 ans)</option>
                        <option value="Confirmé (2 - 5 ans)" <?php if(isset($_POST['experience']) && $_POST['experience'] == 'Confirmé (2 - 5 ans)') echo 'selected'; ?>>Confirmé (2 - 5 ans)</option>
                        <option value="Expert (+ 5 ans)" <?php if(isset($_POST['experience']) && $_POST['experience'] == 'Expert (+ 5 ans)') echo 'selected'; ?>>Expert (+ 5 ans)</option>
                    </select>
                </div>

                <div class="style-form-input">
                    Type de contrat
                    <select name="contract_type">
                        <option value="Stage" <?php if(isset($_POST['contract_type']) && $_POST['contract_type'] == 'Stage') echo 'selected'; ?>>Stage</option>
                        <option value="SIVP" <?php if(isset($_POST['contract_type']) && $_POST['contract_type'] == 'SIVP') echo 'selected'; ?>>SIVP</option>
                        <option value="CDD" <?php if(isset($_POST['contract_type']) && $_POST['contract_type'] == 'CDD') echo 'selected'; ?>>CDD</option>
                        <option value="CDI" <?php if(isset($_POST['contract_type']) && $_POST['contract_type'] == 'CDI') echo 'selected'; ?>>CDI</option>
                    </select>
                </div>
                <div class="style-form-input">
                    Salaire proposé
                    <input type="text" name="salary" placeholder="Salaire*" required value="<?php if(isset($_POST['salary'])) echo $_POST['salary']; ?>">
                </div>

                <div class="style-form-input">
                    Nombre de poste
                    <input type="text" name="vacant_jobs" placeholder="Nombre de poste *" required  value="<?php if(isset($_POST['vacant_jobs'])) echo $_POST['vacant_jobs']; ?>">
                </div>
                <div class="style-form-input">
                    Date d'expiration
                    <input type="text" name="expiration_date" placeholder="Date d'expiration *" required value="<?php if(isset($_POST['expiration_date'])) echo $_POST['expiration_date']; ?>">
                </div>
                <div class="style-form-radio">
                    Actif
                    <input type="radio" name="active" value="1" checked> Oui
                    <input type="radio" name="active" value="0" <?php if(isset($_POST['active']) && $_POST['active'] == 0) echo 'checked'; ?>> Non
                </div>
             

                <div class="style-form-input">
                    <button type="submit" name="submit" value="1" class="btn-recrut">Soumettre</button>
                </div>
            </form>




        

            <!-- Optional JavaScript -->
            <!-- Link to your JavaScript file -->
            <script src="path_to_your_js/dashboard_functions.js"></script>
</body>
</html>

