<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);



header("Content-Type: application/json");

$apiKey = "5db98057c4c647e2b1e3c27902ccd9c0";

$text = $_POST['text'] ?? '';
$lang = $_POST['lang'] ?? 'en-us';

if(empty($text)){

    echo json_encode([
        "success" => false,
        "message" => "No text supplied"
    ]);

    exit;
}

$url =
"https://api.voicerss.org/?" .
http_build_query([

    "key" => $apiKey,
    "hl"  => $lang,
    "src" => $text,
    "c"   => "MP3",
    "f"   => "44khz_16bit_stereo"

]);

echo json_encode([
    "success" => true,
    "audio" => $url
]);