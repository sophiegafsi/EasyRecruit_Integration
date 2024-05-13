<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Login - EasyRecruit</title>
  <link rel="stylesheet" href="../assets/css/login.css">
  <script src="../assets/js/formValidation.js"></script>
</head>
<body>
    <div class="form-container">
        <h1>Login</h1>
        <form id="loginForm" action="../submit_login.php" method="post">
            <label  for="email">Email:</label>
            <input type="text" id="email" name="email" >

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" >

            <input type="submit" value="Login">

            <h3 >Solve Captcha</h3>
				<center><img src="../captcha.php" /></center>
				<br />
				<br />
				<div class="form-group">
					<input type="text" class="form-control" name="captcha"/>
				</div>

            <?php if (isset($_GET['error'])): ?>
                <p class="error"><?= htmlspecialchars($_GET['error']); ?></p>
            <?php endif; ?>
        </form>
        <button onclick="window.location.href='../index.php';" class="home-button">Go to Home</button>
    </div>
</body>

</html>
