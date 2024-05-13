
<?php
session_start();
require_once '../model/jobseeker.php';
require_once '../config/connexion.php';
$userid=$_SESSION['user_id'];
$userModel = new JobSeeker($pdo);
$userinfo = $userModel->getJobSeekerByUserId($userid);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {  $data = json_decode(file_get_contents('php://input'), true);
    $verified = $userinfo['Verified'] ?? false;

    if (!$verified) {
        $userModel->toggleVerified($userid);
        echo json_encode(['message' => 'User verified successfully']);
    } else {
        echo json_encode(['message' => 'Failed to verify']);
    }

}

function fakeFaceVerify($uploadedImage, $capturedImage) {
    // Dummy function for the sake of example
    return rand(0, 1) > 0.5;
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Face Verification</title>
    <link rel="stylesheet" href="../assets/css/recruiter_space.css">
</head>
<body>
    <div class="container">
        <!-- Sidebar Navigation -->
        <div class="sidebar">
            <h1>Dashboard</h1>
            <a href="../view/face_verification.php" >Home</a>
            <a href="">Manage Jobs</a>
            <a href="">Applications</a>
            <a href="../view/face_mood_detection.php">Mood AI</a>
            <a href="">Profile</a>
            <a href="../index.php">Return</a>
            <a href="../index.php?url=logout">Logout</a>
        </div>

        <!-- Main Content Area -->
        <div class="main-content">
            <div class="profile-card">
                <h1>Verify Your Identity</h1>
                <?php if ($userinfo['Verified']): ?>
                <p>Your account is verified.</p>
                <?php else: ?>
                <form id="verificationForm">
                    <input type="file" id="uploadedImage" accept="image/*">
                    <video id="video" width="640" height="480" autoplay></video><br>
                    <button type="button" id="capture">Capture Image</button><br><br>
                    <canvas id="canvas" width="640" height="480"></canvas><br>
                    <button type="button" id="verify">Verify</button>
                </form>
                <?php endif; ?>
            </div>

            <!-- Additional Sections -->
            <div class="card">
                <h2>Recent Activities</h2>
                <p>Details about recent activities or notifications.</p>
            </div>
            <div class="card">
                <h2>Manage Your Posts</h2>
                <p>Quick links to create, view, and edit job postings.</p>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>
    <script src="../view/face-api.min.js"></script>
    <?php if (!$userinfo['Verified']): ?>
    <script src="verification.js"></script>
    <?php endif; ?>

</body>
</html>
