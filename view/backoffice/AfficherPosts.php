<?php
include_once "../../Controller/PostController.php";

// Number of records per page
$limit = 3;

// Determine which page we are on, defaulting to 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the offset
$offset = ($page - 1) * $limit;

$totalPosts = PostController::getTotalPosts();

$totalPages = ceil($totalPosts / $limit);

$posts = PostController::getPostsPaginator($limit, $offset);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
        crossorigin="anonymous"
    />
    <link rel="stylesheet" href="./assets/styles.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../../node_modules/chart.js/dist/chart.js"></script>

    <style>
        a.button {
            display: inline-block;
            margin: 0 5px;
            padding: 10px 20px; /* Increased padding for a bigger button */
            background-color: #3ea175;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            text-decoration: none; /* Remove underline */
            cursor: pointer;
        }

        .crud__container {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }
        .enabled-button {
            background-color: red;  /* Red for enabled buttons */
            color: white;  /* White text for contrast */
            padding: 8px 16px;  /* Padding for the button */
            border: none;  /* No border */
            border-radius: 4px;  /* Rounded corners */
            cursor: pointer;  /* Cursor changes to pointer */
            text-align: center;  /* Center align text */
            display: inline-block;  /* Display as inline block */
        }

        .disabled-button {
            background-color: gray;  /* Gray for disabled buttons */
            color: white;  /* White text for contrast */
            padding: 8px 16px;  /* Same padding as enabled buttons */
            border: none;  /* No border */
            border-radius: 4px;  /* Rounded corners */
            text-align: center;  /* Center align text */
            display: inline-block;  /* Display as inline block */
            cursor: not-allowed;  /* Cursor indicates the button is disabled */
        }

        .disabled-button a {
            color: white;  /* Ensure the link inside the disabled button is styled correctly */
        }
        .pagination {
            display: flex;
            justify-content: center; /* Center align the pagination */
            margin-top: 20px;
        }

        .pagination a, .pagination span {
            display: inline-block;
            padding: 8px 12px; /* Padding for the buttons */
            margin: 0 5px; /* Space between the buttons */
            text-decoration: none;
            border: 1px solid #ddd; /* Light border */
            border-radius: 4px; /* Rounded corners */
            color: #333; /* Default text color */
            background-color: #f9f9f9; /* Light background color */
        }

        .pagination a:hover {
            background-color: #e0e0e0; /* Hover effect */
        }

        .pagination .active {
            background-color: #007bff; /* Active page color */
            color: #fff; /* White text for active page */
        }

        .pagination .active:hover {
            background-color: #0056b3; /* Hover effect for active page */
        }

        .pagination span {
            color: #888; /* Disabled color for span elements */
        }



    </style>

    <style>
        .charts {
            display: flex; /* Use Flexbox */
            flex-direction: row; /* Align horizontally */
            justify-content: space-around; /* Distribute space evenly */
            align-items: center; /* Center items vertically */
            gap: 20px; /* Space between divs */
            padding: 10px; /* Optional padding */
        }

        /* Optional styling for individual divs to ensure consistent sizes */
        .chart-container {
            max-width: 650px;
            max-height: 650px;
        }

        /* Styling for canvas elements to ensure they fit within their container */
        canvas {
            width: 100%; /* Make canvas responsive to its container */
            height: auto; /* Maintain aspect ratio */
        }
    </style>
    <title>wadhah s DASHBOARD</title>
