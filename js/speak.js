/*


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
// CHARACTER COUNT
// =====================================

function updateCharacterCount(){

    charCount.innerText =
        textArea.value.length +
        " / 5000 characters";

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
// SPEECH SYNTHESIS
// =====================================

const synth =
window.speechSynthesis;

let voices = [];

let currentUtterance = null;


// LOAD VOICES
function loadVoices(){

    voices = synth.getVoices();

    // WAIT UNTIL VOICES LOAD
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


// UPDATE VOICES
function updateVoices(){

    voiceSelect.innerHTML = "";

    const selectedLang =
    languageSelect.value;

    // FILTER VOICES
    const filteredVoices =
    voices.filter(
        voice =>
        voice.lang === selectedLang
    );

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


// CHANGE LANGUAGE
languageSelect.addEventListener(
    "change",
    updateVoices
);


// IMPORTANT
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


// =====================================
// CONVERT TO SPEECH
// =====================================

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

        // STOP CURRENT SPEECH
        synth.cancel();

        // CREATE SPEECH
        currentUtterance =
        new SpeechSynthesisUtterance(
            text
        );

        // LANGUAGE
        currentUtterance.lang =
        languageSelect.value;

        // VOICE
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

        // SPEAK
        synth.speak(
            currentUtterance
        );

    }
);


// =====================================
// PLAY BUTTON
// =====================================

playBtn.addEventListener(
    "click",
    ()=>{

        if(currentUtterance){

            synth.cancel();

            synth.speak(
                currentUtterance
            );

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

*/
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
        " / 5000 characters";

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