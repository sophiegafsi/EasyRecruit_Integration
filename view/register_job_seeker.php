<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Inscription Chercheur d'Emploi - EasyRecruit</title>
  <link rel="stylesheet" href="../assets/css/register_seeker.css">
</head>
<body>
    <div class="form-container">
        <h1>Inscription - Chercheur d'Emploi</h1>
        <form id="jobSeekerForm" action="../submit_job_seeker_registration.php" method="post">
            <label for="name">Nom Complet:</label>
            <input type="text" id="name" name="name">

            <label for="date_of_birth">Date de Naissance:</label>
            <input type="date" id="date_of_birth" name="date_of_birth">

            <label for="email">Email:</label>
            <input type="text" id="email" name="email">

            <label for="password">Mot de Passe:</label>
            <input type="password" id="password" name="password">

            <label for="phone">Téléphone:</label>
            <input type="tel" id="phone" name="phone">

            <label for="location">Localisation:</label>
            <input type="text" id="location" name="location">

            <label for="resume">CV (URL):</label>
            <input type="url" id="resume" name="resume_url">
            <br>

            <!-- Category Selection -->
            <label for="category">Catégorie:</label>
            <select id="category" name="category_id">
                <?php
                 require_once '../controller/CategoryController.php';
                 $categoryModel = new Category($pdo);
                $categories = $categoryModel->getAllCategories();
                foreach ($categories as $category) {
                    echo "<option value='" . $category['category_id'] . "'>" . htmlspecialchars($category['name']) . "</option>";
                }
                ?>
            </select>
            <br>
            <br>
            <!-- Subcategory Selection -->
            <label for="subcategory">Sous-catégorie:</label>
            <select id="subcategory" name="subcategory_id">
                    <script>
                   document.getElementById('category').addEventListener('change', function() {
    var categoryId = this.value;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../get_subcategories.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        console.log("Response from server: " + this.responseText);  // Debug: Log response text
        var subcategories = JSON.parse(this.responseText);
        if (!Array.isArray(subcategories)) {  // Check if not an array
            subcategories = [subcategories];  // Convert to array
        }
        var subcategorySelect = document.getElementById('subcategory');
        subcategorySelect.innerHTML = '';  // Clear existing options
        subcategories.forEach(function(subcategory) {
            var option = new Option(subcategory.name, subcategory.subcategory_id);
            subcategorySelect.add(option);
        });
    };
    xhr.send('category_id=' + encodeURIComponent(categoryId));
});

</script>

            </select>

            <input type="submit" value="S'inscrire">
        </form>
    </div>

    <script src="../assets/js/formValidation.js"></script>
</body>
</html>
