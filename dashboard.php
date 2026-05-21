
<?php
require_once __DIR__ . "/config/auth_check.php";
?>
<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="auth-containers">
    <h2>Welcome <?php echo $_SESSION['username']; ?> 👋</h2>
    <p>You are logged in.</p>

    <br>
    <a href="tts/speak.php">
        <button>Go to Text to Speech</button>
    </a>

    <br><br>
    <a href="logout.php">Logout</a>
</div>

</body>
</html>