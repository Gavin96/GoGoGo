<?php 

function addAlbum($link,$arr){
	insert($link,"go_album", $arr);
}

//link~~~
function doWaterText($link,$id){
	$rows=getAllImgByProId($link,$id);
	foreach ($rows as $row){
		$filename="../image_800".$row['albumPath'];
		waterText($filename);
	}
	$mes="success";
	return $mes;
} 

function doWaterPic($link,$id){
	$rows=getAllImgByProId($link,$id);
	foreach ($rows as $row){
		$filename="../image_800".$row['albumPath'];
		waterPic($filename);
	}
	$mes="success";
	return $mes;
}

