<?php

require_once __DIR__ .
"/../config/auth_check.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>
About System
</title>

<link rel="stylesheet"
href="../assets/css/about.css">

</head>

<body>

<div class="app">

    <!-- SIDEBAR -->
    <?php include
    "../includes/header.php"; ?>


    <!-- MAIN CONTENT -->
    <main class="mainContent">


        <!-- MOBILE TOP -->
        <div class="mobileTop">

            <div class="mobileLogo">

                🔊 Nem Speak

            </div>

            <button id="menuBtn">

                ☰

            </button>

        </div>


        <!-- PAGE HEADER -->
        <div class="topHeader">

            <h1>
                About The System
            </h1>

            <p>
                Learn more about the
                Text To Speech platform.
            </p>

        </div>


        <!-- ABOUT SECTION -->
        <div class="aboutContainer">


            <!-- LEFT CONTENT -->
            <div class="aboutText">

                <h2>
                    Nem Speak Text To Speech
                </h2>

                <p>

                    Nem Speak is a web-based
                    Text To Speech conversion
                    system developed to convert
                    written text into natural
                    sounding speech in real time.

                </p>

                <p>

                    The system allows users
                    to type text manually
                    or upload text documents
                    for automatic conversion
                    into speech audio.

                </p>

                <p>

                    Users can select from
                    multiple international
                    and local languages,
                    choose different male
                    and female voices,
                    and customize speech
                    speed and pitch settings
                    for a better listening
                    experience.

                </p>

                <p>

                    The platform is designed
                    to assist students,
                    researchers,
                    visually impaired users,
                    content creators,
                    and general users who
                    require audio-based
                    content interaction.

                </p>

                <p>

                    Nem Speak also includes
                    a history management
                    feature that stores
                    previous conversions
                    and allows users to
                    revisit and replay
                    earlier speech outputs.

                </p>

            </div>


            <!-- RIGHT IMAGE -->
            <div class="aboutImage">

                <img
                src="../assets/images/cpr.png"
                alt="Text To Speech">

            </div>

        </div>


        <!-- PROJECT INFORMATION -->

        
        <div class="author-box">

            <h2>Project Information</h2>

            <div class="info-item">
                <span class="label">Project Title:</span>
                <span class="value">
                   Text to Speech   Converting Machine
                </span>
            </div>

            <div class="info-item">
                <span class="label">Developed By:</span>
                <span class="value">Nemi Tonye Ruben</span>
            </div>

            <div class="info-item">
                <span class="label">Role:</span>
                <span class="value">
                    System Analyst, Programmer & Developer
                </span>
            </div>

            <div class="info-item">
                <span class="label">Supervisor:</span>
                <span class="value">Dr Belema</span>
            </div>

        </div>

    </main>

</div>


<!-- SIDEBAR TOGGLE -->
<script>

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

        if(menuBtn && sidebar){

            menuBtn.onclick = ()=>{

                sidebar.classList.toggle(
                    "active"
                );

            };

        }

    }
);

</script>

</body>
</html>