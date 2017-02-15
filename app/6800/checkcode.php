<?php
session_start();
for($i=0;$i<4;$i++){
	$code.=rand(0,9);
}
$_SESSION[checkcode]=$code;
$im=imagecreate(35,16);
$back=imagecolorallocate($im,250,250,250);
$font=imagecolorallocate($im,107,42,26);
imagestring($im,4,0,0,$code,$font);

header("Content-type: image/jpeg");
imagejpeg($im);
?>
