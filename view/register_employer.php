<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Inscription Entreprise - EasyRecruit</title>
  <link rel="stylesheet" href="../assets/css/register_employer.css">
</head>
<body>
    <div class="form-container">
        <h1>Inscription - Entreprise</h1>
        <form id="employerForm" action="../submit_employer_registration.php" method="post">
             <label for="companyName">Nom de l'Entreprise:</label>
            <input type="text" id="companyName" name="company_name" >

            <label for="email">Email:</label>
            <input type="text" id="email" name="email" >

            <label for="password">Mot de Passe:</label>
            <input type="password" id="password" name="password" >

            <label for="phone">Téléphone:</label>
            <input type="tel" id="phone" name="phone" >

            <label for="location">Localisation:</label>
            <input type="text" id="location" name="location" >


            <label for="category">Catégorie:</label>
            <select id="category" name="category_id" required>
            <?php
                require_once '../controller/CategoryController.php';
                $categoryModel = new Category($pdo);
                $categories = $categoryModel->getAllCategories();
                foreach ($categories as $category) {
                    echo "<option value='" . $category['category_id'] . "'>" . htmlspecialchars($category['name']) . "</option>";
                }
                ?>
            </select>

            <input type="submit" value="S'inscrire">
        </form>
    </div>

    <script src="../assets/js/formValidation.js"></script>
</body>
</html>



