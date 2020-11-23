<?php
// procadmindb.php   admino nurodytus pakeitimus padaro DB
// $_SESSION['ka_keisti'] kuriuos vartotojus, $_SESSION['pakeitimai'] į kokį userlevel
	
session_start();
// cia sesijos kontrole: tik is procadmin
if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "procadmin"))
{ header("Location: logout.php");exit;}

include("include/nustatymai.php");
include("include/functions.php");
$_SESSION['prev'] = "procadmindb";

$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
$i=0;
$levels=$_SESSION['pakeitimai'];

foreach ($_SESSION['ka_keisti'] as $id){
  $level=$levels[$i++];
  if ($level == -1){
    $userID = $id;
    $sql = "DELETE FROM ". TBL_USERS. "  WHERE  userId='$userID'";
    if (mysqli_query($db, $sql)){                       //Triname vartotoja is vartotojas lenteles    
      $deletePosts = "DELETE FROM ". TBL_POSTS. " WHERE seller_id='$userID'";
      if (mysqli_query($db, $deletePosts)){             //Triname objektų įrašus, kurie buvo paskelbti vartotojo
        $deleteMessages = "DELETE FROM ". TBL_MESSAGES. " WHERE user_id='$userID'";
        if (mysqli_query($db, $deleteMessages)){        //Triname žinutes, kurios buvo skirtos adminui dėl vartotojo teisių pakėlimo  
          $_SESSION['message']="Pakeitimai atlikti sėkmingai";
          header("Location:admin.php");exit;
        }
        else{
          echo " DB klaida šalinant vartotojo privilegijų teisių žinutes: " . $sql . "<br>" . mysqli_error($db);
          exit;
        }
      }
      else{
        echo " DB klaida šalinant vartotoją objektų įrašus: " . $sql . "<br>" . mysqli_error($db);
        exit; 
      }
    }
    else{    
      echo " DB klaida šalinant vartotoją iš lentelės: " . $sql . "<br>" . mysqli_error($db);
      exit;
    }
  } 
  else{
    $sql = "UPDATE ". TBL_USERS." SET userlevel='$level' WHERE  userId='$userID'";
    if (!mysqli_query($db, $sql)){
      echo " DB klaida keičiant vartotojo įgaliojimus: " . $sql . "<br>" . mysqli_error($db);
      exit;
    } 
    else{
      $_SESSION['message']="Pakeitimai atlikti sėkmingai";
      header("Location:admin.php");exit;
    }   
  }
}
