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
















// MOBILE AUDIO FIX
window.onload = ()=>{

    speechSynthesis.cancel();

};

// =====================================
// ELEMENTS
// =====================================

const uploadTab =
document.getElementById("uploadTab");

const fileInput =
document.getElementById("fileInput");

const textArea =
document.getElementById("text");

const charCount =
document.getElementById("charCount");

const languageSelect =
document.getElementById("language");

const voiceSelect =
document.getElementById("voice");

const speedSlider =
document.getElementById("speed");

const pitchSlider =
document.getElementById("pitch");

const speedValue =
document.getElementById("speedValue");

const pitchValue =
document.getElementById("pitchValue");

const speakBtn =
document.getElementById("speakBtn");

const playBtn =
document.getElementById("playBtn");

const stopBtn =
document.getElementById("stopBtn");


// =====================================
// SPEECH ENGINE
// =====================================

const synth =
window.speechSynthesis;

let voices = [];

let currentUtterance = null;

let lastText = "";


// =====================================
// UNLOCK AUDIO
// =====================================

document.addEventListener(
    "click",
    ()=>{

        // unlock browser audio
        synth.resume();

    },
    { once:true }
);


// =====================================
// CHARACTER COUNT
// =====================================

function updateCharacterCount(){

    charCount.innerText =
        textArea.value.length +
        " / 100000 characters";

}

textArea.addEventListener(
    "input",
    updateCharacterCount
);

updateCharacterCount();


// =====================================
// FILE UPLOAD
// =====================================

// OPEN FILE MANAGER
uploadTab.addEventListener(
    "click",
    ()=>{

        fileInput.click();

    }
);


// READ FILE
fileInput.addEventListener(
    "change",
    ()=>{

        const file =
        fileInput.files[0];

        if(!file) return;

        const formData =
        new FormData();

        formData.append(
            "file",
            file
        );

        fetch("upload_extract.php",{

            method:"POST",

            body:formData

        })
        .then(response =>
            response.text()
        )
        .then(data => {

            textArea.value = data;

            updateCharacterCount();

        })
        .catch(error => {

            console.log(error);

            alert(
                "Error reading file"
            );

        });

    }
);


// =====================================
// LOAD VOICES
// =====================================

function loadVoices(){

    voices = synth.getVoices();

    // WAIT FOR VOICES
    if(voices.length === 0){
        return;
    }

    // CLEAR LANGUAGES
    languageSelect.innerHTML = "";

    // UNIQUE LANGUAGES
    const uniqueLanguages = [
        ...new Set(
            voices.map(
                voice => voice.lang
            )
        )
    ];

    // ADD LANGUAGES
    uniqueLanguages.forEach(lang => {

        const option =
        document.createElement("option");

        option.value = lang;

        option.textContent = lang;

        languageSelect.appendChild(option);

    });

    // LOAD VOICES
    updateVoices();

}


// =====================================
// UPDATE VOICES
// =====================================

function updateVoices(){

    voiceSelect.innerHTML = "";

    const selectedLang =
    languageSelect.value;

    const filteredVoices =
    voices.filter(
        voice =>
        voice.lang === selectedLang
    );

    // IF NO VOICES
    if(filteredVoices.length === 0){

        const option =
        document.createElement("option");

        option.textContent =
        "No voices available";

        voiceSelect.appendChild(option);

        return;

    }

    // ADD VOICES
    filteredVoices.forEach(voice => {

        const option =
        document.createElement("option");

        option.value =
        voice.name;

        option.textContent =
        voice.name;

        voiceSelect.appendChild(option);

    });

}


// =====================================
// CHANGE LANGUAGE
// =====================================

languageSelect.addEventListener(
    "change",
    updateVoices
);


// =====================================
// LOAD VOICES EVENT
// =====================================

speechSynthesis.onvoiceschanged =
loadVoices;


// INITIAL LOAD
loadVoices();


// =====================================
// SPEED DISPLAY
// =====================================

speedSlider.addEventListener(
    "input",
    ()=>{

        speedValue.innerText =
        speedSlider.value;

    }
);


// =====================================
// PITCH DISPLAY
// =====================================

pitchSlider.addEventListener(
    "input",
    ()=>{

        pitchValue.innerText =
        pitchSlider.value;

    }
);

