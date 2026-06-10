<?php
require_once __DIR__ . "/config/auth_check.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Nemi Speaks </title>
<!-----------------
<link rel="stylesheet" href="assets/css/style.css">
------------------->
<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    min-height:100vh;

    background:
    linear-gradient(
        rgba(0,0,0,0.55),
        rgba(0,0,0,0.55)
    ),
    url("assets/images/backgg.png");
    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
    background-attachment:fixed;
    display:flex;
    justify-content:center;
    align-items:center;
    font-family:Arial, sans-serif;
    overflow: hidden;
}

/* Glass Card */

.auth-containers{

    width:420px;
    max-width:90%;
    padding:40px;
    text-align:center;
    background:rgba(255,255,255,0.12);
    backdrop-filter:blur(12px);
    border:1px solid rgba(255,255,255,0.2);
    border-radius:24px;
    box-shadow:
    0 10px 40px rgba(0,0,0,0.35);
    color:#fff;
}

.auth-containers h2{
    font-size:32px;
    margin-bottom:10px;
}

.auth-containers p{
    font-size:16px;
    opacity:0.9;
    margin-bottom:25px;
}

.dashboard-btn{
    width:100%;
    border:none;
    padding:14px;
    border-radius:12px;
    cursor:pointer;
    font-size:16px;
    font-weight:600;
    background:#3b82f6;
    color:#fff;
    transition:.3s;
}

.dashboard-btn:hover{
    transform:translateY(-2px);
    background:#2563eb;
}

.logout-link{
    display:inline-block;
    margin-top:20px;
    color:#fff;
    text-decoration:none;
    opacity:.85;
}

.logout-link:hover{
    opacity:1;
}
@media(max-width: 768px){
    .auth-containers{
        width:300px;
        max-width:90%;
        padding:40px;
        text-align:center;
        background:rgba(255,255,255,0.12);
        backdrop-filter:blur(12px);
        border:1px solid rgba(255,255,255,0.2);
        border-radius:24px;
        box-shadow:
        0 10px 40px rgba(0,0,0,0.35);
        color:#fff;
    }
   

}
</style>

</head>

<body>

<div class="auth-containers">

    <h2> Welcome <?php echo $_SESSION['username']; ?></h2>
    <p>Ready to convert text into natural speech. </p>

    <a href="tts/speak.php">
        <button class="dashboard-btn">Go to Text to Speech</button>
    </a>

    <a href="logout.php" class="logout-link">Logout</a>

</div>

</body>
</html>