<?php
    session_start();

    include("include/nustatymai.php");
    $id = $_GET['id'];
    $_SESSION['message']="";
    
    $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

    if(!$conn){
        die("Nepavyko prisijungti! ". mysqli_connect_error());
    }

    $query = "SELECT * FROM object WHERE object_id = '$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if($_POST !=null){
        $target="images/".basename($_FILES['image']['name']);

        $address=htmlspecialchars($_POST['address']);
        $city=htmlspecialchars($_POST['city']);
        $price=$_POST['price'];
        $description=htmlspecialchars($_POST['description']);
        $image=$_FILES['image']['name'];

        $sql = "UPDATE object SET image='$image', address='$address', city='$city', price='$price', description='$description'
        WHERE object_id='$id'";

        if(move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            echo "Okay";
        }
        else{
            $_SESSION['message']="Neįkelta nuotrauka";
            header("Location:operacija1.php");
            exit;

        }
        if (!$result = $conn->query($sql)){
            $_SESSION['message']="Įrašymo klaida";
            header("Location:operacija1.php");
            exit;
        } 

        $_SESSION['message']="Objektas sėkmingai redaguotas";    
        $conn->close();
        header("Location:operacija1.php");
        exit;
    }
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

				<p style="font-size:22pt; font-family: 'Titillium Web', sans-serif;"><b>Skelbimo redagavimas</b></p>

				<div style="padding-top: 30px;"></div>

				<form method="POST" enctype="multipart/form-data">
					<p style="text-align:left; font-family: 'Titillium Web', sans-serif;">Adresas:<br>
					<input class ="newAd" name="address" type="text" maxlength="50" value=<?php echo "\"{$row['address']}\"";?>><br>
					<!--Error control here-->
					<p style="text-align:left; font-family: 'Titillium Web', sans-serif;">Miesto pavadinimas:<br>
					<input class ="newAd" name="city" type="text" maxlength="50" value=<?php echo "\"{$row['city']}\"";?>><br>

					<p style="text-align:left; font-family: 'Titillium Web', sans-serif;">Kaina eurais:<br>
					<input class ="newAd" name="price" type="text" maxlength="15" value=<?php echo "\"{$row['price']}\"";?>><br>

					<p style="text-align:left; font-family: 'Titillium Web', sans-serif;">Aprašymas:<br>
					<input class ="newAd" name="description" type="text" maxlength="200" style="padding: 20px 0;" value=<?php echo "\"{$row['description']}\"";?>><br>

					<p style="text-align:left; font-family: 'Titillium Web', sans-serif;">Nuotrauka:<br>
					<input name="image" type="file" style="padding: 20px 0;"><br>


					<p style="text-align:center; padding: 15px 0;">
						<input class="newPostButton" type="submit" value="Vykdyti">
					</p>
				</form>
			</div>
		</div>
	<body>
</html>
