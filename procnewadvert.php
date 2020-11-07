<?php
    session_start();

    if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "operacija3"))
    { header("Location: logout.php");exit;}

    include("include/nustatymai.php");

    //reiktu susikurti nauja funkciju faila kur vyktu naujo skelbimo patikra
    include("include/functions.php");

    $_SESSION['address_error']="";
    $_SESSION['city_error']="";
    $_SESSION['price_error']="";
    $_SESSION['description_error']="";  

    $server="localhost";
	$user="stud";
	$password="stud";
	$dbname="portalas";
    $lentele='object';

    $target="images/".basename($_FILES['image']['name']);

    $address=htmlspecialchars($_POST['address']);
    $city=htmlspecialchars($_POST['city']);
    $price=$_POST['price'];
    $description=htmlspecialchars($_POST['description']);
    $image=$_FILES['image']['name'];
    $_SESSION['prev']="procnewadvert";

    $object_id = md5(uniqid($description));
    $seller_id = $_SESSION['userid'];

    $conn = new mysqli($server, $user, $password, $dbname);
	if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);

    $sql= "INSERT INTO $lentele (object_id, seller_id, is_pending, is_sold, image, address, city, price, description, upload_time)
            VALUES ('$object_id', '$seller_id', 0, 0, '$image', '$address', '$city', '$price', '$description', NOW())";

    if(move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        echo "Okay";
    }
    else{
        die("Negaliu įrašyti nuotraukos " . $conn->error);
    }

    if (!$result = $conn->query($sql)) die("Negaliu įrašyti: " . $conn->error);
            
    $conn->close();
    header("Location:operacija1.php");
    exit;
?>