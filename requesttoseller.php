<?php

    session_start();

    if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "index") && ($_SESSION['prev'] != "procrequesttoseller"))
    { header("Location: logout.php");exit;}

    $_SESSION['prev']="requesttoseller";
    $userid=$_SESSION['userid'];

    $server="localhost";
    $user="stud";
    $password="stud";
    $dbname="portalas";
    $lentele='user_level_message';

    $conn = new mysqli($server, $user, $password, $dbname);
    if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
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

            <?php
                $sql =  "SELECT * FROM $lentele WHERE user_id='$userid' LIMIT 1";
                if (!$result = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);
                $result = $conn->query($sql);

                if($result->num_rows > 0){
                    echo "<p style=\"font-size:16pt; color: darkred; font-family: 'Titillium Web', sans-serif;\"><b>Užklausa pateikta</b></p>";
                }
                else {
                    echo "            
                    <p style=\"font-size:12pt; font-family: 'Titillium Web', sans-serif; text-align:left;\">
                        <b>Jeigu esate nekilnojamojo turto agentas ir norėtumėte pardavinėti nekilnojamajį turtą šioje svetainėje, 
                        pateikite privilegijų aukštinimo prašymą šioje formoje. Svetainės administratorius, įvertinęs paraiškos tikimumą,
                        atitinkamai atsakys į Jūsų paraišką.
                        </b>
                    </p>
    
                    <form id=\"request\" action=\"procrequesttoseller.php\" method=\"POST\">
                        <textarea autofocus=\"true\" rows=\"4\" cols=\"50\" class=\"request\" maxlength=\"200\" name=\"request\" form=\"request\" placeholder=\"Įveskite tekstą...\"></textarea>                     
                        <br>";
                        echo $_SESSION['description_error'];
                        echo " <br>
                        <input class=\"button\" style=\"margin-top: 30px;\" type=\"submit\" value=\"Pateikti\">
                    </form>
                ";
                }
            ?>
        </div>
    </body>
</html>