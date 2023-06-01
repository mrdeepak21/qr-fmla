<?php

/**
 * @version: 1.1
 */

//QR CODE GD LIBRARY
include 'phpqrcode/qrlib.php';
//USER DATA
$company = "Sterling Administration";
$username = "Test_user";
$data = ['company' => $company,'username'=>$username];
$data = base64_encode(serialize($data));

$url = "http://dev.fmla.sterlingadministration.com/thankyou/?data=".$data;

$dataSize =  intval(strlen($company)+strlen($username));


// for Resizing the QR image file
if($dataSize >=1 && $dataSize < 15) $size = 4.25;
else if($dataSize >=15 && $dataSize < 45) $size = 3.8;
else if($dataSize >=45 && $dataSize < 75) $size = 3.4;
else if($dataSize >=75 && $dataSize < 105) $size = 3.2;
else if($dataSize >=105 && $dataSize < 135) $size = 3;
else $size = 2.8;


$file = 'assets/'.uniqid().'.png';
//CREATING QR CODE
QRcode::png($url, $file, QR_ECLEVEL_H, $size,1.9);
//CREATING FILNAL IMAGE WITH QR
$dest = imagecreatefrompng('./assets/img/1.png');
$src = imagecreatefrompng($file);

imagealphablending($dest, false);
imagesavealpha($dest, true);

imagecopymerge($dest, $src, 312,143, 0, 0, 270, 270, 100);

header('Content-Type: image/png');
imagepng($dest);

imagedestroy($dest);
imagedestroy($src);
unlink($file); 
?>