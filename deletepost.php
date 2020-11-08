<?php

    include("include/nustatymai.php");
    $id = $_GET['id'];
    
    $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

    if(!$conn){
        die("Nepavyko prisijungti! ". mysqli_connect_error());
    }

    $sql = "DELETE FROM object WHERE object_id = '$id'";

    if(mysqli_query($conn, $sql)){
        mysqli_close($conn);
        header('Location: operacija1.php');
        exit;
    }
    else{
        echo "Klaida trinant įrašą.";
    }
?>