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

<link rel="stylesheet"
href="../assets/css/spe.css?v=<?php echo time(); ?>">

</head>

<body>

<div class="app">

    <!-- SIDEBAR -->
    <?php include "../includes/header.php"; ?>

    <!-- MOBILE TOP -->
    <div class="mobileTop">

        <div class="mobileLogo">

             Nemi Speak

        </div>

        <button id="menuBtn">

            ☰

        </button>

    </div>

    <!-- MAIN -->
    <main class="mainContent">

        <!-- HEADER -->
        <div class="topHeader">

            <h1>
                Text To Speech
            </h1>

            <p>
                Convert text into natural speech.
            </p>

        </div>

        <!-- MAIN GRID -->
        <div class="ttsContainer">

            <!-- LEFT -->
            <section class="leftPanel">

                <!-- TABS -->
                <div class="tabs">

                    <button id="textTab"
                    class="activeTab">

                        <img
                        src="../assets/images/text.png"
                        alt="">

                        <span>
                            Type Text
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

                <!-- FILE -->
                <input
                type="file"
                id="fileInput"
                accept=".txt,.html,.csv,.json,.xml,.docx,.pdf"
                hidden>

                <!-- TEXT -->
                <textarea
                id="text"
                placeholder="Type or paste your text here..."></textarea>

                <!-- COUNT -->
                <div class="bottomEditor">

                    <span id="charCount">

                        0 / 100000 characters

                    </span>

                </div>

                <!-- BUTTON -->
                <button id="speakBtn">

                    <img
                    src="../assets/images/convert.png"
                    alt="">

                    <span>
                        Convert To Speech
                    </span>

                </button>

            </section>


            <!-- RIGHT -->
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

                    <select id="language">

                        <option value="en-US">
                            English US
                        </option>

                        <option value="en-GB">
                            English UK
                        </option>

                        <option value="en-NG">
                            English Nigeria
                        </option>

                        <option value="fr-FR">
                            French
                        </option>

                        <option value="es-ES">
                            Spanish
                        </option>

                        <option value="de-DE">
                            German
                        </option>

                        <option value="it-IT">
                            Italian
                        </option>

                        <option value="pt-PT">
                            Portuguese
                        </option>

                        <option value="ru-RU">
                            Russian
                        </option>

                        <option value="zh-CN">
                            Chinese
                        </option>

                        <option value="ja-JP">
                            Japanese
                        </option>

                        <option value="ko-KR">
                            Korean
                        </option>

                        <option value="ar-SA">
                            Arabic
                        </option>

                    </select>

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

                    <select id="voice">

                        <option value="female">
                            Female
                        </option>

                        <option value="male">
                            Male
                        </option>

                    </select>

                </div>


                <!-- SPEED -->
                <div class="controlCard">

                    <div class="labelRow">

                        <h3>

                            <img
                            src="../assets/images/speed.png"
                            alt="">

                            <span>
                                Speed
                            </span>

                        </h3>

                        <span id="speedValue">

                            1

                        </span>

                    </div>

                    <input
                    type="range"
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

                    <input
                    type="range"
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
                        Audio Output
                    </span>

                </div>

                <div class="audioControls">

                    <button id="playBtn">

                        <img
                        src="../assets/images/play.png"
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
                            pause
                        </span>

                    </button>

                </div>

            </div>

        </section>

    </main>

</div>

<script src="../js/speak.js?v=<?php echo time(); ?>"></script>

</body>
</html>