/*
// =====================================
// SPEAK FUNCTION
// =====================================

function speakText(text){

    // STOP PREVIOUS
    synth.cancel();

    // CREATE SPEECH
    currentUtterance =
    new SpeechSynthesisUtterance(
        text
    );

    // LANGUAGE
    currentUtterance.lang =
    languageSelect.value;

    // SELECTED VOICE
    const selectedVoice =
    voices.find(
        voice =>
        voice.name ===
        voiceSelect.value
    );

    // APPLY VOICE
    if(selectedVoice){

        currentUtterance.voice =
        selectedVoice;

    }

    // SPEED
    currentUtterance.rate =
    parseFloat(
        speedSlider.value
    );

    // PITCH
    currentUtterance.pitch =
    parseFloat(
        pitchSlider.value
    );

    // VOLUME
    currentUtterance.volume = 1;

    // SPEAK
    synth.speak(
        currentUtterance
    );

}

*/

function speakText(text){

    // STOP EVERYTHING
    synth.cancel();

    // FORCE RESUME
    synth.resume();

    // SMALL DELAY FOR MOBILE
    setTimeout(()=>{

        // CREATE SPEECH
        currentUtterance =
        new SpeechSynthesisUtterance(
            text
        );

        // LANGUAGE
        currentUtterance.lang =
        languageSelect.value;

        // SELECTED VOICE
        const selectedVoice =
        voices.find(
            voice =>
            voice.name ===
            voiceSelect.value
        );

        // APPLY VOICE
        if(selectedVoice){

            currentUtterance.voice =
            selectedVoice;

        }

        // SPEED
        currentUtterance.rate =
        parseFloat(
            speedSlider.value
        );

        // PITCH
        currentUtterance.pitch =
        parseFloat(
            pitchSlider.value
        );

        // VOLUME
        currentUtterance.volume = 1;

        // MOBILE EVENTS
        currentUtterance.onstart =
        ()=>{

            console.log(
                "Speech started"
            );

        };

        currentUtterance.onerror =
        (e)=>{

            console.log(
                "Speech Error:",
                e
            );

           /* alert(
                "Speech failed on this device/browser."
            );*/

        };

        // SPEAK
        synth.speak(
            currentUtterance
        );

    },200);

}
// =====================================
// CONVERT BUTTON
// =====================================
/*
speakBtn.addEventListener(
    "click",
    ()=>{

        const text =
        textArea.value.trim();

        // EMPTY CHECK
        if(text === ""){

            alert(
                "Please enter text"
            );

            return;

        }

        lastText = text;

        // RESUME AUDIO
        synth.resume();

        // SPEAK
        speakText(text);

    }
);
*/
speakBtn.addEventListener(
    "click",
    ()=>{

        const text =
        textArea.value.trim();

        if(text === ""){

            alert(
                "Please enter text"
            );

            return;

        }

        lastText = text;

        synth.resume();

        // SPEAK
        speakText(text);

        // SAVE HISTORY
        fetch("save_history.php",{

            method:"POST",

            headers:{
                "Content-Type":
                "application/x-www-form-urlencoded"
            },

            body:

                "text=" +
                encodeURIComponent(text)

                +

                "&language=" +
                encodeURIComponent(
                    languageSelect.value
                )

                +

                "&voice=" +
                encodeURIComponent(
                    voiceSelect.value
                )

                +

                "&speed=" +
                encodeURIComponent(
                    speedSlider.value
                )

                +

                "&pitch=" +
                encodeURIComponent(
                    pitchSlider.value
                )

        });

    }
);
// =====================================
// PLAY BUTTON
// =====================================

playBtn.addEventListener(
    "click",
    ()=>{

        if(lastText !== ""){

            synth.resume();

            speakText(lastText);

        }

    }
);


// =====================================
// STOP BUTTON
// =====================================

stopBtn.addEventListener(
    "click",
    ()=>{

        synth.cancel();

    }
);


// =====================================
// DEBUGGING
// =====================================

console.log(
    "Nem Speak Loaded Successfully"
);


// =====================================
// MOBILE SIDEBAR TOGGLE
// =====================================

document.addEventListener(
    "DOMContentLoaded",
    ()=>{

        const menuBtn =
        document.getElementById(
            "menuBtn"
        );

        const sidebar =
        document.getElementById(
            "sidebar"
        );

        // CHECK ELEMENTS EXIST
        if(menuBtn && sidebar){

            menuBtn.addEventListener(
                "click",
                ()=>{

                    sidebar.classList.toggle(
                        "active"
                    );

                }
            );

        }

    }
);

