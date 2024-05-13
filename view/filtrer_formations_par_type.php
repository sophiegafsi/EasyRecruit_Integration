<?php

require_once 'C:/xampp/htdocs/Nourprojet/cnx.php';
require_once 'C:/xampp/htdocs/Nourprojet/controller/form.php';
$formationManager = new form();
$listeFormations = $formationManager->filtrer($pdo);
$countInformatique = $formationManager->countInformatiqueFormations($pdo);
$countProgrammation = $formationManager->countProgrammationFormations($pdo);
$countEconomie = $formationManager->countEconomieFormations($pdo);
$total=$formationManager->countFormations($pdo);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="style/styles.css">
    <title> DASHBOARD</title>
</head>
<body id="body">
    
    <div class="container">
        <!-- Sidebar -->
        <div id="sidebar">
            <div class="sidebar__title">
                <i class="fa fa-bars fa-lg text-white" id="sidebarIcon" aria-hidden="true" onclick="toggleSidebar()"></i>
                <h1>Dashboard</h1>
            </div>
            <div class="sidebar__menu">
                <div class="sidebar__link active_menu_link">
                    <i class="fa fa-home"></i>
                    <a href="http://127.0.0.1:5500/i.html">Dashboard</a>
                </div>
                <h2>ADMIN</h2>
                <div class="sidebar__link">
                    <i class="fa fa-user-secret"></i>
                    <a href="#">reclamation Management</a>
                </div>
                <h2>USER</h2>
                <div class="sidebar__link">
                    <i class="fa fa-building-o"></i>
                    <a href="http://localhost/Nourprojet/views/ajouterform.php">user management</a>
                </div>
                <h2>centerORMATION</h2>
                <div class="sidebar__link">
                    <i class="fa fa-archive"></i>
                    <a href="#">formation management</a>
                </div>
                <h2>FORUM</h2>
                <div class="sidebar__link">
                    <i class="fa fa-user"></i>
                    <a href="#">forum management</a>
                </div>
                <h2>OFFRE D EMPLOIE</h2>
                <div class="sidebar__link">
                    <i class="fa fa-calendar"></i>
                    <a href="#">offre d emploie maagement</a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <main>
            <!-- Header -->
            <header class="navbar">
                <div class="nav_icon" onclick="toggleSidebar()">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </div>
                <div class="navbar__left">
                    <a href="http://localhost/Nourprojet/views/ajouterform.php">Subscribers</a>
                    <a class="active_link" href="http://localhost/Nourprojet/views/ajouterform.php">Admin formations</a>
                    <a  href="http://localhost/Nourprojet/views/afficherexam.php">Exams</a>
                </div>
                <div class="navbar__right">
                    <a href="#">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </a>
                    <a href="#">
                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                    </a>
                    <a href="#">
                        <img width="30" src="assets/avatar.svg" alt="" />
                    </a>
                </div>
            </header>

            <!-- Main Content Area -->
            <div class="main__container">
                <!-- Main Title -->
                <div class="main__title">
                    <img src="assets/hello.svg" alt="zt" />
                    <div class="main__greeting">
                        <h1>Hello Wadhah</h1>
                        <p>Welcome to your admin dashboard</p>
                    </div>
                </div>

                <!-- Main Cards -->
                <div class="main__cards">
                    <div class="card">
                        <i class="fa fa-user-o fa-2x text-lightblue" aria-hidden="true"></i>
                        <div class="card_inner">
                            <p class="text-primary-p">Number of Subscribers</p>
                            <span class="font-bold text-title">578</span>
                        </div>
                    </div>
                    <!-- Ajoutez d'autres cartes ici -->
                    <div class="card">
                        <i class="fa fa-calendar fa-2x text-red" aria-hidden="true"></i>
                        <div class="card_inner">
                            <p class="text-primary-p">Times of using</p>
                            <span class="font-bold text-title">2467</span>
                        </div>
                    </div>
                    <div class="card">
                        <i class="fa fa-thumbs-up fa-2x text-green" aria-hidden="true"></i>
                        <div class="card_inner">
                            <p class="text-primary-p">Number of formations</p>
                            <span class="font-bold text-title"><?= $total ?></span>
                           
                        </div>
                    </div>
                </div>

                <!-- CHARTS -->
                <div class="charts">
                    <div class="charts__left">
                        <div class="charts__left__title">
                            <div>
                                <h1>Daily Reports</h1>
                                <p>Hay el khadra, ultras 2002, TUNISIE</p>
                            </div>
                            <i class="fa fa-usd" aria-hidden="true"></i>
                        </div>
                        <div class="chart-container" id="apex1"></div>
                    </div>
                    <div style="width: 50%;">
                        <canvas id="reclamationsChart"></canvas>
                    </div>
                    <!-- Ajoutez d'autres éléments de graphique ici -->
                    <!-- Placez ce code dans votre fichier HTML, généralement dans la section <body> -->
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

                        <div class="chart-container" style="position: relative; height:400px; width:800px">
                            <canvas id="formationsChart"></canvas>
                        </div>

                        <script>
                            // Récupérer le nombre de formations par type
                            var countInformatique = <?= $countInformatique ?>;
                            var countProgrammation = <?= $countProgrammation ?>;
                            var countEconomie = <?= $countEconomie ?>;

                            // Créer un tableau de données pour le graphique
                            var data = {
                                labels: ['Informatique', 'Programmation', 'Économie'],
                                datasets: [{
                                    label: 'Nombre de formations par type',
                                    data: [countInformatique, countProgrammation, countEconomie],
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            };

                            // Configuration du graphique
                            var options = {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            };

                            // Créer le graphique
                            var ctx = document.getElementById('formationsChart').getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'bar',
                                data: data,
                                options: options
                            });
                        </script>

                </div>

                <!-- Formation CRUD Table -->
                <div class="crud__table">
                    <div class="crud__table-header">
                        <div>#</div>
                        <div>Nom formation</div>
                        <div>Type</div>
                        <div>Image</div>
                        <div>Description</div>
                        <div>Actions</div>
                    </div>
                    <?php foreach ($listeFormations as $formation) : ?>
                        <div class="crud__table-row">
                            <div data-label="#"><?= $formation['id']; ?></div>
                            <div data-label="Nom "><?= $formation['nom']; ?></div>
                            <div data-label="Type"><?= $formation['type']; ?></div>
                            <div data-label="Image"><img src="img/<?php echo $formation['image']; ?>" alt="<?php echo $formation['nom']; ?>" width="100"></div>
                            <div data-label="Description"><?= $formation['description']; ?></div>
                            <div data-label="Actions">
                               
                            <button onclick="deletef(<?= $formation['id']; ?>)">Supprimer</button>
                                <button class="btn btn-primary" onclick="window.location.href='update.php?id=<?= $formation['id']; ?>'">Modifier</button>
                                <button class="btn btn-primary" onclick="window.location.href='ajouterexam.php?id=<?= $formation['id']; ?>'">Add</button>
                                <button class="btn btn-primary" onclick="window.location.href='charger_formations.php?id=<?= $formation['id']; ?>'">post</button>
                               



                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
             
    


 
