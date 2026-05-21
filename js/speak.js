/*

// TAB SWITCHING
const textTab = document.getElementById("textTab");
const uploadTab = document.getElementById("uploadTab");
const uploadArea = document.getElementById("uploadArea");

textTab.onclick = () => {
    uploadArea.style.display="none";
    textTab.classList.add("activeTab");
    uploadTab.classList.remove("activeTab");
};
uploadTab.onclick = () => {

    uploadTab.classList.add("activeTab");
    textTab.classList.remove("activeTab");

    // OPEN FILE MANAGER IMMEDIATELY
    document.getElementById("fileInput").click();
};





const synth = window.speechSynthesis;
let voices = [];

const voiceSelect = document.getElementById("voiceSelect");
const languageFilter = document.getElementById("languageFilter");

function loadVoices(){
    voices = synth.getVoices();

    let langs = new Set();
    voices.forEach(v => langs.add(v.lang));

    languageFilter.innerHTML="";
    langs.forEach(lang=>{
        let opt=document.createElement("option");
        opt.textContent=lang;
        opt.value=lang;
        languageFilter.appendChild(opt);
    });

    updateVoices(langs.values().next().value);
}

function updateVoices(lang){
    voiceSelect.innerHTML="";
    voices.forEach((voice,i)=>{
        if(voice.lang===lang){
            let opt=document.createElement("option");
            opt.value=i;
            opt.textContent=voice.name;
            voiceSelect.appendChild(opt);
        }
    });
}

speechSynthesis.onvoiceschanged = loadVoices;
loadVoices();

languageFilter.onchange = () => updateVoices(languageFilter.value);

document.getElementById("speakBtn").onclick = () => {
    let text = document.getElementById("text").value;
    let utter = new SpeechSynthesisUtterance(text);

    utter.voice = voices[voiceSelect.value];
    utter.rate  = document.getElementById("speed").value;
    utter.pitch = document.getElementById("pitch").value;

    synth.speak(utter);
};


document.getElementById("fileInput").addEventListener("change", function(){

    if(this.files.length === 0){
        return;
    }

    let formData = new FormData();
    formData.append("file", this.files[0]);

    fetch("upload_extract.php",{
        method:"POST",
        body:formData
    })
    .then(res => res.text())
    .then(text => {

        // LOAD TEXT INTO TEXTAREA
        document.getElementById("text").value = text;

        // SWITCH BACK TO TEXT TAB
        textTab.classList.add("activeTab");
        uploadTab.classList.remove("activeTab");

    })
    .catch(err=>{
        alert("File upload failed");
    });

});    

// ============================
// FILE UPLOAD
// ============================

const textTab = document.getElementById("textTab");
const uploadTab = document.getElementById("uploadTab");

uploadTab.onclick = () => {
    document.getElementById("fileInput").click();
};

document.getElementById("fileInput").addEventListener("change", function(){

    if(this.files.length === 0) return;

    let formData = new FormData();
    formData.append("file", this.files[0]);

    fetch("upload_extract.php",{
        method:"POST",
        body:formData
    })
    .then(res => res.text())
    .then(text=>{
        document.getElementById("text").value = text;
    });

});


// ============================
// TEXT TO SPEECH
// ============================

document.getElementById("speakBtn").onclick = function(){

    let text = document.getElementById("text").value;

    if(text.trim() === ""){
        alert("Enter text first");
        return;
    }

    let language = document.getElementById("language").value;
    let voiceType = document.getElementById("voiceType").value;
    let speed = document.getElementById("speed").value;
    let pitch = document.getElementById("pitch").value;

    let formData = new FormData();

    formData.append("text", text);
    formData.append("language", language);
    formData.append("voiceType", voiceType);
    formData.append("speed", speed);
    formData.append("pitch", pitch);

    fetch("tts_engine.php",{
        method:"POST",
        body:formData
    })
    .then(res => res.blob())
    .then(blob=>{

        let audioURL = URL.createObjectURL(blob);

        let player = document.getElementById("audioPlayer");

        player.src = audioURL;

        player.play();

    });

};
*/
// ========================================
// FILE UPLOAD
// ========================================

