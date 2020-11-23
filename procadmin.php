<?php
// procadmin.php  kai adminas keičia vartotojų įgaliojimus ir padaro atžymas lentelėje per admin.php
// ji suformuoja numatytų pakeitimų aiškią lentelę ir prašo patvirtinimo, toliau į procadmindb, kuri įrašys į DB

session_start();
// cia sesijos kontrole
if (!isset($_SESSION['prev']) || (($_SESSION['prev'] != "admin") && ($_SESSION['prev'] != "procadmin")))
{ header("Location: logout.php");exit;}

include("include/nustatymai.php");
include("include/functions.php");
$_SESSION['prev'] = "procadmin";

$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	$sql = "SELECT username,userlevel,email,timestamp "
            . "FROM " . TBL_USERS . " ORDER BY userlevel DESC,username";
	$result = mysqli_query($db, $sql);
	if (!$result || (mysqli_num_rows($result) < 1))  
			{echo "Klaida skaitant lentelę users"; exit;}
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

		<p class="adminTitle">Vartotojų įgaliojimų keitimas</p>

		<div align="center">
			<hr style="width: 25%;"/>

			<div style="padding: 10px 0px;"></div>

			<div class="postContainer" style="width: 40%;">

				<form name="vartotojai" action="procadmindb.php" method="post">

					<div style="float:left;"> 
						<a href="admin.php" class="goBack">
							<i class="material-icons" style="font-size: 27px;">
								keyboard_arrow_left</i>
								Atgal
						</a>
					</div>

					<div style="float: right;">
						<button class="forward" type="submit">	
							Atlikti
							<i class="material-icons" style="font-size: 27px;">
								keyboard_arrow_right
							</i>	
						</button>
					</div>

					<div style="padding: 20px 0px;"></div>

					<div style="display: inline-block;">
						<p style="color: darkred; font-family: 'Titillium Web', Courier, monospace; font-size: 18px;">
							Pasitikrinkite, ar veiksmai teisingi!
						</p>
					</div>

					<br> 
				
					<table class="postContainer">
						<tr class="postContainer">
							<td class="postContainer"><b>Vartotojo vardas</b></td>
							<td class="postContainer"><b>Buvusi rolė</b></td>
							<td class="postContainer"><b>Nauja rolė</b></td>
						</tr>
		

						<?php
							$naikpoz=false;   // ar bus naikinamu vartotoju
							while($row = mysqli_fetch_assoc($result)) 
							{	 
								$level=$row['userlevel']; 
								$user= $row['username'];
								$nlevel=$_POST['role_'.$user];
								$naikinti=(isset($_POST['naikinti_'.$user]));
								if ($naikinti || ($nlevel != $level)) 
								{ 	$keisti[]=$user;                    // cia isiminti kuriuos keiciam, ka keiciam bus irasyta i $pakeitimai
									echo "<tr class=\"postContainer\">
											<td class=\"postContainer\" style=\"text-align: center;\">
												".$user. "
											</td>
											<td class=\"postContainer\">";    // rodyti sia eilute patvirtinimui
									if ($level == UZBLOKUOTAS) echo "Užblokuotas";
									else
										{foreach($user_roles as $x=>$x_value)
										{if ($x_value == $level) echo $x;}
										} 
									echo "</td><td class=\"postContainer\">";
									if ($naikinti)
										{      echo "<p style=\"color: darkred;\"><b>PAŠALINTI</b></p>";
											$pakeitimai[]=-1; // ir isiminti  kad salinam
											$naikpoz=true;
									} else 
										{      $pakeitimai[]=$nlevel;    // isiminti i kokia role
										if ($nlevel == UZBLOKUOTAS) echo "UŽBLOKUOTAS";
										else
											{foreach($user_roles as $x=>$x_value)
												{if ($x_value == $nlevel) echo $x;}
											}
										}
										
										echo "</td></tr>";
								}
							}
						if ($naikpoz)
						{
							echo "<br>
									<p style=\"color: red; font-family: 'Titillium Web', Courier, monospace; font-size: 18px;\">
										Dėmesio! Bus šalinami tik įrašai iš lentelės 'users'.
									</p>";
							echo "<p style=\"color: red; font-family: 'Titillium Web', Courier, monospace; font-size: 18px;\">
									Kitose lentelėse gali likti susietų įrašų!
								  </p>";
						}
						// pakeitimus irasysim i sesija 
						if (empty($keisti))
						{
							header("Location:index.php");
							exit;
						}//nieko nekeicia
								
						$_SESSION['ka_keisti']=$keisti; $_SESSION['pakeitimai']=$pakeitimai;
						?>

					</table>
				</form>
			</div>
		</div>
  	</body>
</html>
