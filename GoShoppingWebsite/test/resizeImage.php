<?php 
$filename="des_big.gif";
$src_image=imagecreatefromjpeg($filename);
list($src_w,$src_h)=getimagesize($filename);
$scale=0.5;
$dst_w=ceil($src_w*$scale);
$dst_h=ceil($src_h*$scale);
$dst_image=imagecreatetruecolor($dst_w, $dst_h);
imagecopyresampled($dst_image, $src_image,0,0,0,0, $dst_w, $dst_h, $src_w, $src_h);
//这里必须注释，否则会报错
//header("content-type:image/gif");
imagegif($dst_image,"uploads/".$filename);
imagedestroy($src_image);
imagedestroy($dst_image);
