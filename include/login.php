<?php 
// login.php - tai prisijungimo forma, index.php puslapio dalis 
// formos reikšmes tikrins proclogin.php. Esant klaidų pakartotinai rodant formą rodomos klaidos
// formos laukų reikšmės ir klaidų pranešimai grįžta per sesijos kintamuosius
// taip pat iš čia išeina priminti slaptažodžio.
// perėjimas į registraciją rodomas jei nustatyta $uregister kad galima pačiam registruotis

if (!isset($_SESSION)) { header("Location: logout.php");exit;}
$_SESSION['prev'] = "login";
include("include/nustatymai.php");
?>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"> 
        <title>Prisijungimas</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@300&display=swap" rel="stylesheet">
        <style>body{background-image: url("include/background.png");}</style>
    </head>

    <body>

    <div>
		<form action="proclogin.php" method="POST" class="login">             
        <center style="font-size:26pt; font-family: 'Titillium Web', sans-serif;"><b>Prisijungimas</b></center>
        <p style="text-align:left; font-family: 'Titillium Web', sans-serif;">Vartotojo vardas:<br>
            <input class ="s1" name="user" type="text" value="<?php echo $_SESSION['name_login'];  ?>"/><br>
            <?php echo $_SESSION['name_error']; 
			?>
        </p>
        <p style="text-align:left; font-family: 'Titillium Web', sans-serif;">Slaptažodis:<br>
            <input class ="s1" name="pass" type="password" value="<?php echo $_SESSION['pass_login']; ?>"/><br>
            <?php echo $_SESSION['pass_error']; 
			?>
        </p>  
        <p>
            <input class="login" type="submit" name="login" value="Prisijungti"/>
            <?php
			    if ($uregister != "admin") { echo str_repeat("&nbsp;", 33),"<a href=\"register.php\" class=\"register\">Registracija</a>";}?>
        </p> 
        <br>
        <br>
            <div align="center">
                <input class="button" type="submit" name="problem" value="Pamiršote slaptažodį?"/>   
            </div>
            <div style="padding: 10px 0px"></div>
            <div align="center">
                <?php echo "<a href=\"guest.php\" class=\"button\">Svečias?</a>";?>   
            </div>        
        </form>
    </div>

	</body>

</html>