const textTab = document.getElementById("textTab");
const uploadTab = document.getElementById("uploadTab");

uploadTab.onclick = () => {
    document.getElementById("fileInput").click();
};

document.getElementById("fileInput").addEventListener("change", function(){

    if(this.files.length === 0) return;

    let formData = new FormData();
    formData.append("file", this.files[0]);

    fetch("upload_extract.php",{
        method:"POST",
        body:formData
    })
    .then(res => res.text())
    .then(text=>{
        document.getElementById("text").value = text;
    });

});


// ========================================
// TEXT TO SPEECH
// ========================================

const synth = window.speechSynthesis;

let allVoices = [];

const languageSelect = document.getElementById("language");
const voiceSelect = document.getElementById("voice");

const speedSlider = document.getElementById("speed");
const pitchSlider = document.getElementById("pitch");

const speedValue = document.getElementById("speedValue");
const pitchValue = document.getElementById("pitchValue");


// SHOW SLIDER VALUES
speedSlider.oninput = () => {
    speedValue.innerText = speedSlider.value;
};

pitchSlider.oninput = () => {
    pitchValue.innerText = pitchSlider.value;
};


// LOAD VOICES
function loadVoices(){

    allVoices = synth.getVoices();

    // REMOVE DUPLICATES
    const langs = [...new Set(allVoices.map(v => v.lang))];

    languageSelect.innerHTML = "";

    langs.forEach(lang => {

        let option = document.createElement("option");

        option.value = lang;
        option.textContent = lang;

        languageSelect.appendChild(option);

    });

    updateVoices();
}


// UPDATE VOICE LIST
function updateVoices(){

    voiceSelect.innerHTML = "";

    const selectedLang = languageSelect.value;

    const filteredVoices = allVoices.filter(v => v.lang === selectedLang);

    filteredVoices.forEach((voice, index) => {

        let option = document.createElement("option");

        option.value = voice.name;

        // DETECT GENDER
        let gender = "Voice";

        if(voice.name.toLowerCase().includes("female")){
            gender = "Female";
        }
        else if(voice.name.toLowerCase().includes("male")){
            gender = "Male";
        }

        option.textContent =
            `${voice.name} (${gender})`;

        voiceSelect.appendChild(option);

    });

}


// SPEAK BUTTON
let currentUtterance = null;

document.getElementById("speakBtn").onclick = () => {

    const text = document.getElementById("text").value;

    if(text.trim() === ""){
        alert("Enter text first");
        return;
    }

    // STOP OLD SPEECH
    synth.cancel();

    currentUtterance =
        new SpeechSynthesisUtterance(text);

    // SELECTED VOICE
    const selectedVoiceName = voiceSelect.value;

    const selectedVoice = allVoices.find(
        v => v.name === selectedVoiceName
    );

    if(selectedVoice){
        currentUtterance.voice = selectedVoice;
    }

    // LANGUAGE
    currentUtterance.lang =
        languageSelect.value;

    // SPEED
    currentUtterance.rate =
        parseFloat(speedSlider.value);

    // PITCH
    currentUtterance.pitch =
        parseFloat(pitchSlider.value);

    // SPEAK
    synth.speak(currentUtterance);

    // UPDATE AUDIO PLAYER UI
    const player =
        document.getElementById("audioPlayer");

    player.style.display = "block";

};

// EVENTS
languageSelect.addEventListener("change", updateVoices);


// LOAD VOICES
speechSynthesis.onvoiceschanged = loadVoices;

loadVoices();

// AUDIO PLAYER CONTROL EVENTS

const player =
    document.getElementById("audioPlayer");

// PLAY
player.onplay = () => {

    if(currentUtterance){

        synth.cancel();

        synth.speak(currentUtterance);

    }

};

// PAUSE
player.onpause = () => {

    synth.cancel();

};