// =====================================
// LOAD HISTORY DATA
// =====================================

window.addEventListener(
    "load",
    ()=>{

        const savedText =
        localStorage.getItem(
            "tts_text"
        );

        if(savedText){

            // LOAD TEXT
            textArea.value =
            savedText;

            // LOAD LANGUAGE
            const savedLanguage =
            localStorage.getItem(
                "tts_language"
            );

            if(savedLanguage){

                languageSelect.value =
                savedLanguage;

                updateVoices();

            }

            // LOAD VOICE
            const savedVoice =
            localStorage.getItem(
                "tts_voice"
            );

            if(savedVoice){

                setTimeout(()=>{

                    voiceSelect.value =
                    savedVoice;

                },200);

            }

            // LOAD SPEED
            const savedSpeed =
            localStorage.getItem(
                "tts_speed"
            );

            if(savedSpeed){

                speedSlider.value =
                savedSpeed;

                speedValue.innerText =
                savedSpeed;

            }

            // LOAD PITCH
            const savedPitch =
            localStorage.getItem(
                "tts_pitch"
            );

            if(savedPitch){

                pitchSlider.value =
                savedPitch;

                pitchValue.innerText =
                savedPitch;

            }

            // UPDATE COUNT
            updateCharacterCount();

        }

    }
);












// =====================================
// ELEMENTS
// =====================================

const uploadTab =
document.getElementById(
    "uploadTab"
);

const fileInput =
document.getElementById(
    "fileInput"
);

const textArea =
document.getElementById(
    "text"
);

const charCount =
document.getElementById(
    "charCount"
);

const languageSelect =
document.getElementById(
    "language"
);

const voiceSelect =
document.getElementById(
    "voice"
);

const speedSlider =
document.getElementById(
    "speed"
);

const pitchSlider =
document.getElementById(
    "pitch"
);

const speedValue =
document.getElementById(
    "speedValue"
);

const pitchValue =
document.getElementById(
    "pitchValue"
);

const speakBtn =
document.getElementById(
    "speakBtn"
);

const playBtn =
document.getElementById(
    "playBtn"
);

const stopBtn =
document.getElementById(
    "stopBtn"
);


// =====================================
// SPEECH
// =====================================

let voices = [];

let utterance = null;


// =====================================
// LOAD VOICES FAST
// =====================================

function loadVoices(){

    voices =
    speechSynthesis.getVoices();

}

loadVoices();

if(
    speechSynthesis.onvoiceschanged !==
    undefined
){

    speechSynthesis.onvoiceschanged =
    loadVoices;

}


// =====================================
// FILE UPLOAD
// =====================================

uploadTab.addEventListener(
    "click",
    ()=>{

        fileInput.click();

    }
);


// =====================================
// EXTRACT FILE
// =====================================

fileInput.addEventListener(
    "change",
    async ()=>{

        const file =
        fileInput.files[0];

        if(!file) return;

        const formData =
        new FormData();

        formData.append(
            "file",
            file
        );

        try{

            const response =
            await fetch(

                "../tts/upload_extract.php",

                {

                    method:"POST",

                    body:formData

                }

            );

            const extractedText =
            await response.text();

            textArea.value =
            extractedText;

            updateCount();

        }

        catch(error){

            console.log(error);

            alert(
                "Could not read file"
            );

        }

    }
);


// =====================================
// CHARACTER COUNT
// =====================================

function updateCount(){

    charCount.innerText =

    textArea.value.length +

    " / 100000 characters";

}

textArea.addEventListener(
    "input",
    updateCount
);


// =====================================
// SPEED
// =====================================

speedSlider.addEventListener(
    "input",
    ()=>{

        speedValue.innerText =
        speedSlider.value;

    }
);


// =====================================
// PITCH
// =====================================

pitchSlider.addEventListener(
    "input",
    ()=>{

        pitchValue.innerText =
        pitchSlider.value;

    }
);


// =====================================
// GOOGLE TRANSLATE
// =====================================

async function translateText(

    text,
    targetLang

){

    try{

        // LANGUAGE CODE
        const langCode =

        targetLang
        .split("-")[0];

        // NO TRANSLATION FOR ENGLISH
        if(

            langCode === "en"

        ){

            return text;

        }

        // GOOGLE TRANSLATE
        const response =
        await fetch(

            "https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl=" +

            langCode +

            "&dt=t&q=" +

            encodeURIComponent(text)

        );

        const data =
        await response.json();

        // FAST EXTRACTION
        const translatedText =

        data[0]
        .map(

            item => item[0]

        )
        .join("");

        return translatedText;

    }

    catch(error){

        console.log(error);

        return text;

    }

}


