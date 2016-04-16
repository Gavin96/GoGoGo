<?php
$filename="des_big.gif";
waterText($filename);
function waterText($filename,$text="GoGoGo.com",$fontfile="font1.TTF")
{
    $fileInfo = getimagesize($filename);
    $mime = $fileInfo['mime'];
    $createFun = str_replace("/", "createfrom", $mime);//jpg
    $outFun = str_replace("/", null, $mime);
    $image = $createFun($filename);
    $color = imagecolorallocatealpha($image, 255, 0, 0, 50);
    $fontfile = "../fonts/{$fontfile}";
    imagettftext($image, 14, 0, 0, 14, $color, $fontfile, $text);
    //header("content-type:" . $mime);
    $outFun($image,$filename);
    imagedestroy($image);
}