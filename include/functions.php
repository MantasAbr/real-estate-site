<?php
// funkcijos  include/functions.php

function inisession($arg) {   //valom sesijos kintamuosius
            if($arg =="full"){
                $_SESSION['message']="";
                $_SESSION['user']="";
	       		$_SESSION['ulevel']=0;
				$_SESSION['userid']=0;
				$_SESSION['umail']=0;
				$_SESSION['utelephone']=0;
            }			    	 
		$_SESSION['name_login']="";
		$_SESSION['pass_login']="";
		$_SESSION['mail_login']="";
		$_SESSION['telephone_login']="";
		$_SESSION['address_post']="";
		$_SESSION['city_post']="";
		$_SESSION['price_post']="";
		$_SESSION['description_post']="";  

		$_SESSION['name_error']="";
      	$_SESSION['pass_error']="";
		$_SESSION['mail_error']="";
		$_SESSION['telephone_error']="";
		$_SESSION['address_error']="";
		$_SESSION['city_error']="";
		$_SESSION['price_error']="";
		$_SESSION['description_error']="";
		$_SESSION['image_error']="";
        }

function checkname ($username){   // Vartotojo vardo sintakse
	   if (!$username || strlen($username = trim($username)) == 0) 
			{$_SESSION['name_error']=
				 "<font size=\"2\" color=\"#ff0000\">* Neįvestas vartotojo vardas</font>";
			 "";
			 return false;}
            elseif (!preg_match("/^([0-9a-zA-Z])*$/", $username))  /* Check if username is not alphanumeric */ 
			{$_SESSION['name_error']=
				"<font size=\"2\" color=\"#ff0000\">* Vartotojo vardas gali būti sudarytas<br>
				&nbsp;&nbsp;tik iš raidžių ir skaičių</font>";
		     return false;}
	        else return true;
   }
             
 function checkpass($pwd,$dbpwd) {     //  slaptazodzio tikrinimas (tik demo: min 4 raides ir/ar skaiciai) ir ar sutampa su DB esanciu
	   if (!$pwd || strlen($pwd = trim($pwd)) == 0) 
			{$_SESSION['pass_error']=
			  "<font size=\"2\" color=\"#ff0000\">* Neįvestas slaptažodis</font>";
			 return false;}
            elseif (!preg_match("/^([0-9a-zA-Z])*$/", $pwd))  /* Check if $pass is not alphanumeric */ 
			{$_SESSION['pass_error']="* Čia slaptažodis gali būti sudarytas<br>&nbsp;&nbsp;tik iš raidžių ir skaičių";
		     return false;}
            elseif (strlen($pwd)<4)  // per trumpas
			         {$_SESSION['pass_error']=
						  "<font size=\"2\" color=\"#ff0000\">* Slaptažodžio ilgis <4 simbolius</font>";
		              return false;}
	          elseif ($dbpwd != substr(hash( 'sha256', $pwd ),5,32))
               {$_SESSION['pass_error']=
				   "<font size=\"2\" color=\"#ff0000\">* Neteisingas slaptažodis</font>";
                return false;}
            else return true;
   }

 function checkdb($username) {  // iesko DB pagal varda, grazina {vardas,slaptazodis,lygis,id} ir nustato name_error
		 $db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		 $sql = "SELECT * FROM " . TBL_USERS. " WHERE username = '$username'";
		 $result = mysqli_query($db, $sql);
	     $uname = $upass = $ulevel = $uid = $umail = $utelephone = null;
		 if (!$result || (mysqli_num_rows($result) != 1))   // jei >1 tai DB vardas kartojasi, netikrinu, imu pirma
	  	 {  // neradom vartotojo DB
		    $_SESSION['name_error']=
			 "<font size=\"2\" color=\"#ff0000\">* Tokio vartotojo nėra</font>";
         }
      else {  //vardas yra DB
           $row = mysqli_fetch_assoc($result); 
           $uname= $row["username"]; $upass= $row["password"]; 
		   $ulevel=$row["userlevel"]; $uid= $row["userid"]; 
		   $umail = $row["email"]; $utelephone = $row["telephone"];}
     return array($uname,$upass,$ulevel,$uid,$umail,$utelephone);
 }

