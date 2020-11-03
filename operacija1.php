<?php
    // operacija1.php
    // skirtapakeisti savo sudaryta operacija pratybose

    session_start();
    // cia sesijos kontrole
    if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "index"))
    { header("Location:logout.php");exit;}

    $server="localhost";
    $user="stud";
    $password="stud";
    $dbname="portalas";
    $lentele='object';

    $conn = new mysqli($server, $user, $password, $dbname);
    if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);

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
                <a href="index.php" class="goBack">
                    <i class="material-icons" style="font-size: 27px;">
                        keyboard_arrow_left</i>
                        Atgal
                </a>
            </div>

            <div style="padding-top: 30px;"></div>

            <p style="font-size:22pt; font-family: 'Titillium Web', sans-serif;"><b>Skelbimų sąrašas</b></p>


            <table class="postContainer">
                <tr class="postContainer" style="font-size: 22px; font-weight: bold; text-align: center;">
                    <td class="postContainer" style="width: 20%;">Adresas</td>
                    <td class="postContainer" style="width: 8%;">Miestas</td>
                    <td class="postContainer" style="width: 10%;">Kaina</td>
                    <td class="postContainer" style="width: 55%;">Aprašymas</td>
                </tr>

                <?php			
			    //nuskaityti
			    $sql =  "SELECT * FROM $lentele";
                if (!$result = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);

                // parodyti
                while($row = $result->fetch_assoc()) {
                    echo "<tr class=\"postContainer\">
                            <td class=\"postContainer\">".$row['address']."</td>
                            <td class=\"postContainer\">".$row['city']."</td>
                            <td class=\"postContainer\" style=\"font-weight: bold;\">".$row['price']." €</td>
                            <td class=\"postContainer\">".$row['description']."</td>
                        </tr>";
                }
			
			    $conn->close();

                ?>

            </table>
        </div>
    </div>
    </body>
