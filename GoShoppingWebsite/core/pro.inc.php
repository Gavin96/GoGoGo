<?php 

function addPro(){
	$link = connect();
	$arr=$_POST;
	//删除以post方式提交的act
	unset($arr['act']);
	unset($arr['thumb[]']);
	$arr['pTime']=time();
	$arr['pImg']="./uploads";
	$arr['isShow']=1;
	$arr['isHot']=0;
	$path="./uploads";
	$uploadFiles=uploadFile($path);
	if(is_array($uploadFiles)&&$uploadFiles){
		foreach($uploadFiles as $key=>$uploadFile){
			thumb($path."/".$uploadFile['name'],"../image_50/".$uploadFile['name'],50,50);
			thumb($path."/".$uploadFile['name'],"../image_220/".$uploadFile['name'],220,220);
			thumb($path."/".$uploadFile['name'],"../image_350/".$uploadFile['name'],350,350);
			thumb($path."/".$uploadFile['name'],"../image_800/".$uploadFile['name'],800,800);
		}
	}
	$res=insert($link,"go_product",$arr);
	$pid=getInsertId($link);
	if($res&&$pid){
		foreach($uploadFiles as $uploadFile){
			$arr1['Pid']=$pid;
			$arr1['albumPath']=$uploadFile['name'];
			addAlbum($link,$arr1);
		}
		$mes="<p>添加成功!</p><a href='addPro.php' target='mainFrame'>继续添加</a>|<a href='listPro.php' target='mainFrame'>查看商品列表</a>";
	}else{
		foreach($uploadFiles as $uploadFile){
			if(file_exists("../image_800/".$uploadFile['name'])){
				unlink("../image_800/".$uploadFile['name']);
			}
			if(file_exists("../image_50/".$uploadFile['name'])){
				unlink("../image_50/".$uploadFile['name']);
			}
			if(file_exists("../image_220/".$uploadFile['name'])){
				unlink("../image_220/".$uploadFile['name']);
			}
			if(file_exists("../image_350/".$uploadFile['name'])){
				unlink("../image_350/".$uploadFile['name']);
			}
		}
		$mes="<p>添加失败!</p><a href='addPro.php' target='mainFrame'>重新添加</a>";
		
	}
	return $mes;
}

function editPro($id){
	$link = connect();
	$arr=$_POST;
	unset($arr['act']);
	unset($arr['id']);
	$path="./uploads";
	$uploadFiles=uploadFile($path);
	if(is_array($uploadFiles)&&$uploadFiles){
		foreach($uploadFiles as $key=>$uploadFile){
			thumb($path."/".$uploadFile['name'],"../image_50/".$uploadFile['name'],50,50);
			thumb($path."/".$uploadFile['name'],"../image_220/".$uploadFile['name'],220,220);
			thumb($path."/".$uploadFile['name'],"../image_350/".$uploadFile['name'],350,350);
			thumb($path."/".$uploadFile['name'],"../image_800/".$uploadFile['name'],800,800);
		}
	}
	$where="id={$id}";
	$res=update($link,"go_product",$arr,$where);
	//如果只编辑图片，那么$res=0
	$pid=$id;
	if(($res&&$pid)||(is_array($uploadFiles))){
		if($uploadFiles &&is_array($uploadFiles)){
			foreach($uploadFiles as $uploadFile){
				$arr1['Pid']=$pid;
				$arr1['albumPath']=$uploadFile['name'];
				addAlbum($link,$arr1);
			}
		}

		$mes="<p>编辑成功!</p><a href='listPro.php' target='mainFrame'>查看商品列表</a>";
	}else{
	if(is_array($uploadFiles)&&$uploadFiles){
		foreach($uploadFiles as $uploadFile){
			if(file_exists("../image_800/".$uploadFile['name'])){
				unlink("../image_800/".$uploadFile['name']);
			}
			if(file_exists("../image_50/".$uploadFile['name'])){
				unlink("../image_50/".$uploadFile['name']);
			}
			if(file_exists("../image_220/".$uploadFile['name'])){
				unlink("../image_220/".$uploadFile['name']);
			}
			if(file_exists("../image_350/".$uploadFile['name'])){
				unlink("../image_350/".$uploadFile['name']);
			}
		}
	}
		$mes="<p>编辑失败!</p><a href='listPro.php' target='mainFrame'>重新编辑</a>";
		
	}
	return $mes;
}

function delPro($id)
{
	$link = connect();
	$where = "id=$id";
	$res = delete($link, "go_product", $where);
	$proImgs = getAllImgByProId($link, $id);
	if ($proImgs && is_array($proImgs)) {
		foreach ($proImgs as $proImg) {
			if (file_exists("uploads/" . $proImg['albumPath'])) {
				unlink("uploads/" . $proImg['albumPath']);
			}
			if (file_exists("../image_50/" . $proImg['albumPath'])) {
				unlink("../image_50/" . $proImg['albumPath']);
			}
			if (file_exists("../image_220/" . $proImg['albumPath'])) {
				unlink("../image_220/" . $proImg['albumPath']);
			}
			if (file_exists("../image_350/" . $proImg['albumPath'])) {
				unlink("../image_350/" . $proImg['albumPath']);
			}
			if (file_exists("../image_800/" . $proImg['albumPath'])) {
				unlink("../image_800/" . $proImg['albumPath']);
			}

		}
	}
	$where1 = "pid={$id}";
	$res1 = delete($link, "do_album", $where1);
	if ($res && $res1) {
		$mes = "删除成功!<br/><a href='listPro.php' target='mainFrame'>查看商品列表</a>";
	} else {
		$mes = "删除失败!<br/><a href='listPro.php' target='mainFrame'>重新删除</a>";
	}
	return $mes;
}

