<?php

session_start();

$server="localhost";
$user="stud";
$password="stud";
$dbname="portalas";
$lentele="user_level_message";
$users="vartotojas";

$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);

include("include/nustatymai.php");


?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Patvirtinimo laukiantys prašymai</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
        <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@300&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<style>body{background-image: url("include/background.png");}</style>
    </head>
    <body style="width: 70%; margin-left: auto; margin-right: auto;">
        <div align="center">
            
            <div class="postContainer">

                <div style="float:left;"> 
                    <a href="admin.php" class="goBack">
                        <i class="material-icons" style="font-size: 27px;">
                            keyboard_arrow_left</i>
                            Atgal
                    </a>
                </div>

                <div style="padding-top: 30px;"></div>

                <p style="font-size:22pt; font-family: 'Titillium Web', sans-serif;"><b>Aktyvūs prašymai</b></p>

                <?php echo "<p style=\"color: red; font-family: 'Titillium Web', Courier, monospace; font-size: 18px;\">
                ".$_SESSION['message'] . "<br></p>"; $_SESSION['message']="";?>

                <?php
                    $sql =  "SELECT * FROM $lentele";
                    if (!$result = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);
                    $result = $conn->query($sql);

                    if($result->num_rows > 0){
                        echo "
                        <table class=\"postContainer\">
                            <tr class=\"postContainer\" style=\"font-size: 22px; font-weight: bold; text-align: center;\">
                                <td class=\"postContainer\" style=\"width: 65%;\">Prašymas</td>
                                <td class=\"postContainer\" style=\"width: 25%;\">Vartotojas</td>
                                <td class=\"postContainer\" style=\"width: 10%;\">Veiksmai</td>                     
                            </tr>";

                            while($row = $result->fetch_assoc()) {
                                $user_id = $row['user_id'];
                                $user_sql = "SELECT * FROM $users WHERE userid='$user_id'";
                                if (!$user_result = $conn->query($user_sql)) die("Negaliu nuskaityti: " . $conn->error);
                                while($user_row = $user_result->fetch_assoc()){
                                    echo "<tr class=\"postContainer\">
                                        <td style=\"font-size: 18px;\" class=\"postContainer\">" .$row['message']."</b></td>
                                        <td class=\"postContainer\"><b>".$user_row['username']."</b><br><br>tel. <b>"
                                                                        .$user_row['telephone']."</b><br><br>e. paštas <b>"
                                                                        .$user_row['email']."</b></td>
                                        <td class=\"postContainer\">
                                            <a class=\"postContainerActions\" style=\"color: darkgreen;\" href='adminapproverequest.php?id=".$row['user_id']."'>
                                                <i class=\"material-icons\" style=\"font-size: 27px; padding-right: 3px;\">
                                                check_circle
                                                </i>
                                                Patvirtinti
                                            </a>
                                            <br>
                                            <a class=\"postContainerActions\" style=\"color: darkred; padding-right: 20px;\" href='admindenyrequest.php?id=".$row['user_id']."'>
                                                <i class=\"material-icons\" style=\"font-size: 27px; padding-right: 3px;\">
                                                cancel
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
                        echo "<p style=\"font-size:16pt; color: darkred; font-family: 'Titillium Web', sans-serif;\"><b>Prašymų nerasta</b></p>";
                    }
                    $conn->close();    
                ?>
            </div>
        </div>
    </body>
</html>