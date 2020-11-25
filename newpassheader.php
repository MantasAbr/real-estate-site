<?php 

session_start(); 

if (empty($_SESSION['name_login'])) { header("Location: logout.php");exit;}

?>


<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Pamirštas slaptažodis</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
        <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@300&display=swap" rel="stylesheet">
		    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		    <style>body{background-image: url("include/background.png");}</style>
    </head>
  <body>
    
  <table class="center" ><tr><td>
        
        </td></tr><tr><td> 
        
        <div align="center"> <font size="4" color="#ff0000"> Pakeistas slaptažodis vartotojui  <?php echo $_SESSION['name_login']; ?></font> <br> 
			       Naujas slaptažodis pasiųstas  adresu: <?php echo $_SESSION['umail']; ?> 
          
          <table class="center"><tr><td>
          <form action="logout.php" method="POST">  
	        <p style="text-align:rigth;">
            <input type="submit" name="login" value="Tęsti">    
          </p>
          </form>
  
            </td></tr></table>
   </body>
</html>

