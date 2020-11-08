<?php

    session_start();

    include("include/nustatymai.php");
    $id = $_GET['id'];
    $_SESSION['message']="";
    $buyer=$_SESSION['userid'];
    
    $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

    if(!$conn){
        die("Nepavyko prisijungti! ". mysqli_connect_error());
    }

    $sql = "UPDATE object SET is_pending=0, is_sold=1, buy_time=NOW() WHERE object_id = '$id'";

    if(mysqli_query($conn, $sql)){
        mysqli_close($conn);
        $_SESSION['message']="Pirkimo užklausa patvirtinta";
        header('Location: pendingobjects.php');
        exit;
    }
    else{
        $_SESSION['message']="Pirkimo užklausos patvirtinimo klaida";
        header('Location: pendingobjects.php');
        exit;
    }
?>