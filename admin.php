<?php
// admin.php
// vartotojų įgaliojimų keitimas ir naujo vartotojo registracija, jei leidžia nustatymai
// galima keisti vartotojų roles, tame tarpe uzblokuoti ir/arba juos pašalinti
// sužymėjus pakeitimus į procadmin.php, bus dar perklausta

session_start();
include("include/nustatymai.php");
include("include/functions.php");
// cia sesijos kontrole
if (!isset($_SESSION['prev']) || ($_SESSION['ulevel'] != $user_roles[ADMIN_LEVEL]))   { header("Location: logout.php");exit;}
$_SESSION['prev']="admin";
date_default_timezone_set("Europe/Vilnius");
?>

<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Administratoriaus sąsaja</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
		<link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@300&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<style>body{background-image: url("include/background.png");}</style>
    </head>

    <body style="width: 70%; margin-left: auto; margin-right: auto;">
        
		<p class="adminTitle">Vartotojų registracija, peržiūra ir įgaliojimų keitimas</p>

		<div align="center">
			<hr/>
		
			<br>

			<form name="vartotojai" action="procadmin.php" method="post">

				<div class="adminMenu">

					<div style="float:left;"> 
						<a href="index.php" class="goBack">
							<i class="material-icons" style="font-size: 27px;">
								keyboard_arrow_left</i>
								Atgal
						</a>
					</div>
					
					<div style="display: inline-block;">
						<a class="adminMenuButton" href="adminviewrequests.php">
							<i class="material-icons" style="font-size: 27px; padding: 0 7px;">
								assignment_ind</i>
							Privilegijų aukštinimo prašymai
						</a>
					</div>

					<?php
						if ($uregister != "self") 
							echo "
							<a style=\"float:right;\"class=\"adminMenuButton\" href=\"register.php\">
								<i class=\"material-icons\" style=\"font-size: 27px; padding: 0 7px;\">
								person_add_alt_1</i>
								Registruoti naują vartotoją
							</a>";
						else echo "";
					?>
				</div>

			<?php echo "<p style=\"color: red; font-family: 'Titillium Web', Courier, monospace; font-size: 18px;\">
                ".$_SESSION['message'] . "<br></p>"; $_SESSION['message']="";?>

			<br>
		 

			<?php  
				$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
				$sql = "SELECT username, userlevel, email, timestamp "
					. "FROM " . TBL_USERS . " ORDER BY userlevel DESC, username";
					
				$result = mysqli_query($db, $sql);
				if (!$result || (mysqli_num_rows($result) < 1))
				{
					echo "Klaida skaitant lentelę users"; exit;
				}
			?>

			<div class="postContainer">

				<table class="postContainer" style="font-size: 22px; font-weight: bold; text-align: center;">
					<tr class="postContainer">
						<td class="postContainer" style="width: 12%; font-size: 18px;">Vartotojo vardas</td>
						<td class="postContainer" style="width: 10%; font-size: 18px;">Rolė</td>
						<td class="postContainer" style="width: 20%; font-size: 18px;">E-paštas</td>
						<td class="postContainer" style="width: 20%; font-size: 18px;">Paskutinį kartą aktyvus</td>
						<td class="postContainer" style="width: 3%; font-size: 18px;">Šalinti?</td>
					</tr>

					<?php
						while($row = mysqli_fetch_assoc($result)) 
						{	 
							$level=$row['userlevel']; 
							$user= $row['username'];
							$email = $row['email'];
							$time = date("Y-m-d G:i", strtotime($row['timestamp']));
							echo "<tr class=\"postContainer\">
								  <td class=\"postContainer\" style=\"font-size: 16px;\">".$user. "</td>
								  <td class=\"postContainer\">";
							echo "<select name=\"role_".$user."\">";
							$yra=false;
							foreach($user_roles as $x=>$x_value)
								{echo "<option ";
								if ($x_value == $level) {$yra=true;echo "selected ";}
								echo "value=\"".$x_value."\" ";
								echo ">".$x."</option>";
								}
							if (!$yra)
							{echo "<option selected value=".$level.">Neegzistuoja=".$level."</option>";}
							$UZBLOKUOTAS=UZBLOKUOTAS; echo "<option ";
							if ($level == UZBLOKUOTAS) echo "selected ";
							echo "value=".$UZBLOKUOTAS." ";
							echo ">Užblokuotas</option>";      // papildoma opcija
							echo "</select></td>";
							
							echo "<td class=\"postContainer\" style=\"font-weight: lighter; font-size: 16px;\">".$email."</td>
								  <td class=\"postContainer\" style=\"font-weight: lighter; font-size: 16px;\">".$time."</td>";
							echo "<td class=\"postContainer\"><input type=\"checkbox\" name=\"naikinti_".$user."\"></tr>";
						}
					?>
				</table>
				
				<br>
				<input class="button" type="submit" value="Vykdyti">
			</div>
		</form>
		</div>
    </body>
</html>
