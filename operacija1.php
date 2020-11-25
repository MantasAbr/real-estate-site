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
    $userID=$_SESSION['userid'];
    $role="";
    {foreach($user_roles as $x=>$x_value)
        {if ($x_value == $userlevel) $role=$x;}
    }
   
    if($_POST != null){
        if(isset($_POST["price"]))
            $priceFilterChoice = $_POST["price"];
        else
            $priceFilterChoice = NULL;
                    
        $cityValue = htmlspecialchars($_POST["cityValue"]);
        $_SESSION['city_value']=$cityValue;
        //Įvedimo lauko patikra
        if(!preg_match_all("/^([a-zA-Z \p{L}-])*$/u", $cityValue)){
            $_SESSION['message']="Neteisingai įvestas miestas";
            $_SESSION['city_value']=$cityValue;
            echo $_SESSION['city_value'];
            header("Location:operacija1.php");exit;
        }
        //Nepasirinktas miestas
        else if(!$cityValue || strlen($cityValue = trim($cityValue)) == 0){
            if($priceFilterChoice == "Pigiausi viršuje?"){
                $sql = "SELECT * FROM $lentele WHERE is_pending=0 AND is_sold=0 ORDER BY price ASC";
                if (!$result = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);
            }
            else if($priceFilterChoice == "Pigiausi apačioje?"){
                $sql = "SELECT * FROM $lentele WHERE is_pending=0 AND is_sold=0 ORDER BY price DESC";
                if (!$result = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);
            }
            //Nepasirinktas ir rusiavimas, vadinasi nera nieko pasirinkta
            else{
                $_SESSION['message']="Nepasirinkti filtravimo laukai!";
                header("Location:operacija1.php");exit;
            }
        }
        //Nepasirinktas rusiavimas
        else if(!isset($priceFilterChoice)){
            $sql = "SELECT * FROM $lentele WHERE city='$cityValue' AND is_pending=0 AND is_sold=0";
            if (!$result = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);
        }
        //Pasirinkti visi
        else if((isset($priceFilterChoice) && isset($cityValue))){
            if($priceFilterChoice == "Pigiausi viršuje?"){
                $sql = "SELECT * FROM $lentele WHERE city='$cityValue' AND is_pending=0 AND is_sold=0 ORDER BY price ASC";
                if (!$result = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);
            }
            else if($priceFilterChoice == "Pigiausi apačioje?"){
                $sql = "SELECT * FROM $lentele WHERE city='$cityValue' AND is_pending=0 AND is_sold=0 ORDER BY price DESC";
                if (!$result = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);
            }
        }
    }
    else{       
        //nuskaityti
        $_SESSION['city_value']="";
        $sql =  "SELECT * FROM $lentele WHERE is_sold=0 AND is_pending=0";
        if (!$result = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);
    }
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

            <?php echo "<p style=\"color: red; font-family: 'Titillium Web', Courier, monospace; font-size: 18px;\">
                ".$_SESSION['message'] . "<br></p>"; $_SESSION['message']="";?>

            <form class="filterBox" method="POST">
                <div>
                    <i class="material-icons" style="position: absolute; font-size: 36px; color: gray; padding-top: 5px; padding-left: 5px;">search</i>
                    <input class="filterInput" type="text" name="cityValue" maxlength="30" placeholder="Ieškoti pagal miestą..." value="<?php echo $_SESSION['city_value'];  ?>">
                </div>
                <div style="padding: 8px;">
                    <input style="padding-right: 10px;" type="radio" id="cheap" name="price" value="Pigiausi viršuje?">
                    <label style="padding-right: 10px;" for="cheap">Pigiausi viršuje?</label>
                    <input type="radio" id="expensive" name="price" value="Pigiausi apačioje?">
                    <label for="expensive">Pigiausi apačioje?</label>
                </div>
                <div>
                    <input class="filterButton" type="submit" name="Ieškoti" value="Filtruoti">
                </div>
            </form>

            <?php
            if($result->num_rows > 0)
            { 
                echo "
                <table class=\"postContainer\">
                    <tr class=\"postContainer\" style=\"font-size: 22px; font-weight: bold; text-align: center;\">
                        <td class=\"postContainer\" style=\"width: 5%;\">Nuotrauka</td>
                        <td class=\"postContainer\" style=\"width: 20%;\">Vieta</td>
                        <td class=\"postContainer\" style=\"width: 10%;\">Kaina</td>";
                            if($_SESSION['user'] == "guest")
                                echo "";
                            else
                                echo "<td class=\"postContainer\" style=\"width: 6%;\">Veiksmai</td>                        
                    </tr>";



                    // parodyti
              
                    while($row = $result->fetch_assoc()) {
                        if($_SESSION['user'] == "guest"){
                            echo "<tr class=\"postContainer\">
                                <td class=\"postContainer\" style=\"text-align:center;\"><img class=\"postContainer\" src='images/".$row['image']."'></td>                            
                                <td style=\"font-size: 18px;\" class=\"postContainer\">Adresas: <b>".$row['address']."</b><br><br>Miestas: <b>" .$row['city']."</td>
                                <td class=\"postContainer\" style=\"font-weight: bold; font-size: 20px;\">".$row['price']." €</td>
                                </tr>";
                        }
                        else{
                            echo "<tr class=\"postContainer\">
                                <td class=\"postContainer\" style=\"text-align:center;\"><img class=\"postContainer\" src='images/".$row['image']."'></td>                            
                                <td style=\"font-size: 18px;\" class=\"postContainer\">Adresas: <b>".$row['address']."</b><br><br>Miestas: <b>" .$row['city']."</b></td>
                                <td class=\"postContainer\" style=\"font-weight: bold; font-size: 20px;\">".$row['price']." €</td>
                                <td class=\"postContainer\" style=\"text-align:center;\">
                                
                                    <a class=\"postContainerActions\" style=\"padding: 2px 10px 2px 8px;\" href='moreinfopost.php?id=".$row['object_id']."'>
                                        <i class=\"material-icons\" style=\"font-size: 27px; padding-right: 3px;\">
                                        info
                                        </i>
                                        Informacija
                                    </a>
                                    
                                    ".((($userlevel == $user_roles["Pardavėjas"]) && $row['seller_id'] == $userID) || ($userlevel == $user_roles[ADMIN_LEVEL] ) ? "
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
                }
                else{
                    echo "<br>";
                    echo "  <p style=\"padding-top: 50px; font-size:22pt; color: darkred; font-family: 'Titillium Web', sans-serif;\">
                                <b>Skelbimų nerasta!</b>
                            </p>";
                }
			    $conn->close();

                ?>

            </table>
        </div>
    </div>
    </body>
