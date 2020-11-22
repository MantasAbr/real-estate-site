<?php

    session_start();

    include("include/nustatymai.php");
    $id = $_GET['id'];
    $_SESSION['message']="";
    
    $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

    if(!$conn){
        die("Nepavyko prisijungti! ". mysqli_connect_error());
    }

    $sql = "DELETE FROM user_level_message WHERE user_id = '$id'";

    if(mysqli_query($conn, $sql)){
        mysqli_close($conn);
        $_SESSION['message']="Užklausa atmesta";
        header('Location: adminviewrequests.php');
        exit;
    }
    else{
        $_SESSION['message']="Užklausos atmetimo klaida";
        header('Location: adminviewrequests.php');
        exit;
    }
?>