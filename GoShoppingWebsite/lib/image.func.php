<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/2
 * Time: 14:17
 */

//创建画布
$width = 80;
$height = 20;
$image = imagecreatetruecolor($width,$height);
$white = imagecolorallocate($image,255,255,255);
$black = imagecolorallocate($image,0,0,0);
imagefilledrectangle($image,1,1,$width-2,$height-2,$white);
