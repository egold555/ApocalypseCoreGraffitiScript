<?php


header("Content-type: image/png");

$fontType = isset($_GET['f']) ? $_GET['f'] : '1';
$font = 'C:\wamp64\www\websites\spray\fonts\\'.$fontType.'.ttf';


$size = 40;
$angle = 0;
$sx = 0;
$sy = 70;

$text = isset($_GET['t']) ? $_GET['t'] : 'NO TEXT';
$text = strtoupper($text);
$text = preg_replace("/[^A-Z ]+/", "", $text);

$colorR = isset($_GET['r']) ? (int)$_GET['r'] : 0;
$colorG = isset($_GET['g']) ? (int)$_GET['g'] : 0;
$colorB = isset($_GET['b']) ? (int)$_GET['b'] : 0;

// Create the image
function imageCreateTransparent($x, $y) {
    $imageOut = imagecreatetruecolor($x, $y);
    $backgroundColor = imagecolorallocatealpha($imageOut, 0, 0, 0, 127);
    imagefill($imageOut, 0, 0, $backgroundColor);
    return $imageOut;
}


$bbox = imagettfbbox($size, $angle, $font, $text);


$imgWidth = $bbox[4] + $sx;
$imgHeight = $bbox[3] + $sy;

$image = imageCreateTransparent($imgWidth, $imgHeight);

// Create some colors
$white = imagecolorallocate($image, $colorR, $colorG, $colorB);





//// Add the text
imagettftext($image, $size, $angle, $sx, $sy, $white, $font, $text);
//imagealphablending($image, true); //not needed as we created the image with alpha
imagesavealpha($image, true);
//imagepng($image, '../../var/log/wtf5.png');
imagepng($image);
imagedestroy($image);

?>
