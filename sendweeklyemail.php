<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once "vendor/autoload.php";
include("smtp_config/smtp_config.php");

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

        if($posts->num_rows > 0){
            while($posts_row = $posts->fetch_assoc()){
            $mail->Body .= "Objektas: " . $posts_row['address'] . ", " .$posts_row['city']."\n"
                         . " • Atliktos rezervacijos: " . $posts_row['times_reserved'] . "\n"
                         . " • Viso peržiūrų: " . $posts_row['views'] . "\n\n";
            }
        }
        
        else{
            $mail->Body = "Šiuo metu aktyvių skelbimų dar neturite\n\n";
        }


        $mail->Body .= "Automatizuotas laiškas Kompiuterių tinklų ir Internetinių technologijų modulio projektui\n";
    
        echo "Siunčiamas laiškas pardavėjui: " . $seller_row['username'];
    
        try {
            $mail->send();
            echo "Laiskai issiusti sekmingai";
        } catch (Exception $e) {
            echo "Mailer Error: " . $mail->ErrorInfo;
            echo error_get_last();
        }
    }

    $conn->close();

?>