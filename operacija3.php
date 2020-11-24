<?php
	// operacija3.php  Naujų skelbimų sukūrimo forma

	session_start();

	if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "index") && ($_SESSION['prev'] != "operacija3")&& ($_SESSION['prev'] != "procnewadvert"))
	{ header("Location: logout.php");exit;}

	include("include/nustatymai.php");
	include("include/functions.php");

	if ($_SESSION['prev'] != "procnewadvert")  inisession("part");
	
	$_SESSION['prev']="operacija3";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Naujas skelbimas</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
		<link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@300&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<style>body{background-image: url("include/background.png");}</style>
    </head>
    <body style="width: 70%; margin-left: auto; margin-right: auto;">
		<div align="center">
			<div class="newPostContainer">

				<div style="float:left;"> 
					<a href="index.php" class="goBack">
						<i class="material-icons" style="font-size: 27px;">
							keyboard_arrow_left</i>
							Atgal
					</a>
				</div>

				<div style="padding-top: 30px;"></div>

				<p style="font-size:22pt; font-family: 'Titillium Web', sans-serif;"><b>Naujas skelbimas</b></p>

				<div style="padding-top: 30px;"></div>

				<form action="procnewadvert.php" method="POST" enctype="multipart/form-data" id="description">
					<p style="text-align:left; font-family: 'Titillium Web', sans-serif;">Adresas:<br>
					<input class ="newAd" name="address" type="text" placeholder="Nekilnojamojo turto vietos adresas" maxlength="50" value="<?php echo $_SESSION['address_post'];  ?>"><br>
					<?php echo $_SESSION['address_error']; ?>
					<p style="text-align:left; font-family: 'Titillium Web', sans-serif;">Miesto pavadinimas:<br>
					<input class ="newAd" name="city" type="text" placeholder="Miestas, kuriame yra nekilnojamasis turtas" maxlength="50" value="<?php echo $_SESSION['city_post'];  ?>"><br>
					<?php echo $_SESSION['city_error']; ?>
					<p style="text-align:left; font-family: 'Titillium Web', sans-serif;">Kaina eurais:<br>
					<input class ="newAd" name="price" type="text" placeholder="" maxlength="15" value="<?php echo $_SESSION['price_post'];  ?>"><br>
					<?php echo $_SESSION['price_error']; ?>
					<p style="text-align:left; font-family: 'Titillium Web', sans-serif;">Aprašymas:<br>
					<textarea autofocus="true" rows="4" cols="50" class="newAd" maxlength="200" id="description" name="description" form="description" placeholder="Įveskite tekstą..."><?php echo $_SESSION['description_post'];  ?></textarea><br>
					<?php echo $_SESSION['description_error']; ?>
					<p style="text-align:left; font-family: 'Titillium Web', sans-serif;">Nuotrauka:<br>
					<input name="image" type="file" style="padding: 20px 0;"><br>
					<?php echo $_SESSION['image_error']; ?>

					<p style="text-align:center; padding: 15px 0;">
						<input class="newPostButton" type="submit" value="Vykdyti">
					</p>
				</form>
			</div>
		</div>
	<body>
</html>
