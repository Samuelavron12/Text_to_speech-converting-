<?php
$host = "127.0.0.1";   // use 127.0.0.1 instead of localhost
$user = "root";
$pass = "";
$db   = "tts_reader";
$port = 3307; // change to 3307 if your my.ini shows 3307

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
?>