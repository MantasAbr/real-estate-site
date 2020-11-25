<?php 

session_start(); 

if (empty($_SESSION['name_login'])) { header("Location: logout.php");exit;}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once "vendor/autoload.php";

$_SESSION['prev'] = "newpass";
include("include/nustatymai.php");
include("smtp_config/smtp_config.php");

$naujaspass=substr($_SESSION['userid'],0,4);$passdb=substr(hash('sha256', $naujaspass),5,32);
$user=$_SESSION['name_login'];

// pakeiciam slaptazodi DB
		 $db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
         $sql = "UPDATE ". TBL_USERS." SET password='$passdb' WHERE username='$user'";
		
		 if (!mysqli_query($db, $sql)) {
             echo " DB klaida keiciant slaptazodi: " . $sql . "<br>" . mysqli_error($db);
         exit;}
         
         //PHPMailer Object
  $mail = new PHPMailer(true); //Argument true in constructor enables exceptions
  $mail->Encoding = 'base64';
  $mail->CharSet = 'UTF-8';

  $mail->SMTPDebug = 3;

  $mail->isSMTP();

  $mail->Host = "smtp.gmail.com";
  $mail->SMTPAuth = true;

  /*
  One should use their own predefined gmail account credentials:
  1. Create a folder called smtp_config in the project directory
  2. Make a new smtp_config.php file and write this in it:
    <?php
      define("USERNAME", "yourmail@example.com");
      define("PASSWORD", "yourmailpassword");
    ?>
  */  
  $mail->Username = USERNAME;               
  $mail->Password = PASSWORD;
  $mail->SMTPSecure = "tls";
  $mail->Port = 587;

  $mail->SMTPOptions = array(
      'ssl' => array(
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
      )
  );

  //From email address and name
  $mail->From = "mantasabra@gmail.com";
  $mail->FromName = "Nekilnojamojo turto portalas";

    //To address and name
  $mail->addAddress($_SESSION['umail']);

  $mail->Subject = "Laikinas slaptažodis";
  $mail->Body = "Jūsų naujas laikinas slaptažodis yra: ". $naujaspass;

  try {
      $mail->send();
      header("Location:newpassheader.php");
      exit;
  } catch (Exception $e) {
      echo "Mailer Error: " . $mail->ErrorInfo;
    echo error_get_last();
  }
?>