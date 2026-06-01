<?php

require_once __DIR__ .
"/../config/auth_check.php";

require_once __DIR__ .
"/../config/db.php";

// JSON DATA
$data = json_decode(

    file_get_contents(
        "php://input"
    ),

    true

);

// CHECK
if(!$data){

    echo "No data";
    exit;

}

// USER
$user_id =
$_SESSION['user_id'];

// VALUES
$text =
$data['text_content'];

$language =
$data['language_used'];

$voice =
$data['voice_used'];

$speed =
$data['speech_speed'];

$pitch =
$data['speech_pitch'];


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

VALUES(

    ?,
    ?,
    ?,
    ?,
    ?,
    ?

)

";

$stmt =
$conn->prepare($sql);

// CHECK SQL
if(!$stmt){

    die(
        $conn->error
    );

}

$stmt->bind_param(

    "isssdd",

    $user_id,
    $text,
    $language,
    $voice,
    $speed,
    $pitch

);

// EXECUTE
if($stmt->execute()){

    echo "success";

}else{

    echo $stmt->error;

}
?>