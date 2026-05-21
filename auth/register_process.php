<?php
session_start();
require_once "../config/db.php";

$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// check if email exists
$check = $conn->prepare("SELECT id FROM users WHERE email=?");
$check->bind_param("s",$email);
$check->execute();
$check->store_result();

if($check->num_rows > 0){
    echo "Email already exists";
    exit();
}

// insert user
$stmt = $conn->prepare("INSERT INTO users(username,email,password) VALUES(?,?,?)");
$stmt->bind_param("sss",$username,$email,$password);
$stmt->execute();

header("Location: ../index.php");
?>