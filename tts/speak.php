<?php
require_once __DIR__ . "/../config/auth_check.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Nem Speak</title>

<link rel="stylesheet" href="../assets/css/spe.css">

</head>

<body>

<div class="app">

    <!-- SIDEBAR  ---->
    <?php include "../includes/header.php"; ?>  

    <!-- MAIN CONTENT -->
    <div class="mobileTop">
        <div class="mobileLogo">
            🔊 Nem Speak
        </div>
        <button id="menuBtn">
            ☰
        </button>
    </div>
    <main class="mainContent">

        <!-- HEADER -->
        <div class="topHeader">
            <h1>Text to Speech</h1>
            <p>
                Convert text into speech that you can listen to.
            </p>
        </div>

        <!-- MAIN GRID -->
        <div class="ttsContainer">

            <!-- LEFT SIDE -->
            <section class="leftPanel">

                <!-- TABS -->
                <div class="tabs">

                    <button id="textTab"
                    class="activeTab">

                        ✏️ Type or Paste Text

                    </button>

                    <button id="uploadTab">

                        📁 Upload File

                    </button>

                </div>

                <!-- FILE INPUT -->
                <input type="file" type="file" id="fileInput" accept=".txt,.docx,.pdf,.html,.csv,.json,.xml" hidden >

                <!-- TEXTAREA -->
                <textarea
                id="text"
                placeholder="Type or paste your text here..."></textarea>

                <!-- CHARACTER COUNT -->
                <div class="bottomEditor">

                    <span id="charCount">
                        0 / 50000 characters
                    </span>

                </div>

                <!-- BUTTON ---->
                <button id="speakBtn">

                    🔊 Convert to Speech

                </button>   

            </section>

            <!-- RIGHT SIDE -->
            <section class="rightPanel">

                <!-- LANGUAGE -->
                <div class="controlCard">

                    <h3>🌍 Language</h3>

                    <select id="language"></select>

                </div>

                <!-- VOICE -->
                <div class="controlCard">

                    <h3>🎤 Voice</h3>

                    <select id="voice"></select>

                </div>

                <!-- SPEED -->
                <div class="controlCard">

                    <div class="labelRow">

                        <h3>⚡ Speech Speed</h3>

                        <span id="speedValue">1</span>

                    </div>

                    <input type="range"
                    id="speed"
                    min="0.5"
                    max="2"
                    step="0.1"
                    value="1">

                </div>

                <!-- PITCH -->
                <div class="controlCard">

                    <div class="labelRow">

                        <h3>🎵 Pitch</h3>

                        <span id="pitchValue">1</span>

                    </div>

                    <input type="range"
                    id="pitch"
                    min="0"
                    max="2"
                    step="0.1"
                    value="1">

                </div>

            </section>

        </div>

        <!-- OUTPUT -->
        <section class="outputSection">

          

            <div class="outputBox">

                <div class="audioIcon">
                Output
                </div>

                <h3>
                    Your output control is here
                </h3>
<!----
                <p>
                    Convert your text to hear it here.
                </p>

                <audio id="audioPlayer"
                controls></audio> ---->
                <div class="audioControls">
                    <button id="playBtn">
                        ▶ Play
                    </button>
                    <button id="stopBtn">
                        ⛔ Pause
                    </button>
                </div>
            </div>

        </section>

        <!-- FEATURES -->
        <section class="features">

            <div class="feature">

                <h3>⚡ Fast & Easy</h3>

                <p>
                    Convert text to speech instantly.
                </p>

            </div>

            <div class="feature">

                <h3>🎤 Natural Voices</h3>

                <p>
                    High quality multilingual voices.
                </p>

            </div>

            <div class="feature">

                <h3>🔒 Secure & Private</h3>

                <p>
                    Your data remains private.
                </p>

            </div>

        </section>

    </main>

</div>

<script src="../js/speak.js"></script>

</body>
</html>