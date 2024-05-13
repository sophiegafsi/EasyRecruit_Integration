<?php
include _PROJECT_DIR_.'/view/layout/header.php';
?>

    <div class="block-intro">
        <div class="overlay">

            <div class="desc-into">
                <h1 class="desc-style">Forgez votre avenir, <br>
                    <span> trouvez votre voie professionnelle ici !</span> </h1>
                <a href="#" class="btn-decouvrir">découvrir plus</a>
            </div>
        </div>
    </div>


    <div class="block-emploi">
      
        <div class="element-block-emploi">
            <img src="view/img/we-are-hiring.png" alt="we-are-hiring" width="300">

        </div>

        <div class="links-emploi">
        <?php
            if (isset($errors)){
                foreach ($errors as $error){
                    echo '<p style="background: red; color: white; padding: 10px">'.$error.'</p>';
                }
            }
        ?>
         
        <?php
        
            if(isset($mes_condidatures) && !empty($mes_condidatures)){
                foreach ($mes_condidatures as $condidature){
                    ?>
                  
                        <div class="link-emploi">
                            <h3 class="titre-link-emploi"><?php echo $condidature['title']; ?></h3>
                            <p class="desc-link-emploi"> <span> Societé : </span> <?php echo $condidature['company_name']; ?></p>
                            <p class="desc-link-emploi"><span> Date de condidature :</span> <?php echo $condidature['date_add']; ?></p>
                            <p class="desc-link-emploi"><span>Type de contrat : </span><?php echo $condidature['contract_type']; ?></p>
                            <p class="desc-link-emploi"><span>Fichier :</span> <a href="upload/<?php echo $condidature['fichier']; ?>">Télécharger</a></p>

                        </div>

                  
                    <?php
                }
            }else{
                echo 'Aucune condidature';
            }
        ?>
          </div>
    </div>

     


<?php
include _PROJECT_DIR_.'/view/layout/footer.php';
?>