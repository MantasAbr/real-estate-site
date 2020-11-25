<?php 
// forgotpass.php  jei nesiseka prisijungti
// is proclogin gauna:
// $_SESSION['name_login']  vartotojas
// $_SESSION['userid']  userid, bus slaptažodziui pirmi 4 simboliai
//                          !! jei e-paštu negaunate, atsirinkite 4 simbolius iš DB "userid" stulpelio
// $_SESSION['umail']   epaštas, kur pasiųsti 

session_start(); 
// cia sesijos kontrole
if (empty($_SESSION['name_login'])) { header("Location: logout.php");exit;}
  $_SESSION['prev'] = "forgotpass";
 ?>

<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Negali prisijungti</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
        <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@300&display=swap" rel="stylesheet">
		    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		    <style>body{background-image: url("include/background.png");}</style>
    </head>
  <body style="width: 30%; margin-left: auto; margin-right: auto;">
    <div class="postContainer">
      <div align="center">

        <div style="float:left;"> 
          <a href="index.php" class="goBack">
              <i class="material-icons" style="font-size: 27px;">
                  keyboard_arrow_left</i>
                  Atgal
          </a>
        </div>

        <div style="padding-top: 50px;"></div> 

    
         
        <center style="font-size:18pt;">
          <p style="font-family: 'Titillium Web', Courier, monospace; font-size: 24px;"><b>Vartotojas <?php echo $_SESSION['name_login']; ?> negali prisijungti</b></p>
        </center>

        <p style="font-family: 'Titillium Web', Courier, monospace; font-size: 18px;">Jei paspausite "Tęsti" bus pakeistas slaptažodis.<br>
        Laikinas slaptažodis bus pasiųstas adresu <b><?php echo $_SESSION['umail']; ?></b><br><br>
        </p>
                                                                              

        <form action="newpass.php" method="POST">  
          <input class="button" type="submit" name="login" value="Tęsti">    
        </form>

        </div>
      </div>
   </body>
</html>