function checkmail($mail) {   // e-mail sintax error checking  
	   if (!$mail || strlen($mail = trim($mail)) == 0) 
			{$_SESSION['mail_error']=
				"<font size=\"2\" color=\"#ff0000\">* Neįvestas e-pašto adresas</font>";
			   return false;}
		elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) 
			      {$_SESSION['mail_error']=
					   "<font size=\"2\" color=\"#ff0000\">* Neteisingas e-pašto adreso formatas</font>";
		            return false;}
	        else return true;
}


function checkphone($telephone) {
	if(!$telephone || strlen($telephone = trim($telephone)) == 0){
		$_SESSION['telephone_error'] = 
			"<font size=\"2\" color=\"#ff0000\">* Neįvestas telefono numeris</font>";
		return false;
	}
	else{
		if(preg_match("/\+3706[0-9]{7}$/", $telephone) && strlen($telephone) == 12){
			return true;
		}
		else{
			$_SESSION['telephone_error'] = 
				"<font size=\"2\" color=\"#ff0000\">* Blogas telefono numerio formatas</font>";
			return false;
		}
	}
}

function checkaddress ($address){
	if (!$address || strlen($address = trim($address)) == 0) 
	{$_SESSION['address_error']=
		"<font size=\"2\" color=\"#ff0000\">* Neįvestas adresas</font>";
		"";
		return false;}
	elseif (!preg_match("/[0-9\p{L}]+/u", $address)) 
	{$_SESSION['address_error']=
		"<font size=\"2\" color=\"#ff0000\">* Nenaudokite skyrybos ženklų</font>";
	return false;}

	else return true;
}

function checkobjects($address) {  // iesko DB pagal varda, grazina {vardas,slaptazodis,lygis,id} ir nustato name_error
	$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	$sql = "SELECT * FROM " . TBL_POSTS. " WHERE address = '$address'";
	$result = mysqli_query($db, $sql);
	if (!$result || (mysqli_num_rows($result) != 1))   // jei >1 tai DB vardas kartojasi, netikrinu, imu pirma
	{
		return false;
	}
	else {  
		return true;
	}
}

function checkcity ($city){
	if (!$city || strlen($city = trim($city)) == 0) 
	{$_SESSION['city_error']=
		"<font size=\"2\" color=\"#ff0000\">* Neįvestas miestas</font>";
		"";
		return false;}
	elseif (!preg_match("/[\p{L}]+/u", $city)) 
	{$_SESSION['city_error']=
		"<font size=\"2\" color=\"#ff0000\">* Nenaudokite skyrybos ženklų ir\arba skaičių</font>";
		return false;}

	else return true;
}

function checkprice ($price){
	if (!$price || strlen($price = trim($price)) == 0) 
	{$_SESSION['price_error']=
		"<font size=\"2\" color=\"#ff0000\">* Neįvesta kaina</font>";
		"";
		return false;}
	elseif (!preg_match("/[0-9]+/u", $price)) 
	{$_SESSION['price_error']=
		"<font size=\"2\" color=\"#ff0000\">* Nenaudokite raidžių</font>";
		return false;}

	else return true;
}

function checkdescription ($description){
	if (!$description || strlen($description = trim($description)) == 0) 
	{$_SESSION['description_error']=
		"<font size=\"2\" color=\"#ff0000\">* Neįvestas aprašymas</font>";
		"";
		return false;}
	elseif (!preg_match("/[0-9.,?!\p{L}]+/u", $description)) 
	{$_SESSION['description_error']=
		"<font size=\"2\" color=\"#ff0000\">* Nenaudokite neleistinų ženklų</font>";
		return false;}

	else return true;
}