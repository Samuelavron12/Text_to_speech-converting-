<?php

require_once __DIR__ . "/../config/auth_check.php";
require_once __DIR__ . "/../config/db.php";

$user = null;

if(isset($_SESSION['user_id'])){

    $userId = $_SESSION['user_id'];

    $stmt = $conn->prepare(
        "SELECT username,email FROM users WHERE id=?"
    );

    $stmt->bind_param(
        "i",
        $userId
    );

    $stmt->execute();

    $result = $stmt->get_result();

    $user = $result->fetch_assoc();

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/speak.css">
    <title>nemi speak</title>
</head>
<body>

    <div class="sidebar"    id="sidebar">
        <!-- TOGGLE BUTTON -->
        <h2 class="logoTitle">
            <img src="../assets/images/logo.png" alt="Logo">
            <span>
                Nemi Speaks
            </span>
        </h2>
        <ul>
            <li><a href="../dashboard.php" > <img src="../assets/images/home.png" alt="">home</a> </li>
            <li><a href="../tts/speak.php" > <img src="../assets/images/textto.png" alt="">text to speech</a> </li>
            <li>  <a href="../tts/history.php" > <img src="../assets/images/history.png" alt="">history</a> </li>
            <li>  <a href="../tts/about.php" > <img src="../assets/images/about.png" alt="">about</a> </li>
            <li>  <a href="../index.php" > <img src="../assets/images/logout.png" alt="">logout</a> </li>
        </ul>



        <div class="sidebar-profile">

    <a href="#">

        <img
            src="../assets/images/user1.png"
            alt="Profile"
        >

        <div class="profile-info">

            <span class="profile-name">
            <?php echo htmlspecialchars($user['username'] ?? 'User'); ?>
            </span>
          

            <span class="profile-email">
            <?php echo htmlspecialchars($user['email'] ?? 'No Email'); ?>
            </span>

        </div>

    </a>

</div>
    </div>
    

</body>
</html>