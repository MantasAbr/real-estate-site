<?php
// index.php
// jei vartotojas prisijungęs rodomas demonstracinis meniu pagal jo rolę
// jei neprisijungęs - prisijungimo forma per include("login.php");
// toje formoje daugiau galimybių...

session_start();
include("include/functions.php");
?>

<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Nekilnojamojo turto portalas</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
        <style>body{background-image: url("include/background.png");}</style>
    </head>
    <body>
        <table class="center" ><tr><td>
            
        
<?php
           
    if (!empty($_SESSION['user']))     //Jei vartotojas prisijungęs, valom logino kintamuosius ir rodom meniu
    {                                  // Sesijoje nustatyti kintamieji su reiksmemis is DB
                                       // $_SESSION['user'],$_SESSION['ulevel'],$_SESSION['userid'],$_SESSION['umail']
		
		inisession("part");   //   pavalom prisijungimo etapo kintamuosius
		$_SESSION['prev']="index"; 
        
        include("include/meniu.php"); //įterpiamas meniu pagal vartotojo rolę
?>
                <div class="intro">
                    <h1 class="intro">Nekilnojamojo turto tinklalapis.</h1>
                    <h1 class="intro">Darbas priklauso Mantui Abramavičiui IFAp-8</h1>
                </div><br>
      <?php
          }                
          else {   			 
              
              if (!isset($_SESSION['prev'])) inisession("full");             // nustatom sesijos kintamuju pradines reiksmes 
              else {if ($_SESSION['prev'] != "proclogin") inisession("part"); // nustatom pradines reiksmes formoms
                   }  
   			  // jei ankstesnis puslapis perdavė $_SESSION['message']
                echo "<div align=\"center\">";
                echo "<p style=\"color: red; font-family: 'Titillium Web', Courier, monospace; font-size: 18px;\">
                    ".$_SESSION['message'] . "<br></p>";          
		
                echo "<table><tr><td>";
          include("include/login.php");                    // prisijungimo forma
                echo "</td></tr></table></div><br>";
           
		  }
?>
            </body>
</html>
