<?php
// meniu.php  rodomas meniu pagal vartotojo rolę

if (!isset($_SESSION)) { header("Location: logout.php");exit;}
include("include/nustatymai.php");
$user=$_SESSION['user'];
$userlevel=$_SESSION['ulevel'];
$role="";
{foreach($user_roles as $x=>$x_value)
			      {if ($x_value == $userlevel) $role=$x;}
} 

     echo "<table width=100% border=\"0\" cellspacing=\"1\" cellpadding=\"3\" class=\"meniu\">";
        echo "<tr><td>";
        if($_SESSION['user'] == "guest") echo "Prisijungęs kaip svečias";
        else echo "<p style=\"font-family: 'Titillium Web', sans-serif;\">Prisijungęs vartotojas: <b>".$user."</b>     Rolė: <b>".$role."</b> <br></p>";
        echo "</td></tr><tr><td>";
        if ($_SESSION['user'] != "guest") echo "<a href=\"useredit.php\" class=\"meniu\">Redaguoti paskyrą</a> &nbsp;&nbsp;";
        echo "<a href=\"operacija1.php\" class=\"meniu\">Peržiūrėti skelbimus</a> &nbsp;&nbsp;";
        //Operacija skirta tik pirkėjui - Pirkti objektą
        if($userlevel == $user_roles["Vartotojas"]){
            echo "<a href=\"operacija2.php\" class=\"meniu\">Pirkti objektai</a> &nbsp;&nbsp;";
        }        
        //Trečia operacija tik rodoma pasirinktu kategoriju vartotojams, pvz.:
        if (($userlevel == $user_roles["Pardavėjas"]) || ($userlevel == $user_roles[ADMIN_LEVEL] )) {
            echo "<a href=\"operacija3.php\" class=\"meniu\">Įkelti naują skelbimą</a> &nbsp;&nbsp;";
        }
        if(($userlevel == $user_roles["Pardavėjas"])){
            echo "<a href=\"operacija4.php\" class=\"meniu\">Patvirtinimo laukiantys skelbimai</a> &nbsp;&nbsp;";
        }          
        //Administratoriaus sąsaja rodoma tik administratoriui
        if ($userlevel == $user_roles[ADMIN_LEVEL] ) {
            echo "<a href=\"admin.php\" class=\"meniu\">Administratoriaus sąsaja</a> &nbsp;&nbsp;";
        }
        if($_SESSION['user'] == "guest") echo "<br>";
        echo "<a href=\"logout.php\" class=\"meniu\" style=\"margin: 15px 0px; font-size: 14px; font-weight: lighter;\">Atsijungti</a>";
      echo "</td></tr></table>";
?>       
    
 