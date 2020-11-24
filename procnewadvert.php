<?php
    session_start();

    if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "operacija3"))
    { header("Location: logout.php");exit;}

    include("include/nustatymai.php");
    include("include/functions.php");

    $_SESSION['address_error']="";
    $_SESSION['city_error']="";
    $_SESSION['price_error']="";
    $_SESSION['description_error']="";
    $_SESSION['image_error']="";
    $_SESSION['message']="";

    $server="localhost";
	$user="stud";
	$password="stud";
	$dbname="portalas";
    $lentele='object';

    $target="images/".basename($_FILES['image']['name']);

    $address=htmlspecialchars($_POST['address']); $_SESSION['address_post']=$address;
    $city=htmlspecialchars($_POST['city']); $_SESSION['city_post']=$city;
    $price=$_POST['price']; $_SESSION['price_post']=$price;
    $description=htmlspecialchars($_POST['description']); $_SESSION['description_post']=$description;
    $image=$_FILES['image']['name'];
    $file_type=$_FILES['image']['type'];
    $_SESSION['prev']="procnewadvert";

    $object_id = md5(uniqid($description));
    $seller_id = $_SESSION['userid'];

    $conn = new mysqli($server, $user, $password, $dbname);
    if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
    
    if(checkaddress($address)){
        if(!checkobjects($address)){
            if(checkcity($city)){
                if(checkprice($price)){
                    if(checkdescription($description)){
                        
                        $allowed = array("image/jpeg", "image/png", "image/jpg", "image/gif");

                        if(!in_array($file_type, $allowed)){
                            $_SESSION['image_error']="<font size=\"2\" color=\"#ff0000\">* Blogo formato nuotrauka! Galimi tik \".png\", \".jpg,\" \".jpeg,\" ir \".gif\" formatai</font>";
                            $conn->close();
                            header("Location:operacija3.php");
                            exit;
                        }

                        $sql= "INSERT INTO $lentele (object_id, seller_id, is_pending, is_sold, times_reserved, views, image, address, city, price, description, upload_time)
                        VALUES ('$object_id', '$seller_id', 0, 0, 0, 0, '$image', '$address', '$city', '$price', '$description', NOW())";

                        if(move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                            echo "Okay";
                        }
                        else{
                            //die("Negaliu įrašyti nuotraukos " . $conn->error);
                            $_SESSION['image_error'] = "<font size=\"2\" color=\"#ff0000\">* Nepasirinkta nuotrauka</font>";
                            header("Location:operacija3.php");exit;
                        }

                        if (!$result = $conn->query($sql)) die("Negaliu įrašyti: " . $conn->error);
                                
                        $conn->close();
                        header("Location:operacija1.php");
                        exit;
                    }
                    else{
                        header("Location:operacija3.php");exit;
                    }
                }
                else{
                    header("Location:operacija3.php");exit;
                }
            }
            else{
                header("Location:operacija3.php");exit;
            }
        }
        else{
            $_SESSION['message']="Objektas tokiu adresu jau egzistuoja!";
            header("Location:operacija3.php");exit;
        }
    }
    header("Location:operacija3.php");exit;
?>