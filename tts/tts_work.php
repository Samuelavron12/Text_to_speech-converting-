<?php
require_once __DIR__ . "/../config/auth_check.php";
?>
<?php
require_once __DIR__ . "/../config/auth_check.php";

$uploadedText = "";

if(isset($_POST['upload'])){

    if(isset($_FILES['textfile']) && $_FILES['textfile']['error'] == 0){

        $fileName = $_FILES['textfile']['name'];
        $fileTmp  = $_FILES['textfile']['tmp_name'];
        $fileExt  = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // ================= TXT =================
        if($fileExt == "txt"){
            $uploadedText = file_get_contents($fileTmp);
        }

        // ================= DOCX =================
        elseif($fileExt == "docx"){
            $zip = new ZipArchive;
            if($zip->open($fileTmp) === TRUE){
                $content = $zip->getFromName('word/document.xml');
                $zip->close();
                $uploadedText = strip_tags($content);
            }
        }

        // ================= PDF =================
        elseif($fileExt == "pdf"){
            // simple extraction
            $content = file_get_contents($fileTmp);
            $uploadedText = preg_replace('/[^(\x20-\x7F)]*/','', $content);
            $uploadedText = "Extracted PDF text (basic):\n\n".$uploadedText;
        }

        // ================= HTML =================
        elseif($fileExt == "html"){
            $content = file_get_contents($fileTmp);
            $uploadedText = strip_tags($content);
        }

        // ================= CSV =================
        elseif($fileExt == "csv"){
            $rows = array_map('str_getcsv', file($fileTmp));
            foreach($rows as $row){
                $uploadedText .= implode(" ", $row)."\n";
            }
        }

        // ================= JSON =================
        elseif($fileExt == "json"){
            $json = file_get_contents($fileTmp);
            $data = json_decode($json, true);
            $uploadedText = print_r($data, true);
        }

        // ================= XML =================
        elseif($fileExt == "xml"){
            $xml = simplexml_load_file($fileTmp);
            $uploadedText = strip_tags($xml->asXML());
        }

        else{
            $uploadedText = "Unsupported file format.";
        }

    } else {
        $uploadedText = "File upload failed.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Text To Speech</title>
<link rel="stylesheet" href="../assets/css/style.css">


</head>

<body>

<div class="tts-box">
    <h2>Text To Speech Engine 🔊</h2>
    <p>Welcome <?php echo $_SESSION['username']; ?></p>

    <textarea id="text" placeholder="Type text here..."><?php echo $uploadedText; ?></textarea>
    <!-- LANGUAGE FILTER -->
<select id="languageFilter">
    <option value="all">🌍 All Languages</option>
    <option value="NG">🇳🇬 Nigerian</option>
    <option value="en">English</option>
    <option value="fr">French</option>
    <option value="es">Spanish</option>
    <option value="ar">Arabic</option>
    <option value="zh">Chinese</option>
</select>

<!-- VOICE DROPDOWN -->
<select id="voiceSelect"></select>

<button onclick="speakText()">🔊 Convert & Speak</button>
<button onclick="stopSpeech()">⛔ Stop</button>

    <br><br>
    <a href="../dashboard.php">⬅ Back to Dashboard</a>
</div>
<form action="tts_work.php" method="POST" enctype="multipart/form-data">

    <h3>Upload Text File</h3>

    <input type="file" name="textfile"
           accept=".txt,.pdf,.docx,.html,.csv,.json,.xml" required>

    <button type="submit" name="upload">Upload & Extract Text</button>
</form>

<hr>

<script src="../js/tts.js"></script>

</body>
</html>