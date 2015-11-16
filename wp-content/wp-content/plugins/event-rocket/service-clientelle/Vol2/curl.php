<?php
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
?>