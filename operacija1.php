<?php
    // operacija1.php
    // skirtapakeisti savo sudaryta operacija pratybose

    session_start();
    // cia sesijos kontrole
    if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "index") && ($_SESSION['prev'] != "procnewadvert"))
    { header("Location:logout.php");exit;}

    $server="localhost";
    $user="stud";
    $password="stud";
    $dbname="portalas";
    $lentele='object';

    $conn = new mysqli($server, $user, $password, $dbname);
    if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);

    include("include/nustatymai.php");
    $user=$_SESSION['user'];
    $userlevel=$_SESSION['ulevel'];
    $role="";
    {foreach($user_roles as $x=>$x_value)
        {if ($x_value == $userlevel) $role=$x;}
    }
    
    echo "<p style=\"color: red; font-family: 'Titillium Web', Courier, monospace; font-size: 18px;\">
    ".$_SESSION['message'] . "<br></p>"; 

    $_SESSION['message']="";

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

            <?php
                if(($userlevel == $user_roles["Pardavėjas"])){
                    echo "
                        <div style=\"float:right;\">
                            <a href=\"sellerviewsoldproperties.php\" class=\"goBack\">
                                <i class=\"material-icons\" style=\"font-size: 27px; padding: 0 5px;\">
                                library_books</i>
                            Parduoti skelbimai
                            </a>
                        </div>
                    ";
                }
            ?>


            <div style="padding-top: 30px;"></div>

            <p style="font-size:22pt; font-family: 'Titillium Web', sans-serif;"><b>Skelbimų sąrašas</b></p>


            <table class="postContainer">
                <tr class="postContainer" style="font-size: 22px; font-weight: bold; text-align: center;">
                    <td class="postContainer" style="width: 20%;">Nuotrauka</td>
                    <td class="postContainer" style="width: 20%;">Vieta</td>
                    <td class="postContainer" style="width: 10%;">Kaina</td>
                    <?php
                        if($_SESSION['user'] == "guest")
                            echo "";
                        else
                            echo "<td class=\"postContainer\" style=\"width: 6%;\">Veiksmai</td>";
                    ?>
                </tr>

                <?php			
			    //nuskaityti
			    $sql =  "SELECT * FROM $lentele WHERE is_sold=0 AND is_pending=0";
                if (!$result = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);

                // parodyti
                while($row = $result->fetch_assoc()) {
                    if($_SESSION['user'] == "guest"){
                        echo "<tr class=\"postContainer\">
                            <td class=\"postContainer\" style=\"text-align:center;\"><img class=\"postContainer\" src='images/".$row['image']."'></td>                            
                            <td style=\"font-size: 18px;\" class=\"postContainer\">".$row['address']."<br><br>" .$row['city']."</td>
                            <td class=\"postContainer\" style=\"font-weight: bold;\">".$row['price']." €</td>
                            </tr>";
                    }
                    else{
                        echo "<tr class=\"postContainer\">
                            <td class=\"postContainer\" style=\"text-align:center;\"><img class=\"postContainer\" src='images/".$row['image']."'></td>                            
                            <td style=\"font-size: 18px;\" class=\"postContainer\">Adresas: <b>".$row['address']."</b><br><br>Miestas: <b>" .$row['city']."</b></td>
                            <td class=\"postContainer\" style=\"font-weight: bold;\">".$row['price']." €</td>
                            <td class=\"postContainer\" style=\"text-align:center;\">
                            
                                <a class=\"postContainerActions\" style=\"padding: 2px 10px 2px 8px;\" href='moreinfopost.php?id=".$row['object_id']."'>
                                    <i class=\"material-icons\" style=\"font-size: 27px; padding-right: 3px;\">
                                    info
                                    </i>
                                    Informacija
                                </a>
                                
                                ".(($userlevel == $user_roles["Pardavėjas"]) || ($userlevel == $user_roles[ADMIN_LEVEL] ) ? "
                                <a class=\"postContainerActions\" style=\"padding: 2px 15.25px 2px 8px;\" href='editpost.php?id=".$row['object_id']."'>
                                    <i class=\"material-icons\" style=\"font-size: 27px; padding-right: 4px;\">
                                    edit
                                    </i>
                                    Redaguoti
                                </a>

                                <br>  

                                <a class=\"postContainerActions\" style=\"padding: 2px 29px 2px 8px; color: darkred\" href='deletepost.php?id=".$row['object_id']."'>
                                    <i class=\"material-icons\" style=\"font-size: 27px; padding-right: 15px;\">
                                    cancel
                                    </i>
                                    Ištrinti
                                </a>" 

                                :  "")."                                                          
                                
                                ".(($userlevel == $user_roles["Vartotojas"]) || ($userlevel == $user_roles[ADMIN_LEVEL] ) ?
                                "<a class=\"postContainerActions\" style=\"padding: 2px 34px 2px 8px;\" href='buypost.php?id=".$row['object_id']."'>
                                    <i class=\"material-icons\" style=\"font-size: 27px; padding-right: 18px;\">
                                    forward_to_inbox
                                    </i>
                                    Pirkti
                                </a>" 
                                
                                : "")."


                                
                            </td>
                        </tr>";
                    }
                }
			
			    $conn->close();

                ?>

            </table>
        </div>
    </div>
    </body>
