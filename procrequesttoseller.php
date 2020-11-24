<?php

//Parasyti checka, kuris leistu tik viena prasyma vienam useriui siusti

session_start(); 
// cia sesijos kontrole
if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "requesttoseller"))
{ header("Location: logout.php");exit;}

include("include/nustatymai.php");
include("include/functions.php");

$_SESSION['request_error']="";

$server="localhost";
$user="stud";
$password="stud";
$dbname="portalas";
$lentele='user_level_message';

$user_id = $_SESSION['userid'];
$message = htmlspecialchars($_POST['request']);$_SESSION['request_post']=$message;
$_SESSION['prev']="procrequesttoseller";

$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);

if(checkrequest($message)){
    $sql= "INSERT INTO $lentele (user_id, message)
    VALUES ('$user_id', '$message')";

    if (!$result = $conn->query($sql)) die("Negaliu įrašyti: " . $conn->error);
        
    $conn->close();
    header("Location:requesttoseller.php");
    exit;
}
else {
    header("Location:requesttoseller.php");
    exit;
}
