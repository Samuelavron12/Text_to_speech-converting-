// =====================================
// ELEMENTS
// =====================================

const uploadTab = document.getElementById("uploadTab");
const fileInput = document.getElementById("fileInput");
const textArea = document.getElementById("text");
const charCount = document.getElementById("charCount");

const languageSelect = document.getElementById("language");

const speedSlider = document.getElementById("speed");
const pitchSlider = document.getElementById("pitch");

const speedValue = document.getElementById("speedValue");
const pitchValue = document.getElementById("pitchValue");

const speakBtn = document.getElementById("speakBtn");
const playBtn = document.getElementById("playBtn");
const stopBtn = document.getElementById("stopBtn");

// =====================================
// AUDIO PLAYER
// =====================================

let audioPlayer = new Audio();
let currentAudioUrl = "";

// =====================================
// CHARACTER COUNT
// =====================================

function updateCount() {

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
    () => {

        speedValue.innerText =
            speedSlider.value;

        audioPlayer.playbackRate =
            parseFloat(speedSlider.value);

    }
);

// =====================================
// PITCH
// =====================================

pitchSlider.addEventListener(
    "input",
    () => {

        pitchValue.innerText =
            pitchSlider.value;

    }
);

// =====================================
// FILE PICKER
// =====================================

uploadTab.addEventListener(
    "click",
    () => {

        fileInput.click();

    }
);

// =====================================
// FILE EXTRACTION
// =====================================

fileInput.addEventListener(
    "change",
    async () => {

        const file =
            fileInput.files[0];

        if (!file) return;

        const formData =
            new FormData();

        formData.append(
            "file",
            file
        );

        try {

            const response =
                await fetch(
                    "../tts/upload_extract.php",
                    {
                        method: "POST",
                        body: formData
                    }
                );

            const extractedText =
                await response.text();

            textArea.value =
                extractedText;

            updateCount();

        }

        catch (error) {

            console.log(error);

            alert(
                "File extraction failed"
            );

        }

    }
);

// =====================================
// GOOGLE TRANSLATE
// =====================================

async function translateText(
    text,
    language
) {

    try {

        if (
            language === "en-US" ||
            language === "en-GB" ||
            language === "en-NG"
        ) {

            return text;

        }

        const targetLang =
            language.split("-")[0];

        const response =
            await fetch(

                "https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl=" +
                targetLang +
                "&dt=t&q=" +
                encodeURIComponent(text)

            );

        const data =
            await response.json();

        return data[0]
            .map(
                item => item[0]
            )
            .join("");

    }

    catch (error) {

        console.log(error);

        return text;

    }

}

// =====================================
// GENERATE AUDIO
// =====================================

async function speakText() {

    let text =
        textArea.value.trim();

    if (text === "") {

        alert(
            "Please enter text"
        );

        return;

    }

    speakBtn.disabled = true;

    speakBtn.innerHTML =
        '<span>Loading...</span>';

    const selectedLang =
        languageSelect.value;

    // =====================================
    // TRANSLATE
    // =====================================

    const translatedText =
        await translateText(
            text,
            selectedLang
        );

    // =====================================
    // SAVE HISTORY
    // =====================================

    localStorage.setItem(
        "tts_text",
        text
    );

    localStorage.setItem(
        "tts_language",
        selectedLang
    );

    localStorage.setItem(
        "tts_speed",
        speedSlider.value
    );

    localStorage.setItem(
        "tts_pitch",
        pitchSlider.value
    );

    try {

        speakBtn.innerHTML =
            '<span>Converting...</span>';

        const response =
            await fetch(
                "../tts/tts_generate.php",
                {
                    method: "POST",
                    headers: {
                        "Content-Type":
                            "application/json"
                    },
                    body: JSON.stringify({

                        text:
                            translatedText,

                        language:
                            selectedLang,

                        speed:
                            speedSlider.value

                    })
                }
            );

        const result =
            await response.json();

        if (!result.success) {

            throw new Error(
                result.message
            );

        }

        currentAudioUrl =
            result.audio;

        audioPlayer.src =
            currentAudioUrl;

        audioPlayer.playbackRate =
            parseFloat(
                speedSlider.value
            );

        audioPlayer.play();

        speakBtn.innerHTML =
            '<span>Converted</span>';

        setTimeout(
            () => {

                speakBtn.innerHTML =
                    '<span>Convert To Speech</span>';

                speakBtn.disabled = false;

            },
            2000
        );

        // SAVE TO DATABASE

        fetch(
            "../tts/save_history.php",
            {
                method: "POST",
                headers: {
                    "Content-Type":
                        "application/json"
                },
                body: JSON.stringify({

                    text_content:
                        text,

                    language_used:
                        selectedLang,

                    speech_speed:
                        speedSlider.value,

                    speech_pitch:
                        pitchSlider.value

                })
            }
        );

    }

    catch (error) {

        console.log(error);

        alert(
            "Failed to generate audio"
        );

        speakBtn.disabled = false;

        speakBtn.innerHTML =
            '<span>Convert To Speech</span>';

    }

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
    () => {

        if (
            audioPlayer.src
        ) {

            audioPlayer.play();

        }

    }
);

// =====================================
// STOP
// =====================================

stopBtn.addEventListener(
    "click",
    () => {

        audioPlayer.pause();

    }
);

// =====================================
// LOAD HISTORY
// =====================================

window.addEventListener(
    "load",
    () => {

        const savedText =
            localStorage.getItem(
                "tts_text"
            );

        const savedLanguage =
            localStorage.getItem(
                "tts_language"
            );

        const savedSpeed =
            localStorage.getItem(
                "tts_speed"
            );

        const savedPitch =
            localStorage.getItem(
                "tts_pitch"
            );

        if (savedText) {

            textArea.value =
                savedText;

            languageSelect.value =
                savedLanguage;

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
// MOBILE MENU
// =====================================

window.addEventListener(
    "load",
    () => {

        const menuBtn =
            document.getElementById(
                "menuBtn"
            );

        const sidebar =
            document.getElementById(
                "sidebar"
            );

        if (
            menuBtn &&
            sidebar
        ) {

            menuBtn.onclick =
                () => {

                    sidebar.classList.toggle(
                        "active"
                    );

                };

        }

    }
);