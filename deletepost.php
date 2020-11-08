<?php

    session_start();

    include("include/nustatymai.php");
    $id = $_GET['id'];
    $_SESSION['message']="";
    
    $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

    if(!$conn){
        die("Nepavyko prisijungti! ". mysqli_connect_error());
    }

    $sql = "DELETE FROM object WHERE object_id = '$id'";

    if(mysqli_query($conn, $sql)){
        mysqli_close($conn);
        $_SESSION['message']="Objektas sėkmingai ištrintas";
        header('Location: operacija1.php');
        exit;
    }
    else{
        $_SESSION['message']="Klaida trinant įrašą";
        header('Location: operacija1.php');
        exit;
    }
?>