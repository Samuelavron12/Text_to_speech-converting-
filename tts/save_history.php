<?php

session_start();

require_once "../config/db.php";


// CHECK LOGIN
if(!isset($_SESSION['user_id'])){

    exit;

}


$user_id =
$_SESSION['user_id'];


// GET DATA
$text =
$_POST['text'];

$language =
$_POST['language'];

$voice =
$_POST['voice'];

$speed =
$_POST['speed'];

$pitch =
$_POST['pitch'];


// INSERT
$sql = "

INSERT INTO tts_history(

    user_id,
    text_content,
    language_used,
    voice_used,
    speech_speed,
    speech_pitch

)

VALUES(?,?,?,?,?,?)

";


$stmt =
$conn->prepare($sql);

$stmt->bind_param(

    "isssdd",

    $user_id,
    $text,
    $language,
    $voice,
    $speed,
    $pitch

);


$stmt->execute();

echo "saved";

?>