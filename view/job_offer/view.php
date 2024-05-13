<?php include _PROJECT_DIR_.'/view/layout/header.php'; ?>

<div class="container">
   

    <div class="block-intro">
        <div class="overlay">
            <div class="desc-into">
            <h1 class="sub-heading">Postulez pour cette offre</h1>
             
                <a href="#" class="btn-decouvrir">Découvrir plus</a>
            </div>
        </div>
    </div>

    <div class="block-emploi">
       
        <div class="element-block-emploi">
            <img src="view/img/we-are-hiring.png" alt="we-are-hiring" width="300">
        </div>
        <div class="job-details">
            <h2 class="sub-heading"><?php echo $job_offer['title'] ?></h2>
            <p class="job-info"><span class="job-info-details"> Secteur d'activité : </span><?php echo $job_offer['activity_sector'] == 1 ? 'Art' : 'Cuisine'; ?></p>
            <p class="job-info"><span class="job-info-details">  Société : </span> <?php echo $job_offer['company_name'] ?></p>
            <p class="job-info"><span class="job-info-details"> Expérience : </span><?php echo $job_offer['experience'] ?></p>
            <p class="job-info"> <span class="job-info-details"> Salaire : </span><?php echo $job_offer['salary'] ?></p>
            <p class="job-info"><span class="job-info-details"> Type de contrat : </span><?php echo $job_offer['contract_type'] ?></p>
            <p class="job-info"><span class="job-info-details"> Nombre de poste(s) : </span><?php echo $job_offer['vacant_jobs'] ?></p>
            <p class="job-info"><span class="job-info-details"> Date d'expiration de l'offre : </span><?php echo $job_offer['expiration_date'] ?></p>
            <p class="job-info"><span class="job-info-details"> Adresse : </span><?php echo $job_offer['address'] ?></p>
            <p class="job-info"><span class="job-info-details"> Site web :</span> <?php echo $job_offer['website'] ?></p>
            <a href="index.php?controller=Jobseeker&action=postuler&id=<?php echo $job_offer['id'] ?>" class="btn-recrut">Postuler</a>

        </div>
    </div>



</div>

<?php include _PROJECT_DIR_.'/view/layout/footer.php'; ?>
