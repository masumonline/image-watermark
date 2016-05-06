<?php
// Load the stamp and the photo to apply the watermark to

$filename = 'win7usb.jpg';
//the resize will be a percent of the original size
$percent = 0.5;

// Get new sizes
list($width, $height) = getimagesize($filename);
$newwidth = $width * $percent;
$newheight = $height * $percent;

// Load
$thumb = imagecreatetruecolor($newwidth, $newheight);
$source = imagecreatefromjpeg($filename);

// Resize
imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);


$stamp = $thumb;
$im = imagecreatefromjpeg('photo.jpg');

// Set the margins for the stamp and get the height/width of the stamp image
$marge_right = 10;

$marge_bottom = (imagesx($im)/2) - (imagesx($stamp)/2) - 20;

//$marge_bottom = 50;
$sx = imagesx($stamp);
$sy = imagesy($stamp);

// Copy the stamp image onto our photo using the margin offsets and the photo 
// width to calculate positioning of the stamp. 
imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));

// Output and free memory
header('Content-type: image/png');
imagepng($im);
imagedestroy($im);
?>