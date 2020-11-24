<?php
    session_start();

    include("include/nustatymai.php");
    include("include/functions.php");
    $id = $_GET['id'];
    $_SESSION['message']="";
    
    $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

    if(!$conn){
        die("Nepavyko prisijungti! ". mysqli_connect_error());
    }

    $query = "SELECT * FROM object WHERE object_id = '$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $description = $row['description'];

    if($_POST !=null){
        $target="images/".basename($_FILES['image']['name']);

        $address=htmlspecialchars($_POST['address']);
        $city=htmlspecialchars($_POST['city']);
        $price=$_POST['price'];
        $description=htmlspecialchars($_POST['description']);
        $file_type=$_FILES['image']['type'];
        $image=$_FILES['image']['name'];

        $filename   = $id . "-" . time("Y-m-d H:i:s");
        $extension  = pathinfo( $_FILES["image"]["name"], PATHINFO_EXTENSION );
        $basename   = $filename . "." . $extension;
    
        $source       = $_FILES["image"]["tmp_name"];
        $destination  = "images/{$basename}";

        if(checkaddress($address) && checkcity($city) && checkprice($price) && checkdescription($description)){

            $allowed = array("image/jpeg", "image/png", "image/jpg", "image/gif");

            if(!in_array($file_type, $allowed)){
                $_SESSION['message']="Blogo formato nuotrauka! Galimi tik \".png\", \".jpg,\" \".jpeg,\" ir \".gif\" formatai";
                $conn->close();
                header("Location:operacija1.php");
                exit;
            }
    
            if(move_uploaded_file($source, $destination)) {
                $sql = "UPDATE object SET image='$basename', address='$address', city='$city', price='$price', description='$description'
                WHERE object_id='$id'";
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
        else{
            $_SESSION['message']="Redagavimo laukų sintaksės klaida. Ar tikrai įvedėte formos reikšmes teisingai?";
            $conn->close();
            header("Location:operacija1.php");
            exit;
        }
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

                <div style="float:left;"> 
					<a href="operacija1.php" class="goBack">
						<i class="material-icons" style="font-size: 27px;">
							keyboard_arrow_left</i>
							Atgal
					</a>
                </div>
                <br>

				<p style="font-size:22pt; font-family: 'Titillium Web', sans-serif;"><b>Skelbimo redagavimas</b></p>

				<div style="padding-top: 30px;"></div>

				<form method="POST" enctype="multipart/form-data" id="description">
					<p style="text-align:left; font-family: 'Titillium Web', sans-serif;">Adresas:<br>
					<input class ="newAd" name="address" type="text" maxlength="50" value=<?php echo "\"{$row['address']}\"";?>><br>
                    
					<p style="text-align:left; font-family: 'Titillium Web', sans-serif;">Miesto pavadinimas:<br>
					<input class ="newAd" name="city" type="text" maxlength="50" value=<?php echo "\"{$row['city']}\"";?>><br>

					<p style="text-align:left; font-family: 'Titillium Web', sans-serif;">Kaina eurais:<br>
					<input class ="newAd" name="price" type="text" maxlength="15" value=<?php echo "\"{$row['price']}\"";?>><br>

					<p style="text-align:left; font-family: 'Titillium Web', sans-serif;">Aprašymas:<br>
                    <textarea autofocus="true" rows="4" cols="50" class="newAd" maxlength="200" id="description" name="description" form="description"><?php echo $description;?></textarea><br>

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
