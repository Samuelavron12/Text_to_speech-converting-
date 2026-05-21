/*

let synth = window.speechSynthesis;
let voices = [];

const voiceSelect = document.getElementById("voiceSelect");

// 🌍 Preferred languages list
const preferredLanguages = [
    "en-NG", // Nigerian English
    "yo-NG", // Yoruba (if available)
    "ig-NG", // Igbo (if available)
    "ha-NG", // Hausa (if available)

    "en-US",
    "en-GB",
    "fr-FR",
    "de-DE",
    "es-ES",
    "it-IT",
    "pt-BR",
    "ar-SA",
    "zh-CN",
    "hi-IN",
    "ja-JP",
    "ko-KR"
];

function loadVoices(){
    voices = synth.getVoices();
    voiceSelect.innerHTML = "";

    // Sort voices by preferred languages first
    voices.sort((a,b)=>{
        let aIndex = preferredLanguages.indexOf(a.lang);
        let bIndex = preferredLanguages.indexOf(b.lang);

        if(aIndex === -1) aIndex = 999;
        if(bIndex === -1) bIndex = 999;

        return aIndex - bIndex;
    });

    voices.forEach((voice, i)=>{
        let option = document.createElement("option");
        option.value = i;

        // ⭐ Highlight Nigerian voices if found
        let label = `${voice.name} (${voice.lang})`;

        if(voice.lang.includes("NG")){
            label = "🇳🇬 " + label;
        }

        option.textContent = label;
        voiceSelect.appendChild(option);
    });
}

speechSynthesis.onvoiceschanged = loadVoices;
loadVoices();

function speakText(){
    let text = document.getElementById("text").value;

    if(text === ""){
        alert("Please enter text");
        return;
    }

    let utterance = new SpeechSynthesisUtterance(text);
    utterance.voice = voices[voiceSelect.value];

    synth.speak(utterance);
}

function stopSpeech(){
    synth.cancel();
}

document.getElementById("languageFilter").addEventListener("change", function(){
    let filter = this.value;
    voiceSelect.innerHTML = "";

    voices.forEach((voice, i)=>{
        if(filter === "all" || voice.lang.includes(filter)){
            let option = document.createElement("option");
            option.value = i;
            option.textContent = `${voice.name} (${voice.lang})`;
            voiceSelect.appendChild(option);
        }
    });
});
*/
window.onload = function(){

    const synth = window.speechSynthesis;
    let voices = [];

    const voiceSelect = document.getElementById("voiceSelect");
    const languageFilter = document.getElementById("languageFilter");

    function populateVoices(){
        voices = synth.getVoices();
        updateVoiceList("all");
    }

    function updateVoiceList(filter){
        voiceSelect.innerHTML = "";

        voices.forEach((voice, index)=>{
            if(filter === "all" || voice.lang.includes(filter)){
                let option = document.createElement("option");
                option.value = index;
                option.textContent = voice.name + " (" + voice.lang + ")";
                voiceSelect.appendChild(option);
            }
        });
    }

    speechSynthesis.onvoiceschanged = populateVoices;
    populateVoices();

    languageFilter.addEventListener("change", function(){
        updateVoiceList(this.value);
    });

    window.speakText = function(){
        let text = document.getElementById("text").value;

        if(text === ""){
            alert("Enter text first");
            return;
        }

        let utterance = new SpeechSynthesisUtterance(text);
        utterance.voice = voices[voiceSelect.value];

        synth.speak(utterance);
    }

    window.stopSpeech = function(){
        synth.cancel();
    }

}