</div>


</div>
            </div>
        </main>
    </div>

    
    <script>
           function deletef(id) {
    // Envoyer une requête AJAX pour supprimer l'examen avec l'ID donné
    fetch(`deleteform.php?id=${id}`, {
        method: 'DELETE'
    })
    .then(response => {
        if (response.ok) {
            // L'examen a été supprimé avec succès, vous pouvez actualiser la page ou effectuer d'autres actions nécessaires
            window.location.reload(); // Actualiser la page
        } else {
            // Gérer les erreurs de suppression de l'examen
            console.error('Erreur lors de la suppression de l\'examen');
        }
    })
    .catch(error => {
        console.error('Erreur lors de la suppression de l\'examen:', error);
    });
}
   
    </script>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap");

/*  styling scrollbars  */
::-webkit-scrollbar {
    width: 5px;
    height: 6px;
}

::-webkit-scrollbar-track {
    box-shadow: inset 0 0 5px #a5aaad;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    background: #3ea175;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: #a5aaad;
}

* {
    margin: 0;
    padding: 0;
}

body {
    box-sizing: border-box;
    font-family: "Lato", sans-serif;
}

.text-primary-p {
    color: #a5aaad;
    font-size: 14px;
    font-weight: 700;
}

.font-bold {
    font-weight: 700;
}

