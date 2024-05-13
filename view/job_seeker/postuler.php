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
        <div class="form-postuler">
            <?php
                if (isset($errors)){
                    foreach ($errors as $error){
                        echo '<p style="background: red; color: white; padding: 10px">'.$error.'</p>';
                    }
                }
                ?><?php
                if (isset($success)){
                    foreach ($success as $succes){
                        echo '<p style="background: green; color: white; padding: 10px">'.$succes.'</p>';
                    }
                }
            ?>
     
            <form  method="post" enctype="multipart/form-data">
                <h2 class="header-block-style"><?php echo $job_offer['title'] ?></h2>
                <h3>Formulaire avec Fichier PDF</h3>
                <input type="hidden" name="id_offer" value="<?php echo $id_offer; ?>">
                <div class="input-postuler-form">
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-postuler-form">
                    <label for="phone">Téléphone :</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                <div class="input-postuler-form">
                    <label for="fichier">Fichier PDF :</label>
                    <input type="file" id="fichier" name="fichier" accept=".pdf" required>
                </div>
                <div class="input-postuler-form">
                    <button name="submit" value="1" type="submit" class="btn-decouvrir-pink">Envoyer</button>
                </div>
            </form>
        </div>   
    </div>


<?php
include _PROJECT_DIR_.'/view/layout/footer.php';
?>