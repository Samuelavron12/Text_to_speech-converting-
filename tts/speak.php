<?php
require_once __DIR__ . "/../config/auth_check.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Nemi Speaks</title>

<link rel="stylesheet"
href="../assets/css/spe.css?v=<?php echo time(); ?>">
<!---<link rel="stylesheet" href="../assets/css/spe.css">--->

</head>

<body>

<div class="app">

    <!-- SIDEBAR  ---->
    <?php include "../includes/header.php"; ?> 

    <!-- MAIN CONTENT -->
    <div class="mobileTop">

        <h2 class="logoTitle">
            <img src="../assets/images/logo.png" alt="Logo">
            <span>
                Nemi Speaks
            </span>
        </h2>

        <button id="menuBtn">

            ☰

        </button>

    </div>

    <main class="mainContent">

        <!-- HEADER -->
        <div class="topHeader">

            <h1>
                Text to Speech
            </h1>

            <p>
                Convert text into speech
                that you can listen to.
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

                        <img
                        src="../assets/images/write.png"
                        alt="">

                        <span>
                            Type or Paste Text
                        </span>

                    </button>

                    <button id="uploadTab">

                        <img
                        src="../assets/images/upload.png"
                        alt="">

                        <span>
                            Upload File
                        </span>

                    </button>

                </div>

                <!-- FILE INPUT -->
                <input
                type="file"
                id="fileInput"
                accept=".txt,.docx,.pdf,.html,.csv,.json,.xml"
                hidden >

                <!-- TEXTAREA -->
                <textarea
                id="text"
                placeholder="Type or paste your text here..."></textarea>

                <!-- CHARACTER COUNT -->
                <div class="bottomEditor">

                    <span id="charCount">

                        0 / 100000 characters

                    </span>

                </div>

                <!-- BUTTON ---->
                <button id="speakBtn">

                    <img
                    src="../assets/images/convert.png"
                    alt="">

                    <span>
                        Convert to Speech
                    </span>

                </button>   

            </section>

            <!-- RIGHT SIDE -->
            <section class="rightPanel">

                <!-- LANGUAGE -->
                <div class="controlCard">

                    <h3>

                        <img
                        src="../assets/images/language.png"
                        alt="">

                        <span>
                            Language
                        </span>

                    </h3>

                    <select id="language"></select>

                </div>

                <!-- VOICE -->
                <div class="controlCard">

                    <h3>

                        <img
                        src="../assets/images/voice.png"
                        alt="">

                        <span>
                            Voice
                        </span>

                    </h3>

                    <select id="voice"></select>

                </div>

                <!-- SPEED -->
                <div class="controlCard">

                    <div class="labelRow">

                        <h3>

                            <img
                            src="../assets/images/speed.png"
                            alt="">

                            <span>
                                Speech Speed
                            </span>

                        </h3>

                        <span id="speedValue">

                            1

                        </span>

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

                        <h3>

                            <img
                            src="../assets/images/voice.png"
                            alt="">

                            <span>
                                Pitch
                            </span>

                        </h3>

                        <span id="pitchValue">

                            1

                        </span>

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

                    <img
                    src="../assets/images/output.png"
                    alt="">

                    <span>
                        Output
                    </span>

                </div>

                <h3>
                    Your output control is here
                </h3>

                <div class="audioControls">

                    <button id="playBtn">

                        <img
                        src="../assets/images/play1.png"
                        alt="">

                        <span>
                            Play
                        </span>

                    </button>

                    <button id="stopBtn">

                        <img
                        src="../assets/images/pause.png"
                        alt="">

                        <span>
                            Pause
                        </span>

                    </button>

                </div>

            </div>

        </section>

        <!-- FEATURES -->
        <section class="features">

            <div class="feature">

                <h3>

                    <img
                    src="../assets/images/fast.png"
                    alt="">

                    <span>
                        Fast & Easy
                    </span>

                </h3>

                <p>
                    Convert text to speech instantly.
                </p>

            </div>

            <div class="feature">

                <h3>

                    <img
                    src="../assets/images/voice.png"
                    alt="">

                    <span>
                        Natural Voices
                    </span>

                </h3>

                <p>
                    High quality multilingual voices.
                </p>

            </div>

            <div class="feature">

                <h3>

                    <img
                    src="../assets/images/secure.png"
                    alt="">

                    <span>
                        Secure & Private
                    </span>

                </h3>

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