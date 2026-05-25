<?php

$data = json_decode(
    file_get_contents("php://input"),
    true
);

$text =
$data["text"] ?? "";

$voice =
$data["voice"] ?? "en-US-JennyNeural";

$speed =
$data["speed"] ?? "1";

$pitch =
$data["pitch"] ?? "1";


// OUTPUT FILE
$outputFile =
"audio/output.mp3";


// CLEAN TEXT
$text = escapeshellarg($text);


// RATE
$rate =
intval(($speed - 1) * 100);

if($rate >= 0){

    $rate = "+" . $rate . "%";

}else{

    $rate = $rate . "%";

}


// PITCH
$pitchValue =
intval(($pitch - 1) * 50);

if($pitchValue >= 0){

    $pitchValue =
    "+" . $pitchValue . "Hz";

}else{

    $pitchValue =
    $pitchValue . "Hz";

}


// COMMAND
$command =

'edge-tts ' .

'--voice ' . escapeshellarg($voice) . ' ' .

'--rate=' . escapeshellarg($rate) . ' ' .

'--pitch=' . escapeshellarg($pitchValue) . ' ' .

'--text ' . $text . ' ' .

'--write-media ' .

escapeshellarg($outputFile);


// RUN
exec($command, $output, $returnCode);


// ERROR
if($returnCode !== 0){

    echo json_encode([

        "error" => "Speech generation failed",

        "command" => $command

    ]);

    exit;

}


// SUCCESS
echo json_encode([

    "audio" =>

    "../tts/audio/output.mp3"

]);
?>