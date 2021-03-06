<?php

    session_start();

    include("include/nustatymai.php");
    $id = $_GET['id'];
    $_SESSION['message']="";
    $userID=$_SESSION['userid'];
    
    $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

    if(!$conn){
        die("Nepavyko prisijungti! ". mysqli_connect_error());
    }

    $result = mysqli_query($conn, "SELECT * FROM object WHERE object_id='$id'");
    $row = mysqli_fetch_assoc($result);
    $date = date_create_from_format('Y-m-d H:i:s', $row['upload_time']);

    $updateViews = mysqli_query($conn, "UPDATE object SET views=views+1 WHERE object_id='$id'");
    if(mysqli_query($conn, $updateViews)){
        echo "Nepavyksta padidinti skelbimo peržiūrų skaitliuko";        
    }

    $conn->close();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Skelbimų peržiūra</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
        <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@300&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<style>body{background-image: url("include/background.png");}</style>
    </head>

    <body style="width: 70%; margin-left: auto; margin-right: auto;">
    <div align="center">			
	    <div class="postContainer">

            <div style="float:left;"> 
                <a href="operacija1.php" class="goBack">
                    <i class="material-icons" style="font-size: 27px;">
                        keyboard_arrow_left</i>
                        Atgal
                </a>
            </div>

            <div style="padding-top: 80px;"></div>

            <div class="moreInfoImageContainer">
                <?php echo "<img class=\"moreInfoContainer\" src='images/".$row['image']."'>"; ?>
            </div>

            <p style="font-size:22pt; font-family: 'Titillium Web', sans-serif; padding-top: 20px;"><b>Papildoma informacija</b></p>

            <div class="moreInfoContainer">
                <p style="float: left; text-align:left; width: 50%;">Adresas:</p>
                <p style="float: left; text-align:right; width: 50%;"><b><?php echo $row['address'];?></b></p>
            </div>
            <div style="clear: both;"></div>

            <div class="moreInfoContainer">
                <p style="float: left; text-align:left; width: 50%;">Miestas:</p>
                <p style="float: left; text-align:right; width: 50%;"><b><?php echo $row['city'];?></b></p>
            </div>
            <div style="clear: both;"></div>

            <div class="moreInfoContainer">
                <p style="float: left; text-align:left; width: 50%;">Kaina:</p>
                <p style="float: left; text-align:right; width: 50%;"><b><?php echo $row['price'];?>€</b></p>
            </div>
            <div style="clear: both;"></div>

            <div class="moreInfoContainer">
                <p style="float: left; text-align:left; width: 50%;">Ikelta:</p>
                <p style="float: left; text-align:right; width: 50%;"><b><?php echo date_format($date, 'Y-m-d H:m');?></b></p>
            </div>
            <div style="clear: both;"></div>

            <div class="moreInfoContainer">
                <p style="float: left; text-align:left; width: 50%;">Skelbimo peržiūros:</p>
                <p style="float: left; text-align:right; width: 50%;"><b><?php echo $row['views'];?></b></p>
            </div>
            <div style="clear: both;"></div>

            <?php
                if($userID == $row['seller_id']){
                    echo "
                        <div class=\"moreInfoContainer\">
                            <p style=\"float: left; text-align:left; width: 50%;\">Rezervacijų kiekis:</p>
                            <p style=\"float: left; text-align:right; width: 50%;\"><b>"; echo $row['times_reserved']; echo "</b></p>
                        </div>
                        <div style=\"clear: both;\"></div>              
                    ";
                }
            ?>

            <div class="moreInfoContainer"></div>

            <div class="moreInfoContainer">
                <p><?php echo $row['description'];?></p>
            </div>

            <div style="padding-bottom: 20px;"></div>

        </div>
    </div>

    </body>
</html>