</head>
<body id="body">
<div class="container">
    <nav class="navbar">
        <div class="nav_icon" onclick="toggleSidebar()">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </div>
        <div class="navbar__left">
            <a href="Reclamation/reclamation.html">Subscribers</a>
            <a class="active_link" href="#">Admin</a>
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
    </nav>

    <main>
        <div class="main__container">
            <!-- MAIN TITLE -->
            <div class="main__title">
                <img src="assets/hello.svg" alt="zt" />
                <div class="main__greeting">
                    <h1>Hello Wadhah</h1>

                    <p>Welcome to your admin dashboard</p>
                </div>
            </div>

            <!-- MAIN CARDS -->
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
                    <i
                        class="fa fa-video-camera fa-2x text-yellow"
                        aria-hidden="true"
                    ></i>
                    <div class="card_inner">
                        <p class="text-primary-p">Number of offre d emploie</p>
                        <span class="font-bold text-title">340</span>
                    </div>
                </div>

                <div class="card">
                    <i
                        class="fa fa-thumbs-up fa-2x text-green"
                        aria-hidden="true"
                    ></i>
                    <div class="card_inner">
                        <p class="text-primary-p">Number of reclamation</p>
                        <span class="font-bold text-title">645</span>
                    </div>
                </div>

            </div>




            <!-- CRUD TABLE -->
            <!-- Displaying the Posts -->
            <div class="crud__container">
                <a href="AddTest.php" class="button" id="addPostButton">Add Post</a>
                <div class="crud__table">
                    <div class="crud__table-header">
                        <div>#</div>
                        <div>Title</div>
                        <div>Actions</div>
                    </div>
                    <?php foreach ($posts as $post): ?>
                        <div class="crud__table-row">
                            <div data-label="#"> <?= $post['id'] ?> </div>
                            <div data-label="Title"> <?= $post['post_title'] ?> </div>
                            <div data-label="Actions">
                                <a href="edit_post.php?id=<?= $post['id'] ?>"><i class="fa fa-pencil"></i></a>
                                <a href="delete_post.php?id=<?= $post['id'] ?>"><i class="fa fa-trash"></i></a>

                                <?php if ($post['status'] == 0): ?>
                                    <a href="ConfirmerPost.php?id=<?= $post['id'] ?>" style="background-color: #cc3d38">Confirm</a>
                                <?php else: ?>
                                    <a href="#" style="background-color: #3b9668" class="disabled-button">Confirmed</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Pagination -->
            <div class="pagination">
                <!-- Previous button -->
                <?php if ($page > 1): ?>
                    <a href="?page=<?= $page - 1 ?>">Previous</a>
                <?php else: ?>
                    <span>Previous</span>
                <?php endif; ?>

                <!-- Page numbers -->
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?page=<?= $i ?>" <?= ($page == $i) ? 'class="active"' : '' ?>><?= $i ?></a>
                <?php endfor; ?>

                <!-- Next button -->
                <?php if ($page < $totalPages): ?>
                    <a href="?page=<?= $page + 1 ?>">Next</a>
                <?php else: ?>
                    <span>Next</span>
                <?php endif; ?>
            </div>
        </div>
        <div class="chart-container">
            <canvas id="confirmedPostsChart" width="200" height="100"></canvas> <!-- Smaller size -->
        </div>
        <div class="chart-container">
            <canvas id="postsWithMostCommentsChart" width="50" height="50"></canvas>
        </div>
        <div class="chart-container">
            <canvas id="postsGroupedByDateChart" width="200" height="100"></canvas>
        </div>

        <script>
            // Data for confirmed posts

            const confirmedPostsData = {

                labels: ['Confirmed', 'Not Confirmed'], // Define labels for each segment
                datasets: [{
                    data: [
                        <?= PostController::getConfirmedPostsCount() ?>,
                        <?= PostController::getNotConfirmedPostsCount() ?>
                    ],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.5)', // Green (confirmed)
                        'rgba(255, 99, 132, 0.5)'  // Pink (not confirmed)
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)', // Green border
                        'rgba(255, 99, 132, 1)'  // Pink border
                    ],
                    borderWidth: 1 // Border thickness
                }]
            };

            const confirmedPostsConfig = {
                type: 'bar', // Bar chart
                data: confirmedPostsData,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            };

            // Create the chart
            new Chart(document.getElementById('confirmedPostsChart'), confirmedPostsConfig);



            // Data for posts grouped by date
            const postsGroupedByDateData = {
                labels: [<?= implode(',', array_map(fn($p) => "'" . $p['date'] . "'", PostController::getPostsGroupedByDate())) ?>],
                datasets: [{
                    label: 'Posts Created',
                    data: [<?= implode(',', array_map(fn($p) => $p['count'], PostController::getPostsGroupedByDate())) ?>],
                    backgroundColor: ['rgba(54, 162, 235, 0.2)'],
                    borderColor: ['rgba(54, 162, 235, 1)'],
                    borderWidth: 1
                }]
            };

            const postsGroupedByDateConfig = {
                type: 'line', // Line chart for date-based data
                data: postsGroupedByDateData,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            };

            // Create the chart
            new Chart(document.getElementById('postsGroupedByDateChart'), postsGroupedByDateConfig);


            const postsWithMostCommentsData = {
                labels: [<?= implode(',', array_map(fn($p) => "'" . $p['title'] . "'", PostController::getPostsWithMostComments())) ?>],
                datasets: [{
                    label: 'Comment Count',
                    data: [<?= implode(',', array_map(fn($p) => $p['comment_count'], PostController::getPostsWithMostComments())) ?>],
                    backgroundColor: [ // Define distinct colors for each segment
                        'rgba(255, 99, 132, 0.5)',  // Red
                        'rgba(54, 162, 235, 0.5)',  // Blue
                        'rgba(255, 206, 86, 0.5)',  // Yellow
                        'rgba(75, 192, 192, 0.5)',  // Green
                        'rgba(153, 102, 255, 0.5)'  // Purple
                    ],
                    borderColor: [ // Matching border colors
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 2 // Border thickness
                }]
            };

            // Configuration for the doughnut chart
            const postsWithMostCommentsConfig = {
                type: 'doughnut', // Use 'doughnut' for a rounded chart
                data: postsWithMostCommentsData,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true, // Ensure the legend is visible
                            position: 'top', // Position of the legend
                        },
                        tooltip: {
                            callbacks: {
                                label: function (tooltipItem) {
                                    const index = tooltipItem.dataIndex;
                                    return postsWithMostCommentsData.labels[index] + ': ' + postsWithMostCommentsData.datasets[0].data[index];
                                }
                            }
                        }
                    }
                }
            };
            const ctx = document.getElementById('postsWithMostCommentsChart').getContext('2d');

            // Create the chart
            new Chart(ctx, postsWithMostCommentsConfig);
        </script>
    </main>





    <div id="sidebar">
        <div class="sidebar__title">
            <i class="fa fa-bars fa-lg text-white" id="sidebarIcon" aria-hidden="true" onclick="toggleSidebar()"></i>
            <h1>Dashboard</h1>

        </div>
        <div class="sidebar__menu">
            <div class="sidebar__link">
                <i class="fa fa-home"></i>
                <a href="dashboard.php">Dashboard</a>
            </div>
            <h2>ADMIN</h2>
            <div class="sidebar__link">
                <i class="fa fa-user-secret"></i>
                <a href="#">reclamation Management</a>

            </div>
            <h2>USER</h2>
            <div class="sidebar__link">
                <i class="fa fa-building-o"></i>
                <a href="user.php">user management</a>
            </div>
            <h2>FORMATION</h2>
            <div class="sidebar__link">
                <i class="fa fa-archive"></i>
                <a href="#">formation management</a>
            </div>
            <h2>FORUM</h2>
            <div class="sidebar__link active_menu_link">
                <i class="fa fa-user"></i>
                <a href="AfficherPosts.php">forum management</a>
            </div>
            <h2>OFFRE D EMPLOIE</h2>
            <div class="sidebar__link">
                <i class="fa fa-calendar"></i>
                <a href="#">offre d emploie maagement</a>
            </div>

        </div>
    </div>


</div>





</body>
</html>