.text-title {
    color: #2e4a66;
}

.text-lightblue {
    color: #469cac;
}

.text-red {
    color: #cc3d38;
}

.text-yellow {
    color: #a98921;
}

.text-green {
    color: #3b9668;
}

.container {
    display: grid;
    height: 100vh;
    grid-template-columns: 0.8fr 1fr 1fr 1fr;
    grid-template-rows: 0.2fr 3fr;
    grid-template-areas:
        "sidebar nav nav nav"
        "sidebar main main main";
    /* grid-gap: 0.2rem; */
}

.navbar {
    background: #ffffff;
    grid-area: nav;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 30px 0 30px;
    border-bottom: 1px solid lightgray;
}

.nav_icon {
    display: none;
}
.nav_icon > i {
    font-size: 26px;
    color: #a5aaad;
}

.navbar__left > a {
    margin-right: 30px;
    text-decoration: none;
    color: #a5aaad;
    font-size: 15px;
    font-weight: 700;
}

.navbar__left .active_link {
    color: #265acc;
    border-bottom: 3px solid #265acc;
    padding-bottom: 12px;
}

.navbar__right {
    display: flex;
    justify-content: center;
    align-items: center;
}

.navbar__right > a {
    margin-left: 20px;
    text-decoration: none;
}

.navbar__right > a > i {
    color: #a5aaad;
    font-size: 16px;
    border-radius: 50px;
    background: #ffffff;
    box-shadow: 2px 2px 5px #d9d9d9, -2px -2px 5px #ffffff;
    padding: 7px;
}

main {
    background: #f3f4f6;
    grid-area: main;
    overflow-y: auto;
}

.main__container {
    padding: 20px 35px;
}

.main__title {
    display: flex;
    align-items: center;
}

.main__title > img {
    max-height: 100px;
    object-fit: contain;
    margin-right: 20px;
}

.main__greeting > h1 {
    font-size: 24px;
    color: #2e4a66;
    margin-bottom: 5px;
}

.main__greeting > p {
    font-size: 14px;
    font-weight: 700;
    color: #a5aaad;
}

.main__cards {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr;
    gap: 30px;
    margin: 20px 0;
}

.card {
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    height: 70px;
    padding: 25px;
    border-radius: 5px;
    background: #ffffff;
    box-shadow: 5px 5px 13px #ededed, -5px -5px 13px #ffffff;
}

.card_inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.card_inner > span {
    font-size: 25px;
}

.charts {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    margin-top: 50px;
}

.charts__left {
    padding: 25px;
    border-radius: 5px;
    background: #ffffff;
    box-shadow: 5px 5px 13px #ededed, -5px -5px 13px #ffffff;
}

