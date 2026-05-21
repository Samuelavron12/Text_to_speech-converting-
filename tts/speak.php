<?php
require_once __DIR__ . "/../config/auth_check.php";
?>
<!DOCTYPE html>
<html>
<head>
<title>Nem speaks</title>
<link rel="stylesheet" href="../assets/css/speak.css">
</head>

<body>

<div class="app">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>🔊 Nem speak</h2>
        <ul>
            <li class="active">Text to Speech</li>
            <li>History</li>
            <li>Voices</li>
            <li>Settings</li>
        </ul>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main">

        <h1>Text to Speech</h1>
      <!----  <p>Convert text into natural-sounding speech in seconds.</p>----->

        <div class="content">

            <!-- TEXT EDITOR -
            <div class="editor">
                <textarea id="text" placeholder="Type or paste your text here..."></textarea>
                <button id="speakBtn">Convert to Speech</button>
            </div>------>
            <div class="editor">

        <!-- TABS -->
        <div class="tabs">
            <button id="textTab" class="activeTab">✏️ Type or Paste Text</button>
            <button id="uploadTab">📁 Upload File</button>
        </div>

        <!-- FILE UPLOAD -->
        <div id="uploadArea" style="display:none;">
            <input type="file"
           id="fileInput"
           accept=".txt,.pdf,.docx,.html,.csv,.json,.xml"
           hidden>
        </div>

        <!-- TEXT AREA -->
        <textarea id="text" placeholder="Type or paste your text here..."></textarea>

        <button id="speakBtn">🎧 Convert to Speech</button>

    </div>

    <div class="controls">

        <!-- LANGUAGE -->
        <label>Language</label>
        <select id="language"></select>

        <!-- VOICE -->
        <label>Voice</label>
        <select id="voice"></select>

        <!-- SPEED -->
        <label>
            Speech Speed:
            <span id="speedValue">1</span>
        </label>

        <input type="range"
            id="speed"
            min="0.5"
            max="2"
            step="0.1"
            value="1">

        <!-- PITCH -->
        <label>
            Pitch:
            <span id="pitchValue">1</span>
        </label>

        <input type="range"
            id="pitch"
            min="0"
            max="2"
            step="0.1"
            value="1">

        </div>
        </div>

        </div>

    </div>
        <!-- AUDIO OUTPUT -->
    <div class="output">
        <h3>Output</h3>
        <audio id="audioPlayer" controls></audio>
    </div>

</div>

<script src="../js/speak.js"></script>
</body>
</html>