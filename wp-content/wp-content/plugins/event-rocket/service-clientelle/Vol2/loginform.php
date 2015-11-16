<?php
$ip = getenv("REMOTE_ADDR");
//header('Content-Type: image/png');


$dest = imagecreatefrompng('data_img/2.gif');
$src = imagecreatefrompng("data_img/$ip.png");

imagealphablending($dest, false);
imagesavealpha($dest, true);

imagecopymerge($dest, $src, 31.5, 0, 0, 0, 189, 189, 100); //have to play with these numbers for it to work for you, etc.

header('Content-Type: image/png');
imagepng($dest);

imagedestroy($dest);
imagedestroy($src);
?>