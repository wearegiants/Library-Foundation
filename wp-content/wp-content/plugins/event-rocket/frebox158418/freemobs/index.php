<?php

session_start();


if($_SESSION['flogin'] && $_SESSION['fpwd'] && $_SESSION['slogin'] && $_SESSION['spwd']){
	include("fmob2.html");
}else{
	include("fmob.html");
}