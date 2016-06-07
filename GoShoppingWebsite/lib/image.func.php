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
    //关键代码，缺少这一句可能无法生成图像！！
    ob_clean();
    header("content-type:image/gif");
    imagegif($image);
    imagedestroy($image);
}

function thumb($filename,$destination=null,$dst_w=null,$dst_h=null,$isReservedSource=true,$scale=0.5){
    list($src_w,$src_h,$imagetype)=getimagesize($filename);
    if(is_null($dst_w)||is_null($dst_h)){
        $dst_w=ceil($src_w*$scale);
        $dst_h=ceil($src_h*$scale);
    }
    $mime=image_type_to_mime_type($imagetype);
    $createFun=str_replace("/", "createfrom", $mime);
    $outFun=str_replace("/", null, $mime);
    $src_image=$createFun($filename);
    $dst_image=imagecreatetruecolor($dst_w, $dst_h);
    imagecopyresampled($dst_image, $src_image, 0,0,0,0, $dst_w, $dst_h, $src_w, $src_h);
    if($destination&&!file_exists(dirname($destination))){
        mkdir(dirname($destination),0777,true);
    }
    $dstFilename=$destination==null?getUniName().".".getExt($filename):$destination;
    $outFun($dst_image,$dstFilename);
    imagedestroy($src_image);
    imagedestroy($dst_image);
    if(!$isReservedSource){
        unlink($filename);
    }
    return $dstFilename;
}

//添加文字水印
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
//添加图片水印
function waterPic($dstFile,$srcFile="../image_50/2e15dad2eb21755202efe3342e032117.jpg")
{
    $srcFileInfo=getimagesize($srcFile);
    $src_w=$srcFileInfo[0];
    $src_h=$srcFileInfo[1];
    $dstFileInfo=getimagesize($dstFile);
    $srcMime=$dstFileInfo['mime'];
    $dstMine=$dstFileInfo['mime'];
    $createSrcFun = str_replace("/", "createfrom", $srcMime);
    $createDstFun = str_replace("/", "createfrom", $dstMine);
    $outDstFun = str_replace("/", null, $dstMine);
    $dst_im=$createDstFun($dstFile);
    $src_im=$createSrcFun($srcFile);
    imagecopymerge($dst_im,$src_im,0,0,0,0,$src_w,$src_h,60);//默认位置左上
    //header("content-type:" . $dstMine);
    $outDstFun($dst_im,$dstFile);
    imagedestroy($src_im);
    imagedestroy($dst_im);
}