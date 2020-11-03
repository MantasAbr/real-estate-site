<?php
// register.php registracijos forma
// jei pats registruojasi rolė = DEFAULT_LEVEL, jei registruoja ADMIN_LEVEL vartotojas, rolę parenka
// Kaip atsiranda vartotojas: nustatymuose $uregister=
//                                         self - pats registruojasi, admin - tik ADMIN_LEVEL, both - abu atvejai galimi
// formos laukus tikrins procregister.php

session_start();
if (empty($_SESSION['prev'])) { header("Location: logout.php");exit;} // registracija galima kai nera userio arba adminas
// kitaip kai sesija expirinasi blogai, laikykim, kad prev vistik visada nustatoma
include("include/nustatymai.php");
include("include/functions.php");
if ($_SESSION['prev'] != "procregister")  inisession("part");  // pradinis bandymas registruoti

$_SESSION['prev']="register";
?>
    <html>
        <head>  
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"> 
            <title>Registracija</title>
			<link href="include/styles.css" rel="stylesheet" type="text/css">
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

				<div style="padding: 10px 0px;"></div>   
						<div align="center">
						<table> <tr><td>
							<form action="procregister.php" method="POST" class="register">              
										<center style="font-size:26pt; font-family: 'Titillium Web', sans-serif;"><b>Registracija</b></center>
								
							<p style="text-align:left; font-family: 'Titillium Web', sans-serif;">Vartotojo vardas:<br>
							<input class ="s1" name="user" type="text" value="<?php echo $_SESSION['name_login'];  ?>"><br>
							<?php echo $_SESSION['name_error']; ?>
							</p>
							<p style="text-align:left; font-family: 'Titillium Web', sans-serif;">Slaptažodis:<br>
							<input class ="s1" name="pass" type="password" value="<?php echo $_SESSION['pass_login']; ?>"><br>
							<?php echo $_SESSION['pass_error']; ?>
							</p>  
							<p style="text-align:left; font-family: 'Titillium Web', sans-serif;">E-paštas:<br>
							<input class ="s1" name="email" type="text" value="<?php echo $_SESSION['mail_login']; ?>"><br>
							<?php echo $_SESSION['mail_error']; ?>
							</p>
							<p style="text-align:left; font-family: 'Titillium Web', sans-serif;">Telefono nr.:<br>
							<input class ="s1" name="telephone" type="text" value="+3706"><br>
							<?php echo $_SESSION['telephone_error']; ?>
							</p>    
							<?php
									if ($_SESSION['ulevel'] == $user_roles[ADMIN_LEVEL] )
								{echo "<p style=\"text-align:left;\">Rolė<br>";
									echo "<select name=\"role\">";
									foreach($user_roles as $x=>$x_value)
									{echo "<option ";
										if ($x == DEFAULT_LEVEL) echo "selected ";
										echo "value=\"".$x_value."\" ";
										echo ">".$x."</option></p>";
									}
								}
							?>
							<br>
							<p style="text-align:center;">
							<input class="button" type="submit" value="Registruoti">
							</p>
							</form>
							</td></tr>
						</table>
						</div>
                </td></tr>
                </table>           
        </body>
    </html>
   