// =====================================
// SPEAK TEXT
// =====================================

async function speakText(){

    let text =
    textArea.value.trim();

    if(text === ""){

        alert(
            "Please enter text"
        );

        return;

    }

    // LANGUAGE
    const selectedLang =
    languageSelect.value;

    // CANCEL PREVIOUS
    speechSynthesis.cancel();

    // =====================================
    // TRANSLATE TEXT FIRST
    // =====================================

    const translatedText =

    await translateText(

        text,
        selectedLang

    );

    // =====================================
    // CREATE UTTERANCE
    // =====================================

    utterance =
    new SpeechSynthesisUtterance(

        translatedText

    );

    // LANGUAGE
    utterance.lang =
    selectedLang;

    // SPEED
    utterance.rate =
    parseFloat(
        speedSlider.value
    );

    // PITCH
    utterance.pitch =
    parseFloat(
        pitchSlider.value
    );

    // =====================================
    // FIND VOICE
    // =====================================

    const gender =
    voiceSelect.value
    .toLowerCase();

    let selectedVoice = null;

    // SAME LANGUAGE + GENDER
    selectedVoice =
    voices.find(

        voice =>

        voice.lang ===
        selectedLang &&

        voice.name
        .toLowerCase()
        .includes(gender)

    );

    // SAME LANGUAGE
    if(!selectedVoice){

        selectedVoice =
        voices.find(

            voice =>

            voice.lang ===
            selectedLang

        );

    }

    // PARTIAL MATCH
    if(!selectedVoice){

        selectedVoice =
        voices.find(

            voice =>

            voice.lang
            .includes(

                selectedLang
                .split("-")[0]

            )

        );

    }

    // APPLY VOICE
    if(selectedVoice){

        utterance.voice =
        selectedVoice;

    }

    // =====================================
    // SAVE HISTORY
    // =====================================

    fetch(

        "../tts/save_history.php",

        {

            method:"POST",

            headers:{

                "Content-Type":
                "application/json"

            },

            body:JSON.stringify({

                text:text,

                language:selectedLang,

                voice:voiceSelect.value,

                speed:speedSlider.value,

                pitch:pitchSlider.value

            })

        }

    );

    // =====================================
    // SPEAK FAST
    // =====================================

    window.speechSynthesis.speak(
        utterance
    );

}


// =====================================
// CONVERT
// =====================================

speakBtn.addEventListener(
    "click",
    speakText
);


// =====================================
// PLAY
// =====================================

playBtn.addEventListener(
    "click",
    ()=>{

        speechSynthesis.resume();

    }
);


// =====================================
// STOP
// =====================================

stopBtn.addEventListener(
    "click",
    ()=>{

        speechSynthesis.pause();

    }
);


// =====================================
// MOBILE SIDEBAR
// =====================================

window.addEventListener(
    "load",
    ()=>{

        const menuBtn =
        document.getElementById(
            "menuBtn"
        );

        const sidebar =
        document.getElementById(
            "sidebar"
        );

        if(menuBtn && sidebar){

            menuBtn.onclick = ()=>{

                sidebar.classList.toggle(
                    "active"
                );

            };

        }

    }
);


// =====================================
// LOAD HISTORY BACK
// =====================================

window.addEventListener(
    "load",
    ()=>{

        const savedText =
        localStorage.getItem(
            "tts_text"
        );

        const savedLanguage =
        localStorage.getItem(
            "tts_language"
        );

        const savedVoice =
        localStorage.getItem(
            "tts_voice"
        );

        const savedSpeed =
        localStorage.getItem(
            "tts_speed"
        );

        const savedPitch =
        localStorage.getItem(
            "tts_pitch"
        );

        if(savedText){

            textArea.value =
            savedText;

            languageSelect.value =
            savedLanguage;

            voiceSelect.value =
            savedVoice;

            speedSlider.value =
            savedSpeed;

            pitchSlider.value =
            savedPitch;

            speedValue.innerText =
            savedSpeed;

            pitchValue.innerText =
            savedPitch;

            updateCount();

        }

    }
);
console.log(voices);






