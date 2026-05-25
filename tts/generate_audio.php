<?php

header(
    "Content-Type: application/json"
);

$text =
$_POST['text'] ?? '';

$language =
$_POST['language'] ?? 'en';

$voice =
$_POST['voice'] ?? 'female';


if(empty($text)){

    echo json_encode([
        "success" => false
    ]);

    exit();

}


// =====================================
// LOCAL LANGUAGES
// =====================================

if(

    $language == "yo" ||
    $language == "ig" ||
    $language == "ha"

){

    // =====================================
    // AMEBOGPT API
    // =====================================

    $api_key =
    "YOUR_AMEBO_API_KEY";


    $url =
    "https://api.amebogpt.com/tts";


    $data = [

        "text" => $text,

        "language" => $language,

        "voice" => $voice

    ];


    $ch =
    curl_init($url);

    curl_setopt(
        $ch,
        CURLOPT_RETURNTRANSFER,
        true
    );

    curl_setopt(
        $ch,
        CURLOPT_POST,
        true
    );

    curl_setopt(
        $ch,
        CURLOPT_POSTFIELDS,
        json_encode($data)
    );

    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        [

            "Content-Type: application/json",

            "Authorization: Bearer " .
            $api_key

        ]
    );

    $response =
    curl_exec($ch);

    curl_close($ch);

    echo $response;

    exit();

}


// =====================================
// GOOGLE TRANSLATE TTS
// =====================================

$audio_url =

"https://translate.google.com/translate_tts?" .

"http://translate.google.com/translate_tts?" .

"ie=UTF-8" .

"&client=tw-ob" .

"&tl=" . urlencode($language) .

"&q=" . urlencode($text);


// RETURN
echo json_encode([

    "success" => true,

    "audio" => $audio_url

]);

?>