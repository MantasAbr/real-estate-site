<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once "vendor/autoload.php";

$server="localhost";
$user="stud";
$password="stud";
$dbname="portalas";
$objektu_lentele='object';
$pirkeju_lentele="vartotojas";

//PHPMailer Object
$mail = new PHPMailer(true); //Argument true in constructor enables exceptions
$mail->Encoding = 'base64';
$mail->CharSet = 'UTF-8';

$mail->SMTPDebug = 3;

$mail->isSMTP();

$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->Username = "mantasabra@gmail.com";                 
$mail->Password = "Gargzdai159";
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
$mail->FromName = "Mantas";

$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);

$fetch_sellers="SELECT * FROM vartotojas WHERE userlevel=5";

if (!$sellers = $conn->query($fetch_sellers))
    die("Negaliu nuskaityti: " . $conn->error);

    while($seller_row = $sellers->fetch_assoc()) {
        $seller_id = $seller_row['userid'];
        $mail->addAddress($seller_row['email']);
        $mail->Subject = "Šios savaitės skelbimų statistika";
        $mail->Body = "";
        $fetch_posts = "SELECT * FROM object WHERE seller_id='$seller_id' AND is_sold=0";
            
        if (!$posts = $conn->query($fetch_posts))
            die("Negaliu nuskaityti: " . $conn->error);
    
        while($posts_row = $posts->fetch_assoc()){
            $mail->Body .= "Objektas: " . $posts_row['address'] . "\n"
                       . "  Rezervacijos: " . $posts_row['times_reserved'] . "\n"
                       . "  Peržiūros: " . $posts_row['views'] . "\n\n";
        }
    
        echo "Siunčiamas laiškas pardavėjui: " . $seller_row['username'];
    
        try {
            $mail->send();
            echo "Laiskai issiusti sekmingai";
        } catch (Exception $e) {
            echo "Mailer Error: " . $mail->ErrorInfo;
            echo error_get_last();
        }
    }
?>