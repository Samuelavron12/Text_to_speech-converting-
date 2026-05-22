<?php

if(!isset($_FILES['file'])){
    exit;
}

$file = $_FILES['file'];

$extension = strtolower(
    pathinfo(
        $file['name'],
        PATHINFO_EXTENSION
    )
);

$temp = $file['tmp_name'];

$text = "";

// TXT
if($extension == "txt"){

    $text = file_get_contents($temp);

}

// HTML
elseif($extension == "html"){

    $text = strip_tags(
        file_get_contents($temp)
    );

}

// CSV
elseif($extension == "csv"){

    $text = file_get_contents($temp);

}

// JSON
elseif($extension == "json"){

    $text = file_get_contents($temp);

}

// XML
elseif($extension == "xml"){

    $text = strip_tags(
        file_get_contents($temp)
    );

}

// DOCX
elseif($extension == "docx"){

    $zip = new ZipArchive;

    if($zip->open($temp) === TRUE){

        $data =
        $zip->getFromName(
            "word/document.xml"
        );

        $zip->close();

        $text = strip_tags($data);

    }

}

// PDF
elseif($extension == "pdf"){

    $text =
    "PDF extraction requires PDF parser library.";

}

echo trim($text);
?>