<?php
$srcFile="../image_50/2e15dad2eb21755202efe3342e032117.jpg";
$dstFile="../image_800/22d44f70b59b375c806270ffd95ab3ff.jpg";
waterPic($dstFile);
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
    $outDstFun($dst_im);
    imagedestroy($src_im);
    imagedestroy($dst_im);
}