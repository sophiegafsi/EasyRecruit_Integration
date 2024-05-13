<?php
include _PROJECT_DIR_.'/view/layout/header.php';
?>
  <div class="block-intro">
        <div class="overlay">
            <div class="desc-into">
                <h1 class="desc-style"> trouvez vos talalent <br>
                <span> grâce à EasyRecruit</span> </h1>
            </div>
        </div>
    </div>
    <h2 class="header-block-style"> Créer votre offre d'emploi </h2>
    <a href="index.php?controller=recruiter&action=add" class="btn-recrut-listingpage">Ajouter une nouvelle offre</a>

    <div class="block-listing-offres">
        <?php
        foreach ($recruiters as $recruiter) {
            ?>
         <div class="link-emploi">
            <a href="#" >  
                <h3 class="titre-link-emploi"> <?php echo $recruiter['company_name'] ?></h3>
                <p class="desc-link-emploi"><?php echo $recruiter['description'] ?> </p>
                <p class="desc-link-emploi"> <?php echo $recruiter['email'] ?></p>
             </a>
                
            <a href="index.php?controller=recruiter&action=edit&id=<?php echo $recruiter['id'] ?>">Modifier</a>
                    <a href="index.php?controller=recruiter&action=delete&id=<?php echo $recruiter['id'] ?>">Delete</a>
        </div>
              
            <?php
        }
        ?>
        </div>
   
<?php
include _PROJECT_DIR_.'/view/layout/footer.php';
?>