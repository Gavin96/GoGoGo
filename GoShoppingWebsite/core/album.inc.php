<?php 

function addAlbum($link,$arr){
	insert($link,"go_album", $arr);
}

function getProImgById($link,$id){
	$sql="select albumPath from go_album where Pid={$id} ";
	$rows=fetchOne($link,$sql);
	return $rows;
}

function getAllProImgById($link,$id){
	$sql="select albumPath from go_album where Pid={$id} ";
	$rows=fetchAll($link,$sql);
	return $rows;
}

function doWaterText($id){
	$link = connect();
	$row=getAlbumPathById($link,$id);

	$filename="../image_50/".$row['albumPath'];
	waterText($filename);
	$filename="../image_220/".$row['albumPath'];
	waterText($filename);
	$filename="../image_350/".$row['albumPath'];
	waterText($filename);
	$filename="../image_800/".$row['albumPath'];
	waterText($filename);

	$mes="文字水印添加成功!<br/><a href='listProImages.php'>继续添加</a>";
	return $mes;
}
function doWaterPic($id){
	$link = connect();
	$row=getAlbumPathById($link,$id);

	$filename="../image_50/".$row['albumPath'];
	waterText($filename);
	$filename="../image_220/".$row['albumPath'];
	waterText($filename);
	$filename="../image_350/".$row['albumPath'];
	waterText($filename);
	$filename="../image_800/".$row['albumPath'];
	waterText($filename);
	
	$mes="图片水印添加成功!<br/><a href='listProImages.php'>继续添加</a>";
	return $mes;
}

