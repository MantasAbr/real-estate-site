<?php
// operacija2.php
// tiesiog rodomas  tekstas ir nuoroda atgal

session_start();

if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "index"))
{ header("Location: logout.php");exit;}

$server="localhost";
$user="stud";
$password="stud";
$dbname="portalas";
$lentele='object';

$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);

include("include/nustatymai.php");
$user=$_SESSION['user'];
$userid=$_SESSION['userid'];

?>

<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Operacija 2</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
        <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@300&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<style>body{background-image: url("include/background.png");}</style>
    </head>
    <body style="width: 60%; margin-left: auto; margin-right: auto;">
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

                <p style="font-size:22pt; font-family: 'Titillium Web', sans-serif;"><b>Jūsų pirktas nekilnojamasis turtas</b></p>

                <?php
                    $sql =  "SELECT * FROM $lentele WHERE is_sold=1 AND buyer_id='$userid'";
                    if (!$result = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);
                    $result = $conn->query($sql);

                    if($result->num_rows > 0){
                        echo "
                        <table class=\"postContainer\">
                            <tr class=\"postContainer\" style=\"font-size: 22px; font-weight: bold; text-align: center;\">
                                <td class=\"postContainer\" style=\"width: 10%;\">Nuotrauka</td>
                                <td class=\"postContainer\" style=\"width: 25%;\">Vieta</td>
                                <td class=\"postContainer\" style=\"width: 10%;\">Kaina</td>
                                <td class=\"postContainer\" style=\"width: 5%;\">Veiksmai</td>                     
                            </tr>";

                            while($row = $result->fetch_assoc()) {
                                echo "<tr class=\"postContainer\">
                                    <td class=\"postContainer\" style=\"text-align:center;\"><img class=\"postContainer\" src='images/".$row['image']."'></td>                            
                                    <td style=\"font-size: 18px;\" class=\"postContainer\">Adresas: <b>".$row['address']."</b><br><br>Miestas: <b>" .$row['city']."</b></td>
                                    <td class=\"postContainer\" style=\"font-weight: bold; font-size: 20px; text-align:center;\">".$row['price']." €</td>
                                    <td class=\"postContainer\" style=\"text-align:center;\">
                                        <a class=\"postContainerActions\" href='buyersoldpropertiesmoreinfo.php?id=".$row['object_id']."'>
                                            <i class=\"material-icons\" style=\"font-size: 27px; padding-right: 3px;\">
                                            info
                                            </i>
                                            Informacija
                                        </a>
                                    </td>
                                </tr>";                            
                            }

                        echo "</table>";
                    }
                    else{
                        echo "<br>";
                        echo "<p style=\"font-size:16pt; color: darkred; font-family: 'Titillium Web', sans-serif;\"><b>Pirkto nekilnojamojo turto nerasta</b></p>";
                    }
                    $conn->close();    
                ?>
            </div>
        </div>

    </body>		
</html>