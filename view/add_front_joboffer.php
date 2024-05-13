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
            if ($job_offer->add()) {
                header("Location: list_jobs_offer.php");
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

    

        <a href="#" class="btn-recrut">Ajouter une nouvelle offre</a>
            <a href="../index.php?url=register" class="btn-inscri"> <img src="../assets/images/home/icon-inscription.svg" alt="Inscription" width="30" height="30">Inscription</a>
            <a href="../index.php?url=login" class="btn-compte"> <img src="../assets/images/home/icon-compte.svg" alt="mon compte" width="30" height="30"> Login</a>
            <a href="../index.php?url=login" class="btn-compte"> <img src="../assets/images/home/icon-compte.svg" alt="mon compte" width="30" height="30"> Mon compte</a>
           
            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
            <a href="../index.php?url=logout" class="btn-logout">logout</a>

            <?php endif; ?>

         </div>
    </header>
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




</body>
</html>