.charts__left__title {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.charts__left__title > div > h1 {
    font-size: 24px;
    color: #2e4a66;
    margin-bottom: 5px;
}

.charts__left__title > div > p {
    font-size: 14px;
    font-weight: 700;
    color: #a5aaad;
}

.charts__left__title > i {
    color: #ffffff;
    font-size: 20px;
    background: #ffc100;
    border-radius: 200px 0px 200px 200px;
    -moz-border-radius: 200px 0px 200px 200px;
    -webkit-border-radius: 200px 0px 200px 200px;
    border: 0px solid #000000;
    padding: 15px;
}

.charts__right {
    padding: 25px;
    border-radius: 5px;
    background: #ffffff;
    box-shadow: 5px 5px 13px #ededed, -5px -5px 13px #ffffff;
}

.charts__right__title {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.charts__right__title > div > h1 {
    font-size: 24px;
    color: #2e4a66;
    margin-bottom: 5px;
}

.charts__right__title > div > p {
    font-size: 14px;
    font-weight: 700;
    color: #a5aaad;
}

.charts__right__title > i {
    color: #ffffff;
    font-size: 20px;
    background: #39447a;
    border-radius: 200px 0px 200px 200px;
    -moz-border-radius: 200px 0px 200px 200px;
    -webkit-border-radius: 200px 0px 200px 200px;
    border: 0px solid #000000;
    padding: 15px;
}

.charts__right__cards {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-top: 30px;
}

.card1 {
    background: #d1ecf1;
    color: #35a4ba;
    text-align: center;
    padding: 25px;
    border-radius: 5px;
    font-size: 14px;
}

.card2 {
    background: #d2f9ee;
    color: #38e1b0;
    text-align: center;
    padding: 25px;
    border-radius: 5px;
    font-size: 14px;
}

.card3 {
    background: #d6d8d9;
    color: #3a3e41;
    text-align: center;
    padding: 25px;
    border-radius: 5px;
    font-size: 14px;
}

.card4 {
    background: #fddcdf;
    color: #f65a6f;
    text-align: center;
    padding: 25px;
    border-radius: 5px;
    font-size: 14px;
}

/*  SIDEBAR STARTS HERE  */

#sidebar {
    background: #020509;
    grid-area: sidebar;
    overflow-y: auto;
    padding: 20px;
    -webkit-transition: all 0.5s;
    transition: all 0.5s;
}

.sidebar__title {
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #f3f4f6;
    margin-bottom: 30px;
    /* color: #E85B6B; */
}

.sidebar__img {
    display: flex;
    align-items: center;
}

.sidebar__title > div > img {
    width: 75px;
    object-fit: contain;
}

.sidebar__title > div > h1 {
    font-size: 18px;
    display: inline;
}

.sidebar__title > i {
    font-size: 18px;
    display: none;
}

.sidebar__menu > h2 {
    color: #3ea175;
    font-size: 16px;
    margin-top: 15px;
    margin-bottom: 5px;
    padding: 0 10px;
    font-weight: 700;
}

.sidebar__link {
    color: #f3f4f6;
    padding: 10px;
    border-radius: 3px;
    margin-bottom: 5px;
}

.active_menu_link {
    background: rgba(62, 161, 117, 0.3);
    color: #3ea175;
}

.active_menu_link a {
    color: #3ea175 !important;
}

.sidebar__link > a {
    text-decoration: none;
    color: #a5aaad;
    font-weight: 700;
}

.sidebar__link > i {
    margin-right: 10px;
    font-size: 18px;
}

.sidebar__logout {
    margin-top: 20px;
    padding: 10px;
    color: #e65061;
}

.sidebar__logout > a {
    text-decoration: none;
    color: #e65061;
    font-weight: 700;
    text-transform: uppercase;
}

.sidebar__logout > i {
    margin-right: 10px;
    font-size: 18px;
}

.sidebar_responsive {
    display: inline !important;
    z-index: 9999 !important;
    left: 0 !important;
    position: absolute;
}
crud__table {
  margin-top: 50px;
  width: 100%;
}

.crud__table-header {
  display: grid;
  grid-template-columns: repeat(6, 1fr);
  background-color: #f3f4f6;
  padding: 10px 0;
  border-radius: 5px;
}

.crud__table-header > div {
  text-align: center;
  font-weight: bold;
}

.crud__table-row {
  display: grid;
  grid-template-columns: repeat(6, 1fr);
  background-color: #ffffff;
  padding: 10px 0;
  border-radius: 5px;
  margin-top: 10px;
}

.crud__table-row > div {
  text-align: center;
}

.crud__table-row > div[data-label="Actions"] button {
  margin: 0 5px;
  padding: 5px 10px;
  background-color: #3ea175;
  color: #ffffff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

@media only screen and (max-width: 978px) {
    .container {
        grid-template-columns: 1fr;
        /* grid-template-rows: 0.2fr 2.2fr; */
        grid-template-rows: 0.2fr 3fr;
        grid-template-areas:
            "nav"
            "main";
    }

    #sidebar {
        display: none;
    }

    .sidebar__title > i {
        display: inline;
    }

    .nav_icon {
        display: inline;
    }
}

@media only screen and (max-width: 855px) {
    .main__cards {
        grid-template-columns: 1fr;
        gap: 10px;
        margin-bottom: 0;
    }

    .charts {
        grid-template-columns: 1fr;
        margin-top: 30px;
    }
}

@media only screen and (max-width: 480px) {
    .navbar__left {
        display: none;
    }
    
}

        </style>
</body>
</html>


