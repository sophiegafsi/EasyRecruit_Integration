<?php
include _PROJECT_DIR_.'/layout/header.php';
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
<div class="formulaire-recruter">
    <form action="" method="post">
        
        <input type="email" id="email" name="email" placeholder="Email *" required>
        <input type="text" id="name" name="name"  placeholder="Nom & Prénom *" required>

        
        <input type="password" id="password" name="password" placeholder="Mot de Passe *" required>

        <input type="text" id="company_name" name="companyName"  placeholder="Nom de l'entreprise *" required>

    
        <input type="url" id="website" name="website" placeholder="Site Web">

        <input type="tel" id="phone" name="phone" placeholder="Téléphone *" required>

        <textarea id="location" name="address" placeholder="Emplacement (Adresse) *" required></textarea>
        <textarea id="description" name="description" placeholder="Description de l'entreprise"></textarea>
        <div class="custom-select"> 
            <select id="sector" name="activitySector">
                <option disabled selected value>Secteur d'activité</option>
                <option value="1">Art</option>
                <option value="2">Cuisine</option>
            </select>
        </div>    

        <button type="submit" name="submit" value="1" class="btn-recrut">Soumettre</button>
    </form>
</div>
<?php
include _PROJECT_DIR_.'/view/layout/footer.php';
?>