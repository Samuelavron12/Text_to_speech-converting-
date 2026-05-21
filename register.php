<!DOCTYPE html>
<html>
<head>
    <title>Register - TTS Reader</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="auth-container">
    <h2>Create Account</h2>

    <form action="auth/register_process.php" method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit">Register</button>
    </form>

    <p>Already have account? <a href="index.php">Login</a></p>
</div>

</body>
</html>