function getAlbumPathById($link,$id){
	$sql="select albumPath from go_album where id={$id}";
	$row=fetchOne($link,$sql);
	return $row;
}

function getAllProByAdmin($link){
	$sql="select p.id,p.pName,p.pIndex,p.pNum,p.mPrice,p.iPrice,p.pDescription,p.pTime,p.isShow,p.isHot,c.name from go_product as p join go_cate c on p.cId=c.id";
	$rows=fetchAll($link,$sql);
	return $rows;
}


function getAllImgByProId($link,$id){
	$sql="select albumPath from go_album a where Pid={$id}";
	$rows=fetchAll($link,$sql);
	return $rows;
}


function getProById($link,$id){
		$sql="select p.id,p.pName,p.pIndex,p.pNum,p.mPrice,p.iPrice,p.pDescription,p.pTime,p.isShow,p.isHot,c.name,p.cId from go_product as p join go_cate c on p.cId=c.id where p.id={$id}";
		$row=fetchOne($link,$sql);
		return $row;
}


function checkProExist($link,$cid){
	$sql="select * from go_product where cId={$cid}";
	$rows=fetchAll($link,$sql);
	return $rows;
}

function getAllPros($link){
	$sql="select p.id,p.pName,p.pIndex,p.pNum,p.mPrice,p.iPrice,p.pDescription,p.pTime,p.isShow,p.isHot,c.name,p.cId from go_product as p join go_cate c on p.cId=c.id";
	$rows=fetchAll($link,$sql);
	return $rows;
}

function getProByCId($link,$id){
	$sql="select p.id,p.pName,p.pIndex,p.pNum,p.mPrice,p.iPrice,p.pDescription,p.pTime,p.isShow,p.isHot,c.name,p.cId from go_product as p join go_cate c on p.cId=c.id where p.cId={$id} and p.pNum>0 limit 4";
	$row=fetchAll($link,$sql);
	return $row;
}

function getSmallProByCId($link,$id){
	$sql="select p.id,p.pName,p.pIndex,p.pNum,p.mPrice,p.iPrice,p.pDescription,p.pTime,p.isShow,p.isHot,c.name,p.cId from go_product as p join go_cate c on p.cId=c.id where p.cId={$id} and p.pNum>0 limit 4,4";
	$row=fetchAll($link,$sql);
	return $row;
}

function getAllProByCId($link,$id){
	$sql="select p.id,p.pName,p.pIndex,p.pNum,p.mPrice,p.iPrice,p.pDescription,p.pTime,p.isShow,p.isHot,c.name,p.cId from go_product as p join go_cate c on p.cId=c.id where p.cId={$id} and p.pNum>0";
	$row=fetchAll($link,$sql);
	return $row;
}

function getAllProByDes($link){
	$sql="select p.id,p.pName,p.pIndex,p.pNum,p.mPrice,p.iPrice,p.pDescription,p.pTime,p.isShow,p.isHot,c.name,p.cId from go_product as p join go_cate c on p.cId=c.id where p.pNum>0 and p.pDescription like '%sale%'";
	$rows=fetchAll($link,$sql);
	return $rows;
}

function getHotPro($link){
	$sql="select p.id,p.pName,p.pIndex,p.pNum,p.mPrice,p.iPrice,p.pDescription,p.pTime,p.isShow,p.isHot,c.name,p.cId from go_product as p join go_cate c on p.cId=c.id where p.pNum>0 and p.isHot>0 order by p.isHot DESC limit 8";
	$rows=fetchAll($link,$sql);
	return $rows;
}

function getAllProByName($link,$product_name){
	$sql="select p.id,p.pName,p.pIndex,p.pNum,p.mPrice,p.iPrice,p.pDescription,p.pTime,p.isShow,p.isHot,c.name,p.cId from go_product as p join go_cate c on p.cId=c.id where p.pNum>0 and p.pName like '%{$product_name}%'";
	$rows=fetchAll($link,$sql);
	return $rows;
}

function getSimilarProByCId($link,$cId,$proID){
	$sql="select p.id,p.pName,p.pIndex,p.pNum,p.mPrice,p.iPrice,p.pDescription,p.pTime,p.isShow,p.isHot,c.name,p.cId from go_product as p join go_cate c on p.cId=c.id where p.pNum>0 and c.id = {$cId} and p.id!={$proID} limit 2";
	$row=fetchAll($link,$sql);
	return $row;
}

function getRecommendPro($link,$proID){
	//生成随机数
	$arr=range(0,4);
	shuffle($arr);
	$sql="select p.id,p.pName,p.pIndex,p.pNum,p.mPrice,p.iPrice,p.pDescription,p.pTime,p.isShow,p.isHot,c.name,p.cId from go_product as p join go_cate c on p.cId=c.id where p.pNum>0 and p.isHot>0 and p.id!={$proID} order by p.isHot DESC limit {$arr[0]},1";
	$rows=fetchAll($link,$sql);
	return $rows;
}

function getProInfo ($link)
{
	$sql = "select a.id,a.Pid,p.pName,a.albumPath from go_album as a join go_product as p on a.Pid=p.id";
	$rows=fetchAll($link,$sql);
	return $rows;
}