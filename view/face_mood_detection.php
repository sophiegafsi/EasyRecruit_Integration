
<?php
session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Face_mood_recognition</title>
  <script  src="../view/face-api.min.js"></script>
  <script defer src="../view/face_mood_detection.js"></script>
  <link rel="stylesheet" href="../assets/css/recruiter_space.css">
  <style>
    body {
      margin: 0;
      padding: 0;
  
      display: flex;
    }

    canvas {
      padding:115px;
      padding-left:310px;
      position: absolute;
    }
  </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar Navigation -->
        <div class="sidebar">
            <h1>Dashboard</h1>
            <a href="../view/face_verification.php" >Home</a>
            <a href="">Manage Jobs</a>
            <a href="">Applications</a>
            <a href="../view/face_mood_detection.php" class="active">Mood AI</a>
            <a href="">Profile</a>
            <a href="../index.php">Return</a>
            <a href="../index.php?url=logout">Logout</a>
        </div>

       

            <!-- Additional Sections -->
            <div class="card">
                <h2>Recent Activities</h2>
                <video id="video" width="720" height="560" autoplay muted></video>

            </div>
        
    </div>

</body>
</html>