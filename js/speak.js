// =====================================
// ELEMENTS
// =====================================

const textArea =
document.getElementById(
    "text"
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

const charCount =
document.getElementById(
    "charCount"
);

const uploadTab =
document.getElementById(
    "uploadTab"
);

const fileInput =
document.getElementById(
    "fileInput"
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

let utterance = null;

let pausedSpeech = false;


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
// SPEED VALUE
// =====================================

speedSlider.addEventListener(
    "input",
    ()=>{

        speedValue.innerText =
        speedSlider.value;

    }
);


// =====================================
// PITCH VALUE
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
                "Could not read file"
            );

        }

    }
);


// =====================================
// TRANSLATE TEXT
// =====================================

async function translateText(

    text,
    targetLanguage

){

    try{

        // LANGUAGE CODE
        const langCode =

        targetLanguage
        .split("-")[0];

        // ENGLISH
        if(langCode === "en"){

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

        // EXTRACT TEXT
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
// FIND BEST VOICE
// =====================================

function findVoice(

    lang,
    gender

){

    gender =
    gender.toLowerCase();

    // SAME LANGUAGE + GENDER
    let selectedVoice =

    voices.find(

        voice =>

        voice.lang === lang &&

        voice.name
        .toLowerCase()
        .includes(gender)

    );

    // SAME LANGUAGE
    if(!selectedVoice){

        selectedVoice =

        voices.find(

            voice =>

            voice.lang === lang

        );

    }

    // PARTIAL MATCH
    if(!selectedVoice){

        selectedVoice =

        voices.find(

            voice =>

            voice.lang
            .includes(

                lang.split("-")[0]

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

    // BUTTON LOADING
    speakBtn.innerHTML =
    "Loading...";

    speakBtn.disabled =
    true;

    // STOP PREVIOUS
    speechSynthesis.cancel();

    // LANGUAGE
    const selectedLanguage =
    languageSelect.value;

    // GENDER
    const selectedGender =
    voiceSelect.value;

    // =====================================
    // TRANSLATE FIRST
    // =====================================

    const translatedText =

    await translateText(

        text,
        selectedLanguage

    );

    // =====================================
    // CREATE SPEECH
    // =====================================

    utterance =
    new SpeechSynthesisUtterance(

        translatedText

    );

    // LANGUAGE
    utterance.lang =
    selectedLanguage;

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
    // VOICE
    // =====================================

    const selectedVoice =

    findVoice(

        selectedLanguage,
        selectedGender

    );

    if(selectedVoice){

        utterance.voice =
        selectedVoice;

    }

    // =====================================
    // SPEAK
    // =====================================

    speechSynthesis.speak(
        utterance
    );

    // =====================================
    // SAVE HISTORY
    // =====================================

    saveHistory();

    // BUTTON RESET
    speakBtn.innerHTML =
    "Convert To Speech";

    speakBtn.disabled =
    false;

}


// =====================================
// SAVE HISTORY
// =====================================

function saveHistory(){

    fetch(

        "../tts/save_history.php",

        {

            method:"POST",

            headers:{

                "Content-Type":
                "application/json"

            },

            body:JSON.stringify({

                text:
                textArea.value,

                language:
                languageSelect.value,

                voice:
                voiceSelect.value,

                speed:
                speedSlider.value,

                pitch:
                pitchSlider.value

            })

        }

    );

}


// =====================================
// PLAY
// =====================================

playBtn.addEventListener(
    "click",
    ()=>{

        if(pausedSpeech){

            speechSynthesis.resume();

            pausedSpeech = false;

        }

    }
);


// =====================================
// STOP
// =====================================

stopBtn.addEventListener(
    "click",
    ()=>{

        speechSynthesis.pause();

        pausedSpeech = true;

    }
);


// =====================================
// CONVERT BUTTON
// =====================================

speakBtn.addEventListener(
    "click",
    speakText
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