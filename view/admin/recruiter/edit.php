<?php
include _PROJECT_DIR_.'/view/admin/layout/header.php';
?>
    <div class="block-intro">
        <div class="overlay">
            <div class="desc-into">
                <h1 class="desc-style"> trouvez vos talalent <br>
                <span> grâce à EasyRecruit</span> </h1>
            </div>
        </div>
    </div>
    <h2 class="header-block-style">modifier votre offre d'emploi </h2>
<div class="formulaire-recruter">

    <form action="" method="post">
        <label for="email">Email *</label>
        <input type="email" id="email" name="email" value="<?php echo $recruiter_values['email'] ?>" required>

        <label for="name">Nom & Prénom *</label>
        <input type="text" id="name" name="name" value="<?php echo $recruiter_values['name'] ?>" required>

        <label for="company_name">Nom de l'entreprise *</label>
        <input type="text" id="company_name" name="companyName" value="<?php echo $recruiter_values['company_name'] ?>" required>

        <label for="website">Site Web</label>
        <input type="url" id="website" name="website" value="<?php echo $recruiter_values['website'] ?>">

        <label for="phone">Téléphone *</label>
        <input type="tel" id="phone" name="phone" value="<?php echo $recruiter_values['phone'] ?>" required>

        <label for="location">Emplacement (Adresse) *</label>
        <textarea id="location" name="address" required><?php echo $recruiter_values['address'] ?></textarea>

        <label for="description">Description de l'entreprise</label>
        <textarea id="description" name="description"><?php echo $recruiter_values['description'] ?></textarea>

        <label for="sector">Secteur d'activité</label>
        <div class="custom-select"> 
        <select id="sector" name="activitySector">
        <option disabled selected value>Secteur d'activité</option>
            <option value="1" <?php if($recruiter_values['activity_sector'] == 1) echo 'selected'; ?>" >Art</option>
            <option  value="2" <?php if($recruiter_values['activity_sector'] == 2) echo 'selected'; ?>" >Cuisine</option>
        </select>
        </div>   
  

        <button type="submit" name="submit" value="1" class="btn-recrut">Soumettre</button>
    </form>
    </div>

<?php
include _PROJECT_DIR_.'/view/admin/layout/footer.php';
?>