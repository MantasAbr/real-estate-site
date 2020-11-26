<?php 
// useredit.php 
// vartotojas gali pasikeisti slaptažodį ar email
// formos reikšmes tikrins procuseredit.php. Esant klaidų pakartotinai rodant formą rodomos ir klaidos

session_start();
// sesijos kontrole
if (!isset($_SESSION['prev']) || (($_SESSION['prev'] != "index") && ($_SESSION['prev'] != "procuseredit")  && ($_SESSION['prev'] != "useredit")))
{header("Location: logout.php");exit;
}
if ($_SESSION['prev'] == "index")								  
    {$_SESSION['mail_login'] = $_SESSION['umail'];
    $_SESSION['telephone_login'] = $_SESSION['utelephone'];
	$_SESSION['passn_error'] = "";      // papildomi kintamieji naujam password įsiminti
	$_SESSION['passn_login'] = ""; }  //visos kitos turetų būti tuščios
$_SESSION['prev'] = "useredit"; 
?>

 <html>
        <head>  
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"> 
            <title>Registracija</title>
            <link href="include/styles.css" rel="stylesheet" type="text/css" >
            <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@300&display=swap" rel="stylesheet">
			<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
			<style>body{background-image: url("include/background.png");}</style>
        </head>
        <body>   
            <table class="center"><tr><td></td></tr><tr><td> 
            <div style="padding-left:3px;">
					<a href="index.php" class="goBack">
						<i class="material-icons" style="font-size: 27px;">
						keyboard_arrow_left</i>
						Atgal
					</a>
				</div>             
                <div align="center">   <font size="4" color="#ff0000"><?php echo $_SESSION['message']; ?><br></font>  
					
      <table>
        <tr><td>
		<form action="procuseredit.php" method="POST" class="login">             
        <center style="font-size:24pt; font-family: 'Titillium Web', sans-serif;"><b>Paskyros redagavimas</b></center><br>
		<center style="font-size:18pt; font-family: 'Titillium Web', sans-serif;"><b>Vartotojas: <?php echo $_SESSION['user'];  ?></b></center>
        
        <p style="text-align:left;  font-family: 'Titillium Web', sans-serif;">Dabartinis slaptažodis:<br>
            <input class ="s1" name="pass" type="password" value="<?php echo $_SESSION['pass_login']; ?>"><br>
            <?php echo $_SESSION['pass_error']; ?>
        </p>
			
		<p style="text-align:left; font-family: 'Titillium Web', sans-serif;">Naujas slaptažodis:<br>
            <input class ="s1" name="passn" type="password" value="<?php echo $_SESSION['passn_login']; ?>"><br>
            <?php echo $_SESSION['passn_error']; ?>
        </p>	
			
		<p style="text-align:left; font-family: 'Titillium Web', sans-serif;">E-paštas:<br>
			<input class ="s1" name="email" type="text" value="<?php echo $_SESSION['mail_login']; ?>"><br>
			<?php echo $_SESSION['mail_error']; ?>
        </p> 

        <p style="text-align:left; font-family: 'Titillium Web', sans-serif;">Tel. nr.:<br>
			<input class ="s1" name="telephone" type="text" placeholder="+3706" maxlength="12" value="<?php echo $_SESSION['telephone_login']; ?>"><br>
			<?php echo $_SESSION['telephone_error']; ?>
        </p> 
			
        <p style="text-align:center;">
            <input type="submit" name="login" class="button" value="Atnaujinti"/>     
        </p>  
        </form>
        </td></tr>
	 </table>
  </div>
  </td></tr>
  </table>           
 </body>
</html>
	


