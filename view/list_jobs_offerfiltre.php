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
   
    <h1 class="desc-style"> Offre d'emploi </h1>

<div class="block-intro">
    <div class="overlay">

        <div class="desc-into">
            <h1 class="desc-style">Forgez votre avenir, <br>
                <span> trouvez votre voie professionnelle ici !</span></h1>
            <a href="#" class="btn-decouvrir">découvrir plus</a>
        </div>
    </div>
</div>


<div class="list-job-offer-style">
    <div class="block-emploi">
        
        <div class="element-block-emploi">
            <img src="../assets/images/home/we-are-hiring.png" alt="we-are-hiring" width="300">

        </div>
    </div>


    <div class="links-emploi">
    <div class="links-emploi-2">
        <div class="recherche ">
            <form method="get" class="recherche-form">
                <div class="input-searsh-style">
                        <label>
                            Rechercher
                        </label>
                            <input type="hidden" name="controller" value="joboffer">
                            <input type="hidden" name="action" value="search">
                            <input name="search" value="<?php if(isset($search)) echo $search ?>">
                    </div>
                    <div class="input-searsh-style">
                        <label>
                            Secteur d'activité
                        </label>
                        <select id="sector" name="activitySector">
                            <option value="0" <?php if(isset($secteur) && $secteur == 0) echo 'selected' ?>>Tous</option>
                            <option value="1" <?php if(isset($secteur) && $secteur == 1) echo 'selected' ?>>Art</option>
                            <option value="2" <?php if(isset($secteur) && $secteur == 2) echo 'selected' ?>>Cuisine</option>
                        </select>
                    </div>
                    <div class="block-submit">
                        <button type="submit" class="btn-recherche-style">Rechercher</button>
                    </div>   
            </form>
        </div>
    </div>
        <?php
        if(isset($job_offers) && !empty($job_offers)){
            foreach ($job_offers as $job_offer) {
                ?>
                <a href="index.php?controller=joboffer&action=view&id=<?php echo $job_offer['id'] ?>" class="link-emploi">
                    <h3 class="titre-link-emploi"><?php echo $job_offer['title'] ?></h3>
                    <p class="desc-link-emploi">Société : <?php echo $job_offer['company_name'] ?></p>
                    <p class="desc-link-emploi">Adresse : <?php echo $job_offer['address'] ?></p>
                    <p class="desc-link-emploi">site web : <?php echo $job_offer['website'] ?></p>
                </a>
                <?php
            }
        }else{
            echo "Aucune résultat";
        }
        ?>

</div>

</div>


</body>
</html>

