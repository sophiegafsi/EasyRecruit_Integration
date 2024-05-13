<?php
require 'C:/xampp/htdocs/EasyRecruit_User/config/connexion.php'; // Ensure this points to your database connection config

require_once 'C:/xampp/htdocs/EasyRecruit_User/model/Employer.php';
require_once 'C:/xampp/htdocs/EasyRecruit_User/model/Jobseeker.php';
require_once 'C:/xampp/htdocs/EasyRecruit_User/controller/UserController.php';
require_once 'C:/xampp/htdocs/EasyRecruit_User/model/Category.php';
$jobSeekerModel = new Jobseeker($pdo);
$employerModel = new Employer($pdo);
$jobSeekerCounts = $jobSeekerModel->countJobSeekersByCategory();
$employerCounts = $employerModel->countEmployersByCategory();
$jobSeekerData = ['labels' => [], 'data' => []];
$employerData = ['labels' => [], 'data' => []];

foreach ($jobSeekerCounts as $count) {
    array_push($jobSeekerData['labels'], $count['name']);
    array_push($jobSeekerData['data'], $count['count']);
}

foreach ($employerCounts as $count) {
    array_push($employerData['labels'], $count['name']);
    array_push($employerData['data'], $count['count']);
}

function fetchUsersByRole($role) {
    global $pdo;  // Ensure $pdo is the PDO connection object from your configuration
    $sql = "SELECT user_id, email, role,status FROM Users WHERE role = :role";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['role' => $role]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

if (isset($_GET['role'])) {
    $role = $_GET['role'];
} else {
    $role = 'job_seeker';  // Default role if none is specified
}
$users = fetchUsersByRole($role);
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
 <link rel="stylesheet" href="userstyle.css" /> 
 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <title>USER DASHBOARD</title>
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
    <div id="sidebar">
            <div class="sidebar__title">
                <i class="fa fa-bars fa-lg text-white" id="sidebarIcon" aria-hidden="true" onclick="toggleSidebar()"></i>
              <h1>Dashboard</h1>
              
            </div>
            <div class="sidebar__menu">
              <div class="sidebar__link active_menu_link">
                <i class="fa fa-home"></i>
                <a href="dashboard.php">Dashboard</a>
              </div>
              <h2>ADMIN</h2>
              <div class="sidebar__link">
                <i class="fa fa-user-secret"></i>
                <a href="reclamationman.html">reclamation Management</a>
                
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
              <div class="sidebar__link">
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
          <main>
      <div class="main__container">
        <!-- MAIN TITLE -->
        <div class="main__title">
          <img src="assets/hello.svg" alt="" />
          <div class="main__greeting">

            <p>Welcome to your admin dashboard</p>
          </div>
        </div>


        <div class="container">
          
    <main>


      <!-- CRUD TABLE -->
      <div class="crud__table">
     




    <form action="user.php" method="get">
        <select name="role" onchange="this.form.submit()">
            <option value="job_seeker" <?= $role === 'job_seeker' ? 'selected' : ''; ?>>Job Seeker</option>
            <option value="employer" <?= $role === 'employer' ? 'selected' : ''; ?>>Employer</option>
            <option value="admin" <?= $role === 'admin' ? 'selected' : ''; ?>>Admin</option>
        </select>
      </form>
        <div class="crud__table-header">
           <!-- <div>#</div> -->
          <div>User_ID</div><div></div><div></div><div></div>
          <div>Email</div>   <div></div><div></div><div></div><div></div>
          <div>Role</div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div>STATUS</div><div></div><div></div><div></div>
          <div>Actions</div><div></div><div></div><div></div><div></div><div></div>
        </div>
        <?php foreach ($users as $index => $user): ?>
        <div class="crud__table-row">
          <!--<div data-label="#"><?= $index + 1 ?></div> -->
          <div data-label="Name"><?= htmlspecialchars($user['user_id']); ?></div>
          <div data-label="Email"><?= htmlspecialchars($user['email']); ?></div>
          <div data-label="Role"><?= htmlspecialchars($user['role']); ?></div>
          
          <div data-label="Actions">
            
          </div>         
           <div data-label="Status"><?= htmlspecialchars($user['status']); ?></div>

<!-- Example form for deleting a user -->
<form action="user_action.php" method="post" style="display: inline;">
    <input type="hidden" name="action" value="delete">
    <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['user_id']); ?>">
    <button type="submit">Delete</button>
</form>

<!-- Example form for toggling verification status -->
<form action="user_action.php" method="post" style="display: inline;">
    <input type="hidden" name="action" value="toggle_verify">
    <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['user_id']); ?>">
    <button type="submit">Toggle Verify</button>
</form>

<!-- Example form for toggling account status -->
<form action="user_action.php" method="post" style="display: inline;">
    <input type="hidden" name="action" value="toggle_status">
    <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['user_id']); ?>">
    <button type="submit">Toggle Status</button>
</form>



        </div>
        <?php endforeach; ?>
      </div>
  </div>

  
  <div class="chart-container">
        <canvas id="jobSeekerChart"></canvas>
        <canvas id="employerChart"></canvas>
    </div>

    <script>
        var jobSeekerCtx = document.getElementById('jobSeekerChart').getContext('2d');
        var employerCtx = document.getElementById('employerChart').getContext('2d');

        var backgroundColors = [
    'rgba(255, 99, 132, 0.2)',  // red
    'rgba(54, 162, 235, 0.2)',  // blue
    'rgba(255, 206, 86, 0.2)',  // yellow
    'rgba(75, 192, 192, 0.2)',  // green
    'rgba(153, 102, 255, 0.2)', // purple
    'rgba(255, 159, 64, 0.2)'   // orange
];

var borderColors = [
    'rgba(255, 99, 132, 1)',  // red
    'rgba(54, 162, 235, 1)',  // blue
    'rgba(255, 206, 86, 1)',  // yellow
    'rgba(75, 192, 192, 1)',  // green
    'rgba(153, 102, 255, 1)', // purple
    'rgba(255, 159, 64, 1)'   // orange
];

        var jobSeekerChart = new Chart(jobSeekerCtx, {
            type: 'bar', // Change to 'bar', 'line', etc.
            data: {
                labels: <?= json_encode($jobSeekerData['labels']) ?>,
                datasets: [{
                    label: 'Number of JobSeekers',
                    data: <?= json_encode($jobSeekerData['data']) ?>,
                    backgroundColor: backgroundColors,
                    borderColor: borderColors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });

        var employerChart = new Chart(employerCtx, {
            type: 'pie', // Change to 'bar', 'line', etc.
            data: {
                labels: <?= json_encode($employerData['labels']) ?>,
                datasets: [{
                    label: 'Number of Employers',
                    data: <?= json_encode($employerData['data']) ?>,
                    backgroundColor: backgroundColors,
                    borderColor: borderColors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'left',
                    }
                }
            }
        });
    </script>

  <div>
   
      <!-- Role Selection Form -->
     

          </div>
        </div>
      </div>
    </main>

    
    
  <script src="reclamationdash.js"></script>
 


  
  
</body>
</html>