/////////////
speak.js        
////////
// =====================================
// ELEMENTS
// =====================================

const uploadTab =
document.getElementById(
    "uploadTab"
);

const fileInput =
document.getElementById(
    "fileInput"
);

const textArea =
document.getElementById(
    "text"
);

const charCount =
document.getElementById(
    "charCount"
);

const languageSelect =
document.getElementById(
    "language"
);

const voiceSelect =
document.getElementById(
    "voice"
);

const speedSlider =
document.getElementById(
    "speed"
);

const pitchSlider =
document.getElementById(
    "pitch"
);

const speedValue =
document.getElementById(
    "speedValue"
);

const pitchValue =
document.getElementById(
    "pitchValue"
);

const speakBtn =
document.getElementById(
    "speakBtn"
);

const playBtn =
document.getElementById(
    "playBtn"
);

const stopBtn =
document.getElementById(
    "stopBtn"
);


// =====================================
// VARIABLES
// =====================================

let voices = [];

let utterance;

let paused = false;


// =====================================
// LOAD VOICES
// =====================================

function loadVoices(){

    voices =
    speechSynthesis.getVoices();

}

loadVoices();

speechSynthesis.onvoiceschanged =
loadVoices;


// =====================================
// CHARACTER COUNT
// =====================================

function updateCount(){

    charCount.innerText =

    textArea.value.length +

    " / 100000 characters";

}

textArea.addEventListener(
    "input",
    updateCount
);


// =====================================
// SPEED
// =====================================

speedSlider.addEventListener(
    "input",
    ()=>{

        speedValue.innerText =
        speedSlider.value;

    }
);


// =====================================
// PITCH
// =====================================

pitchSlider.addEventListener(
    "input",
    ()=>{

        pitchValue.innerText =
        pitchSlider.value;

    }
);


// =====================================
// FILE PICKER
// =====================================

uploadTab.addEventListener(
    "click",
    ()=>{

        fileInput.click();

    }
);


// =====================================
// FILE EXTRACTION
// =====================================

fileInput.addEventListener(
    "change",
    async ()=>{

        const file =
        fileInput.files[0];

        if(!file) return;

        const formData =
        new FormData();

        formData.append(
            "file",
            file
        );

        try{

            const response =
            await fetch(

                "../tts/upload_extract.php",

                {

                    method:"POST",

                    body:formData

                }

            );

            const extractedText =
            await response.text();

            textArea.value =
            extractedText;

            updateCount();

        }

        catch(error){

            console.log(error);

            alert(
                "File extraction failed"
            );

        }

    }
);


// =====================================
// TRANSLATE TEXT
// =====================================

async function translateText(

    text,
    selectedLang

){

    try{

        // ENGLISH
        if(

            selectedLang === "en-US" ||
            selectedLang === "en-GB" ||
            selectedLang === "en-NG"

        ){

            return text;

        }

        // GOOGLE TRANSLATE
        const response =
        await fetch(

            "https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl=" +

            selectedLang.split("-")[0] +

            "&dt=t&q=" +

            encodeURIComponent(text)

        );

        const data =
        await response.json();

        return data[0]
        .map(item => item[0])
        .join("");

    }

    catch(error){

        console.log(error);

        return text;

    }

}


// =====================================
// FIND VOICE
// =====================================

function findVoice(

    selectedLang,
    gender

){

    // SAME LANGUAGE + GENDER
    let selectedVoice =

    voices.find(

        voice =>

        voice.lang === selectedLang &&

        voice.name
        .toLowerCase()
        .includes(gender)

    );

    // SAME LANGUAGE
    if(!selectedVoice){

        selectedVoice =

        voices.find(

            voice =>

            voice.lang === selectedLang

        );

    }

    // PARTIAL MATCH
    if(!selectedVoice){

        selectedVoice =

        voices.find(

            voice =>

            voice.lang.includes(

                selectedLang.split("-")[0]

            )

        );

    }

    return selectedVoice;

}


// =====================================
// SPEAK TEXT
// =====================================

