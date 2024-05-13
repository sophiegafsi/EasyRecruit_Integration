<?php
include _PROJECT_DIR_.'view/layout/header.php';
?>
   

<?php
if(isset($errors)){
    foreach ($errors as $error) {
        echo '<p class="error">'.$error.'</p>';
    }
}
?>
     
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
                <option value="Expert (+ 5 ans)" <?php if(isset($_POST['experience']) && $_POST['experience'] == 'Expert (+ 5 ans)') echo 'selected'; ?>></option>
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
            Entreprise
            <select name="recruiter_id">
                <?php  ?>
                <?php
                foreach ($recruiters as $recruiter) {
                    echo '<option value="' . $recruiter['id'] . '" ';
                    if(isset($_POST['recruiter_id']) && $_POST['recruiter_id'] == $recruiter['id']) echo 'selected';
                    echo '
                    >' . $recruiter['company_name'] . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="style-form-input">
            <button type="submit" name="submit" value="1" class="btn-recrut">Soumettre</button>
        </div>
    </form>

<?php
include _PROJECT_DIR_ . '/view/layout/footer.php';
?>