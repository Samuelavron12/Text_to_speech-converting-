
<?php

if(!isset($_POST['text'])){
    exit;
}

$text = urlencode($_POST['text']);

$lang = $_POST['language'];

$url = "https://translate.google.com/translate_tts?ie=UTF-8&q=$text&tl=$lang&client=tw-ob";

header("Content-Type: audio/mpeg");

readfile($url);
?>