<?php

session_start();

$server="localhost";
$user="stud";
$password="stud";
$dbname="portalas";
$lentele='object';
$pirkeju_lentele="vartotojas";

$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);

include("include/nustatymai.php");
$user=$_SESSION['user'];
$userid=$_SESSION['userid'];

?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Patvirtinimo laukiantys skelbimai</title>
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

                <div style="padding-top: 30px;"></div>

                <p style="font-size:22pt; font-family: 'Titillium Web', sans-serif;"><b>Visi parduoti skelbimai</b></p>
                <p style="font-size:16pt; font-family: 'Titillium Web', sans-serif;">Pardavėjas: <b style="font-size:16pt;"><?php echo $user;?></b></p>

                <?php
                    $sql =  "SELECT * FROM $lentele WHERE is_sold=1 AND seller_id='$userid'";
                    if (!$result = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);

                    if($result->num_rows > 0){
                        echo "
                        <table class=\"postContainer\">
                            <tr class=\"postContainer\" style=\"font-size: 22px; font-weight: bold; text-align: center;\">
                                <td class=\"postContainer\" style=\"width: 20%;\">Nuotrauka</td>
                                <td class=\"postContainer\" style=\"width: 20%;\">Vieta</td>
                                <td class=\"postContainer\" style=\"width: 10%;\">Kaina</td>
                                <td class=\"postContainer\" style=\"width: 25%;\">Pirkėjas</td>
                                <td class=\"postContainer\" style=\"width: 8%;\">Veiksmai</td>                     
                            </tr>";

                            while($row = $result->fetch_assoc()) {
                                $buyer_id = $row['buyer_id'];
                                $buyer_sql = "SELECT * FROM $pirkeju_lentele WHERE userid='$buyer_id'";
                                if (!$buyer_result = $conn->query($buyer_sql)) die("Negaliu nuskaityti: " . $conn->error);
                                while($buyer_row = $buyer_result->fetch_assoc()){
                                    echo "<tr class=\"postContainer\">
                                        <td class=\"postContainer\" style=\"text-align:center;\"><img class=\"postContainer\" src='images/".$row['image']."'></td>                            
                                        <td style=\"font-size: 18px;\" class=\"postContainer\">Adresas: <b>".$row['address']."</b><br><br>Miestas: <b>" .$row['city']."</b></td>
                                        <td class=\"postContainer\" style=\"font-weight: bold;\">".$row['price']." €</td>
                                        <td class=\"postContainer\"><b>".$buyer_row['username']."</b><br><br>tel. <b>"
                                                                        .$buyer_row['telephone']."</b><br><br>e. paštas <b>"
                                                                        .$buyer_row['email']."</b></td>
                                        <td class=\"postContainer\">
                                            <a class=\"postContainerActions\" href='sellersoldpropertiesmoreinfo.php?id=".$row['object_id']."'>
                                                <i class=\"material-icons\" style=\"font-size: 27px; padding-right: 3px;\">
                                                info
                                                </i>
                                                Informacija
                                            </a>
                                        </td>
                                    </tr>";
                                }
                            }

                        echo "</table>";
                    }
                    else{
                        echo "<br>";
                        echo "<p style=\"font-size:16pt; color: darkred; font-family: 'Titillium Web', sans-serif;\"><b>Parduotų skelbimų nerasta</b></p>";
                    }
                    $conn->close();    
                ?>
            </div>
        </div>
    </body>
</html>