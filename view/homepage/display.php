<?php
include '../layout/header.php';
?>

 <div class="block-intro">
        <div class="overlay">
        
        <div class="desc-into">
            <h1 class="desc-style">Forgez votre avenir, <br>
               <span> trouvez votre voie professionnelle ici !</span> </h1>
               <a href="index.php?controller=joboffer&action=list" class="btn-decouvrir">découvrir plus</a>
        </div>
    </div>
    </div>
    <h2 class="header-block-style">Dernières Offres d'emploi</h2>
    <div class="block-emploi">
        
        <div class="elements-blocks-emplois">
            <img src="view/img/we-are-hiring.png" alt="we-are-hiring" width="300">
        </div>
        <div class="element-block-emploi">
            <?php
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
            ?>
        </div>
        </div>
        <a href="index.php?controller=joboffer&action=list" class="btn-decouvrir-pink">découvrir plus</a>
    </div>

    <div class="block-intro-2">
        <div class="overlay">
        
        <div class="desc-into-2">
            <h2 class="desc-style-2">prêt à embaucher des cadres talentueux <br>
                en notre compagnie 
              </h2>
               <a href="index.php?controller=joboffer&action=list" class="btn-decouvrir">découvrir plus</a>
        </div>
    </div>
    <!-- à faire -->
    <div class="block-condidats">
        <h2 class="header-block-style">nos partenaire</h2>
        <div class="element-block-condidat">
            <img src="img/condidat.png"  alt="we-are-hiring" width="300">
            <div class="links-condidat">

                <?php
                 foreach ($recruiters as $recruiter) {
                     ?>
                     <div class="link-condidat">
                         <div class="content-link-condidat">
                             <div class="condidat-element">
                                 <div class="content-condidat">
                                     <h3 class="titre-link-condidat"><?php echo $recruiter['company_name'] ?></h3>
                                     <p class="desc-link-condidat"><?php echo $recruiter['description'] ?></p>
                                 </div>
                             </div>
                             </div>
                         </div>
                     <?php
                 }
                ?>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>


            </div>
        </div>
        
        <a href="index.php?controller=joboffer&action=list" class="btn-decouvrir-pink">découvrir plus</a>
    </div>
<?php
include 'view/layout/footer.php';
?>