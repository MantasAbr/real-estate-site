<?php
// operacija3.php  Parodoma registruotų vartotojų lentelė

session_start();
if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "index"))
{ header("Location: logout.php");exit;}

?>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Operacija 3</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
		<link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@300&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<style>body{background-image: url("include/background.png");}</style>
    </head>
    <body>
        <table class="center" ><tr><td>
        </td></tr><tr><td> 
 <?php
		include("include/meniu.php"); //įterpiamas meniu pagal vartotojo rolę
 			$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
			$sql = "SELECT username,userlevel,email "
            . "FROM " . TBL_USERS . " ORDER BY userlevel DESC,username";
			$result = mysqli_query($db, $sql);
			if (!$result || (mysqli_num_rows($result) < 1))  
			{echo "Klaida skaitant lentelę users"; exit;}
 ?> 
		</table>
<!--        <center><font size="5">Dabar yra tokia registruotų vartotojų lentelė</font></center><br>
		
    <table class="center" border="1" cellspacing="0" cellpadding="3">
    <tr><td><b>Vartotojo vardas</b></td><td><b>Rolė</b></td><td><b>E-paštas</b></td></tr>
<?php
    //    while($row = mysqli_fetch_assoc($result)) 
	//{	 
	//    $level=$row['userlevel']; 
	//  	$user= $row['username'];
	//	$email=$row['email'];
	//	    echo "<tr><td>".$user. "</td><td>";    
 	//		if ($level == UZBLOKUOTAS) echo "Užblokuotas";
	//		else
	//			{foreach($user_roles as $x=>$x_value)
	//		      {if ($x_value == $level) echo $x;}
	//			} 
	//		echo "</td><td>";
	//	    echo $email."</td></tr>"; 
    //  		
	//}
 ?>
	  </table>
  </body></html>-->
