<?php
	// operacija3.php  Naujų skelbimų sukūrimo forma

	session_start();

	if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "index"))
	{ header("Location: logout.php");exit;}
	
	//include("include/nustatymai.php");
    //reiktu susikurti nauja funkciju faila kur vyktu naujo skelbimo patikra
	//include("include/functions.php");
	
	// $server="localhost";
	// $user="stud";
	// $password="stud";
	// $dbname="portalas";
	// $lentele='object';

	// $conn = new mysqli($server, $user, $password, $dbname);
	// if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);

	// if($_POST != NULL){
	// 	$address=htmlspecialchars($_POST['address']);
	// 	$city=htmlspecialchars($_POST['city']);
	// 	$price=$_POST['price'];
	// 	$description=htmlspecialchars($_POST['description']);

	// 	$object_id = md5(uniqid($description));
	// 	$seller_id = 1;


	// 	$sql= "INSERT INTO $lentele (object_id, seller_id, address, 
	// 										city, price, description, upload_time)
	// 			VALUES ('$object_id', '$seller_id', '$address', '$city', '$price', '$description', NOW())";
	
	// 	if (!$result = $conn->query($sql)) die("Negaliu įrašyti: " . $conn->error);

	// 	$conn->close();

	// 	header("Location:operacija1.php");
	// 	exit();
	// }
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

				<form action="procnewadvert.php" method="POST">
					<p style="text-align:left; font-family: 'Titillium Web', sans-serif;">Adresas:<br>
					<input class ="newAd" name="address" type="text" placeholder="Nekilnojamojo turto vietos adresas" maxlength="50"><br>
					<!--Error control here-->
					<p style="text-align:left; font-family: 'Titillium Web', sans-serif;">Miesto pavadinimas:<br>
					<input class ="newAd" name="city" type="text" placeholder="Miestas, kuriame yra nekilnojamasis turtas" maxlength="50"><br>

					<p style="text-align:left; font-family: 'Titillium Web', sans-serif;">Kaina eurais:<br>
					<input class ="newAd" name="price" type="text" placeholder="" maxlength="15"><br>

					<p style="text-align:left; font-family: 'Titillium Web', sans-serif;">Aprašymas:<br>
					<input class ="newAd" name="description" type="text" placeholder="Max 200 simbolių" maxlength="200" style="padding: 20px 0;"><br>

					<p style="text-align:center; padding: 15px 0;">
						<input class="newPostButton" type="submit" value="Vykdyti">
					</p>
				</form>
			</div>
		</div>
	<body>
</html>
