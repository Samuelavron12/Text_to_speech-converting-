<?php

require_once __DIR__ .
"/../config/auth_check.php";

require_once __DIR__ .
"/../config/db.php";


// CHECK ID
if(isset($_GET['id'])){

    $id =
    intval($_GET['id']);

    $user_id =
    $_SESSION['user_id'];


    // DELETE ONLY USER OWN HISTORY
    $sql = "

    DELETE FROM tts_history

    WHERE id = ?
    AND user_id = ?

    ";
     

    $stmt =
    $conn->prepare($sql);

    $stmt->bind_param(
        "ii",
        $id,
        $user_id
    );

    $stmt->execute();

}


// REDIRECT BACK
header(
    "Location: ../tts/history.php"
);

exit();

?>