<?php

$server="localhost";
$user="stud";
$password="stud";
$dbname="portalas";
$objektu_lentele='object';
$pirkeju_lentele="vartotojas";

$email_nuo_vardas = "Nekilnojamasis turtas";
$email_nuo_adresas = "mantasabra@gmail.com";

$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);

$fetch_sellers="SELECT * FROM vartotojas WHERE userlevel=5";

if (!$sellers = $conn->query($fetch_sellers))
    die("Negaliu nuskaityti: " . $conn->error);

while($seller_row = $sellers->fetch_assoc()) {
    $seller_id = $seller_row['userid'];
    $to = $seller_row['email'];
    $subject = "Šios savaitės skelbimų statistika";
    $message = "";
    $fetch_posts = "SELECT * FROM object WHERE seller_id='$seller_id' AND is_sold=0";
    

    if (!$posts = $conn->query($fetch_posts))
        die("Negaliu nuskaityti: " . $conn->error);

    while($posts_row = $posts->fetch_assoc()){
        $message .= "Objektas: " . $posts_row['address'] . "\n"
                   . "  Rezervacijos: " . $posts_row['times_reserved'] . "\n"
                   . "  Peržiūros: " . $posts_row['views'] . "\n\n";
    }
    
    $headers = "From: " . $email_nuo_vardas . " <" . $email_nuo_adresas . ">\r\n";
    $headers .= "Content-type: text; charset=UTF-8\r\n";

    echo "Siunčiamas laiškas pardavėjui: " . $seller_row['username'];

    mail($to, $subject, $message, $headers);
}

?>