async function speakText(){

    let text =
    textArea.value.trim();

    if(text === ""){

        alert(
            "Please enter text"
        );

        return;
       
    }

    // LOADING
    speakBtn.innerHTML =

    '<img src="../assets/images/loading.png">' +

    '<span>Loading...</span>';

    speakBtn.disabled = true;

    // LANGUAGE
    const selectedLang =
    languageSelect.value;

    // GENDER
    const gender =
    voiceSelect.value
    .toLowerCase();

    // STOP PREVIOUS
    speechSynthesis.cancel();

    
    // =====================================
    // TRANSLATE
    // =====================================

    text =
    await translateText(

        text,
        selectedLang

    );

    // =====================================
    // CONVERTING STATUS
    // =====================================

    speakBtn.innerHTML =

    '<img src="../assets/images/loading.png">' +

    '<span>Converting...</span>';

    // =====================================
    // FIND VOICE
    // =====================================

    const selectedVoice =

    findVoice(

        selectedLang,
        gender

    );

    // =====================================
    // SPLIT LARGE TEXT
    // =====================================

    const chunkSize = 180;

    const chunks = [];

    for(

        let i = 0;

        i < text.length;

        i += chunkSize

    ){

        chunks.push(

            text.substring(

                i,
                i + chunkSize

            )

        );

    }

    // =====================================
    // SPEAK CHUNKS
    // =====================================

    let currentChunk = 0;

    function speakChunk(){

        // FINISHED
        if(currentChunk >= chunks.length){

            speakBtn.innerHTML =

            '<img src="../assets/images/convert.png">' +

            '<span>Converted</span>';

            setTimeout(()=>{

                speakBtn.innerHTML =

                '<img src="../assets/images/convert.png">' +

                '<span>Convert To Speech</span>';

                speakBtn.disabled = false;

            },2000);

            return;

        }

        utterance =
        new SpeechSynthesisUtterance(

            chunks[currentChunk]

        );

        // LANGUAGE
        utterance.lang =
        selectedLang;

        // SPEED
        utterance.rate =
        parseFloat(
            speedSlider.value
        );

        // PITCH
        utterance.pitch =
        parseFloat(
            pitchSlider.value
        );

        // VOICE
        if(selectedVoice){

            utterance.voice =
            selectedVoice;

        }

        // NEXT
        utterance.onend = ()=>{

            currentChunk++;

            speakChunk();

        };

        // SPEAK
        speechSynthesis.speak(
            utterance
        );

    }

    // START
    speakChunk();

    // =====================================
    // SAVE HISTORY
    // =====================================

    fetch(

        "../tts/save_history.php",

        {

            method:"POST",

            headers:{

                "Content-Type":
                "application/json"

            },

            body:JSON.stringify({

                text_content:
                textArea.value,

                language_used:
                selectedLang,

                voice_used:
                voiceSelect.value,

                speech_speed:
                speedSlider.value,

                speech_pitch:
                pitchSlider.value

            })

        }

    );

}


// =====================================
// CONVERT BUTTON
// =====================================

speakBtn.addEventListener(
    "click",
    speakText
);


// =====================================
// PLAY
// =====================================

playBtn.addEventListener(
    "click",
    ()=>{

        speechSynthesis.resume();

        paused = false;

    }
);


// =====================================
// STOP
// =====================================

stopBtn.addEventListener(
    "click",
    ()=>{

        speechSynthesis.pause();

        paused = true;

    }
);


// =====================================
// MOBILE MENU
// =====================================

window.addEventListener(
    "load",
    ()=>{

        const menuBtn =
        document.getElementById(
            "menuBtn"
        );

        const sidebar =
        document.getElementById(
            "sidebar"
        );

        if(menuBtn && sidebar){

            menuBtn.onclick = ()=>{

                sidebar.classList.toggle(
                    "active"
                );

            };

        }

    }
);


// =====================================
// LOAD HISTORY BACK
// =====================================

window.addEventListener(
    "load",
    ()=>{

        const savedText =
        localStorage.getItem(
            "tts_text"
        );

        const savedLanguage =
        localStorage.getItem(
            "tts_language"
        );

        const savedVoice =
        localStorage.getItem(
            "tts_voice"
        );

        const savedSpeed =
        localStorage.getItem(
            "tts_speed"
        );

        const savedPitch =
        localStorage.getItem(
            "tts_pitch"
        );

        if(savedText){

            textArea.value =
            savedText;

            languageSelect.value =
            savedLanguage;

            voiceSelect.value =
            savedVoice;

            speedSlider.value =
            savedSpeed;

            pitchSlider.value =
            savedPitch;

            speedValue.innerText =
            savedSpeed;

            pitchValue.innerText =
            savedPitch;

            updateCount();

        }

    }
);