<?php 

function addAlbum($link,$arr){
	insert($link,"go_album", $arr);
}

function getProImgById($link,$id){
	$sql="select albumPath from go_album where Pid={$id} ";
	$rows=fetchOne($link,$sql);
	return $rows;
}

