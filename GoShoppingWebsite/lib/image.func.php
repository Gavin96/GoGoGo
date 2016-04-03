<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/2
 * Time: 14:17
 */
require_once "string.func.php";
//创建图片验证码
function verifyImage(){
    $width = 80;
    $height = 30;
    $image = imagecreatetruecolor($width,$height);
    $white = imagecolorallocate($image,255,255,255);
    $black = imagecolorallocate($image,0,0,0);
    imagefilledrectangle($image,1,1,$width-2,$height-2,$white);

    $chars = buildRandomString();
    //验证码存入session中
    $_SESSION["verify"] = $chars;
    for($i=0;$i<4;$i++){
        $size = mt_rand(18,22);
        $angle = mt_rand(-15,15);
        $x = 5+$i*$size;
        $y = mt_rand(20,26);
        $color = imagecolorallocate($image,mt_rand(90,190),mt_rand(10,140),mt_rand(70,210));
        $fontfile = "../fonts/font1.ttf";
        $text = substr($chars,$i,1);
        imagettftext($image,$size,$angle,$x,$y,$color,$fontfile,$text);
    }
    for($i=0;$i<60;$i++){
        imagesetpixel($image,mt_rand(0,$width-1),mt_rand(0,$height-1),$black);
    }
    header("content-type:image/gif");
    imagegif($image);
    imagedestroy($image);
}
