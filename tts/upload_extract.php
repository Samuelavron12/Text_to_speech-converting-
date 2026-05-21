<?php

if(!isset($_FILES['file'])){
    echo "No file uploaded";
    exit;
}

$fileName = $_FILES['file']['name'];
$fileTmp  = $_FILES['file']['tmp_name'];
$ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

$text = "";

/* TXT */
if($ext == "txt"){
    $text = file_get_contents($fileTmp);
}

/* DOCX */
elseif($ext == "docx"){
    $zip = new ZipArchive;
    if($zip->open($fileTmp) === TRUE){
        $content = $zip->getFromName('word/document.xml');
        $zip->close();
        $text = strip_tags($content);
    }
}

/* PDF (basic) */
elseif($ext == "pdf"){
    $content = file_get_contents($fileTmp);
    $text = preg_replace('/[^(\x20-\x7F)]*/','',$content);
}

/* HTML */
elseif($ext == "html"){
    $text = strip_tags(file_get_contents($fileTmp));
}

/* CSV */
elseif($ext == "csv"){
    $rows = array_map('str_getcsv', file($fileTmp));
    foreach($rows as $row){
        $text .= implode(" ",$row)."\n";
    }
}

/* JSON */
elseif($ext == "json"){
    $json = file_get_contents($fileTmp);
    $data = json_decode($json,true);
    $text = print_r($data,true);
}

/* XML */
elseif($ext == "xml"){
    $xml = simplexml_load_file($fileTmp);
    $text = strip_tags($xml->asXML());
}

echo $text;