<?php
// operacija2.php
// tiesiog rodomas  tekstas ir nuoroda atgal

session_start();

if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "index"))
{ header("Location: logout.php");exit;}

?>

<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Operacija 2</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
        <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@300&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<style>body{background-image: url("include/background.png");}</style>
    </head>
    <body>
        <table class="center" ><tr><td></td></tr><tr><td>

        <div style="padding-left:3px;">
					<a href="index.php" class="goBack">
						<i class="material-icons" style="font-size: 27px;">
						keyboard_arrow_left</i>
						Atgal
					</a>
				</div>
			
		<div style="text-align: center;color:green"> <br><br>
            <h1>Operacija 2.</h1>
			Tuščias puslapis, tik nuoroda į pradžią. 
        </div><br>
