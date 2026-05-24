<?php

require_once __DIR__ .
"/../config/auth_check.php";

require_once __DIR__ .
"/../config/db.php";


$user_id =
$_SESSION['user_id'];


// GET HISTORY
$sql = "

SELECT *

FROM tts_history

WHERE user_id = ?

ORDER BY created_at DESC

";


$stmt =
$conn->prepare($sql);

$stmt->bind_param(
    "i",
    $user_id
);

$stmt->execute();

$result =
$stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>History</title>

<link rel="stylesheet"
href="../assets/css/spe.css?v=<?php echo time(); ?>">

</head>

<body>

<div class="app">

    <!-- SIDEBAR -->
    <?php include "../includes/header.php"; ?>

    <!-- MAIN -->
    <main class="mainContent">

        <!-- MOBILE TOP -->
        <div class="mobileTop">

           <!--- <div class="mobileLogo">

                🔊 Nem Speak

            </div>---->
            <h2 class="logoTitle">
                <img src="../assets/images/logo.png" alt="Logo">
                <span>
                    Nem Speaks
                </span>
            </h2>

            <button id="menuBtn">
                ☰
            </button>

        </div>

        <!-- HEADER -->
        <div class="topHeader">

            <h1>History</h1>

            <p>
                All your speech conversions.
            </p>

        </div>

        <!-- HISTORY GRID -->
        <div class="historyGrid">

            <?php
            while(
                $row =
                $result->fetch_assoc()
            ):
            ?>

                    <div class="historyCard"

                    onclick='openHistory(

                    <?php echo json_encode(
                        $row["text_content"]
                    ); ?>,

                    <?php echo json_encode(
                        $row["language_used"]
                    ); ?>,

                    <?php echo json_encode(
                        $row["voice_used"]
                    ); ?>,

                    <?php echo json_encode(
                        $row["speech_speed"]
                    ); ?>,

                    <?php echo json_encode(
                        $row["speech_pitch"]
                    ); ?>

                    )'
                    >

                <div class="historyTop">

                    <span class="historyLang">

                        <?php
                        echo
                        $row[
                            'language_used'
                        ];
                        ?>

                    </span>

                    <span class="historyDate">

                        <?php
                        echo
                        date(
                            "M d, Y",
                            strtotime(
                                $row[
                                    'created_at'
                                ]
                            )
                        );
                        ?>

                    </span>

                </div>

                <p class="historyText">

                    <?php

                    echo substr(

                        htmlspecialchars(
                            $row[
                                'text_content'
                            ]
                        ),

                        0,

                        180

                    );

                    ?>

                </p>

                <div class="historyBottom">

    <span>

        🎤

        <?php
        echo
        $row[
            'voice_used'
        ];
        ?>

    </span>


    <!-- DELETE BUTTON -->
    <a

    href="delete_history.php?id=<?php
    echo $row['id'];
    ?>"

    class="deleteBtn"

  

    >

        <img
        src="../assets/images/delete.png"
        alt="Delete">

    </a>

</div>

            </div>

            <?php endwhile; ?>

        </div>

    </main>

</div>

<script src="../js/speak.js"></script>
<script>

// OPEN HISTORY
function openHistory(

    text,
    language,
    voice,
    speed,
    pitch

){

    // SAVE TO LOCAL STORAGE
    localStorage.setItem(
        "tts_text",
        text
    );

    localStorage.setItem(
        "tts_language",
        language
    );

    localStorage.setItem(
        "tts_voice",
        voice
    );

    localStorage.setItem(
        "tts_speed",
        speed
    );

    localStorage.setItem(
        "tts_pitch",
        pitch
    );

    // REDIRECT
    window.location.href =
    "../tts/speak.php";

}
</script>
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