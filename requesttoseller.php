<?php

    session_start();

    if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "index") && ($_SESSION['prev'] != "procrequesttoseller"))
    { header("Location: logout.php");exit;}

    $_SESSION['prev']="requesttoseller";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Privilegijų aukštinimas</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
        <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@300&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<style>body{background-image: url("include/background.png");}</style>
    </head>

    <body style="width: 70%; margin-left: auto; margin-right: auto;">
        <div align="center">

        <div class="postContainer">

            <div style="float:left;"> 
                <a href="index.php" class="goBack">
                    <i class="material-icons" style="font-size: 27px;">
                        keyboard_arrow_left</i>
                        Atgal
                </a>
            </div>

            <div style="padding-top: 50px;"></div>

            <p style="font-size:12pt; font-family: 'Titillium Web', sans-serif; text-align:left;">
                <b>Jeigu esate nekilnojamojo turto agentas ir norėtumėte pardavinėti nekilnojamajį turtą šioje svetainėje, 
                pateikite privilegijų aukštinimo prašymą šioje formoje. Svetainės administratorius, įvertinęs paraiškos tikimumą,
                atitinkamai atsakys į Jūsų paraišką.
                </b>
            </p>

            <form id="request" action="procrequesttoseller.php" method="POST">
                <textarea autofocus="true" rows="4" cols="50" class="request" maxlength="200" name="request" form="request" placeholder="Įveskite tekstą..."></textarea>
                <br>
                <input class="button" style="margin-top: 30px;" type="submit" value="Pateikti">
            </form>

            

        </div>
    </body>
</html>