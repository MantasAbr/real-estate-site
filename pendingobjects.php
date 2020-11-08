<?php

session_start();
// cia sesijos kontrole
if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "index"))
{ header("Location:logout.php");exit;}

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

echo "<p style=\"color: red; font-family: 'Titillium Web', Courier, monospace; font-size: 18px;\">
".$_SESSION['message'] . "<br></p>"; 

$_SESSION['message']="";

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

    <body style="width: 90%; margin-left: auto; margin-right: auto;">
    
        <div class="postContainer">

            <div align="center">  
                <div style="float:left;"> 
                    <a href="index.php" class="goBack">
                        <i class="material-icons" style="font-size: 27px;">
                            keyboard_arrow_left</i>
                            Atgal
                    </a>
                </div>

                <div style="padding-top: 30px;"></div>

                <p style="font-size:22pt; font-family: 'Titillium Web', sans-serif;"><b>Patvirtinimo laukiantys skelbimai</b></p>
                <p style="font-size:16pt; font-family: 'Titillium Web', sans-serif;">Pardavėjas: <b style="font-size:16pt;"><?php echo $user;?></b></p>

                <?php
                    $sql =  "SELECT * FROM $lentele WHERE is_sold=0 AND is_pending=1 AND seller_id='$userid'";
                    if (!$result = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);
                    $result = $conn->query($sql);

                    if($result->num_rows > 0){
                        echo "
                        <table class=\"postContainer\">
                            <tr class=\"postContainer\" style=\"font-size: 22px; font-weight: bold; text-align: center;\">
                                <td class=\"postContainer\" style=\"width: 20%;\">Nuotrauka</td>
                                <td class=\"postContainer\" style=\"width: 20%;\">Vieta</td>
                                <td class=\"postContainer\" style=\"width: 10%;\">Kaina</td>
                                <td class=\"postContainer\" style=\"width: 30%;\">Aprašymas</td>
                                <td class=\"postContainer\" style=\"width: 25%;\">Pirkėjo informacija</td>
                                <td class=\"postContainer\" style=\"width: 10%;\">Veiksmai</td>                     
                            </tr>";
                        

                        while($row = $result->fetch_assoc()) {
                            $buyer_id = $row['buyer_id'];
                            $buyer_sql = "SELECT * FROM $pirkeju_lentele WHERE userid='$buyer_id'";
                            if (!$buyer_result = $conn->query($buyer_sql)) die("Negaliu nuskaityti: " . $conn->error);
                            while($buyer_row = $buyer_result->fetch_assoc()){
                                echo "<tr class=\"postContainer\">
                                    <td class=\"postContainer\"><img class=\"postContainer\" src='images/".$row['image']."'></td>                            
                                    <td style=\"font-size: 18px;\" class=\"postContainer\">".$row['address']."<br><br>" .$row['city']."</td>
                                    <td class=\"postContainer\" style=\"font-weight: bold;\">".$row['price']." €</td>
                                    <td class=\"postContainer\">".$row['description']."</td>
                                    <td class=\"postContainer\"><b>".$buyer_row['username']."</b><br><br>tel. <b>"
                                                                    .$buyer_row['telephone']."</b><br><br>e. paštas <b>"
                                                                    .$buyer_row['email']."</b></td>
                                    <td class=\"postContainer\">
                                        <a class=\"postContainerActions\" href='acceptpost.php?id=".$row['object_id']."'>
                                            <i class=\"material-icons\" style=\"font-size: 27px; padding-right: 3px; color: green;\">
                                            check_circle_outline
                                            </i>
                                            Patvirtinti
                                        </a>

                                        <br>

                                        <a class=\"postContainerActions\" style=\"padding: 2px 20px 2px 7px;\"href='denypost.php?id=".$row['object_id']."'>
                                            <i class=\"material-icons\" style=\"font-size: 27px; padding-right: 3px; color: darkred;\">
                                            highlight_off
                                            </i>
                                            Atmesti
                                        </a>
                                    </td>
                                </tr>";
                            }
                        }
                        echo "</table>";
                    }
                    else{
                        echo "<br>";
                        echo "<p style=\"font-size:16pt; color: darkred; font-family: 'Titillium Web', sans-serif;\"><b>Patvirtinimo laukiančių skelbimų nerasta</b></p>";
                    }

                    $conn->close();
                ?>
            </div>
        </div>
    </body>
</html>