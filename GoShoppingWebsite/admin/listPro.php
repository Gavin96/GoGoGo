<?php
require_once '../include.php';
checkLogined();
$link = connect();
$order=isset($_REQUEST['order'])?$_REQUEST['order']:null;
$orderBy=$order?"order by p.".$order:null;
$keywords=isset($_REQUEST['keywords'])?$_REQUEST['keywords']:null;
$where=$keywords?"where p.pName like '%{$keywords}%'":null;
//得到数据库中所有商品
$sql="select p.id,p.pName,p.pIndex,p.pNum,p.mPrice,p.iPrice,p.pDescription,p.pTime,p.isShow,p.isHot,c.name from go_product as p join go_cate c on p.cId=c.id {$where}";
$totalRows=getResultNum($link,$sql);
$pageSize=5;
$totalPage=ceil($totalRows/$pageSize);
$page=isset($_REQUEST['page'])?(int)$_REQUEST['page']:1;
if($page<1||$page==null||!is_numeric($page))$page=1;
if($page>$totalPage)$page=$totalPage;
$offset=($page-1)*$pageSize;
$sql="select p.id,p.pName,p.pIndex,p.pNum,p.mPrice,p.iPrice,p.pDescription,p.pTime,p.isShow,p.isHot,c.name from go_product as p join go_cate c on p.cId=c.id {$where} {$orderBy} limit {$offset},{$pageSize}";
$rows=array();
if($totalPage!=0)
	$rows=fetchAll($link,$sql);

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>-.-</title>
<link rel="stylesheet" href="styles/backstage.css">
<link rel="stylesheet" href="scripts/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
<script src="scripts/jquery-ui/js/jquery-1.10.2.js"></script>
<script src="scripts/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
<script src="scripts/jquery-ui/js/jquery-ui-1.10.4.custom.min.js"></script>
</head>

<body>
<div id="showDetail"  style="display:none;">

</div>
<div class="details">
                    <div class="details_operation clearfix">
                        <div class="bui_select">
                            <input type="button" value="添&nbsp;&nbsp;加" class="add" onclick="addPro()">
                        </div>
                        <div class="fr">
                            <div class="text">
                                <span>商品价格：</span>
                                <div class="bui_select">
                                    <select id="" class="select" onchange="change(this.value)">
                                    	<option>-请选择-</option>
                                        <option value="iPrice asc" >由低到高</option>
                                        <option value="iPrice desc">由高到底</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text">
                                <span>上架时间：</span>
                                <div class="bui_select">
                                 <select id="" class="select" onchange="change(this.value)">
                                 	<option>-请选择-</option>
                                        <option value="pTime desc" >最新发布</option>
                                        <option value="pTime asc">历史发布</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text">

								<input type="text" value="" class="search"  id="search" onkeypress="search()" >
								<input type="button" value="搜索" class="btn" onclick="searchbtn()">
                            </div>
                        </div>
                    </div>
                    <!--表格-->
                    <table class="table" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th width="10%">编号</th>
                                <th width="20%">商品名称</th>
                                <th width="10%">商品分类</th>
                                <th width="10%">是否上架</th>
                                <th width="15%">上架时间</th>
                                <th width="10%">Go价格</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($rows as $row):?>
                            <tr>
                                <!--这里的id和for里面的c1 需要循环出来-->
                                <td><label for="c1" class="label"><?php echo $row['id'];?></label></td>
                                <td><?php echo $row['pName']; ?></td>
                                <td><?php echo $row['name'];?></td>
                                <td>
                                	<?php echo $row['isShow']==1?"上架":"下架";?>
                                </td>
                                 <td><?php echo date("Y-m-d H:i:s",$row['pTime']);?></td>
                                  <td><?php echo $row['iPrice'];?>元</td>
                                <td align="center">
                                				<input type="button" value="详情" class="btn" onclick="showDetail(<?php echo $row['id'];?>,'<?php echo $row['pName'];?>')"><input type="button" value="修改" class="btn" onclick="editPro(<?php echo $row['id'];?>)"><input type="button" value="删除" class="btn"onclick="delPro(<?php echo $row['id'];?>)">
					                            <div id="showDetail<?php echo $row['id'];?>" style="display:none;">
					                        	<table class="table" cellspacing="0" cellpadding="0">
					                        		<tr>
					                        			<td width="20%" align="right">商品名称</td>
					                        			<td><?php echo $row['pName'];?></td>
					                        		</tr>
					                        		<tr>
					                        			<td width="20%"  align="right">商品类别</td>
					                        			<td><?php echo $row['name'];?></td>
					                        		</tr>
					                        		<tr>
					                        			<td width="20%"  align="right">商品货号</td>
					                        			<td><?php echo $row['pIndex'];?></td>
					                        		</tr>
					                        		<tr>
					                        			<td width="20%"  align="right">商品数量</td>
					                        			<td><?php echo $row['pNum'];?></td>
					                        		</tr>
					                        		<tr>
					                        			<td  width="20%"  align="right">商品价格</td>
					                        			<td><?php echo $row['mPrice'];?></td>
					                        		</tr>
					                        		<tr>
					                        			<td  width="20%"  align="right">Go价格</td>
					                        			<td><?php echo $row['iPrice'];?></td>
					                        		</tr>
					                        		<tr>
					                        			<td width="20%"  align="right">商品图片</td>
					                        			<td>
					                        			<?php 
					                        			$proImgs=getAllImgByProId($link,$row['id']);
					                        			foreach($proImgs as $img):
					                        			?>
					                        			<img width="100" height="100" src="uploads/<?php echo $img['albumPath'];?>" alt=""/> &nbsp;&nbsp;
					                        			<?php endforeach;?>
					                        			</td>
					                        		</tr>
					                        		<tr>
					                        			<td width="20%"  align="right">是否上架</td>
					                        			<td>
					                        				<?php echo $row['isShow']==1?"上架":"下架";?>
					                        			</td>
					                        		</tr>
					                        		<tr>
					                        			<td width="20%"  align="right">是否热卖</td>
					                        			<td>
					                        				<?php echo $row['isHot']==1?"热卖":"正常";?>
					                        			</td>
					                        		</tr>
					                        	</table>
					                        	<span style="display:block;width:80%; ">
					                        	商品描述<br/>
					                        	<?php echo $row['pDescription'];?>
					                        	</span>
					                        </div>
                                
                                </td>
                            </tr>
                           <?php  endforeach;?>
                           <?php if($totalRows>$pageSize):?>
                            <tr>
                            	<td colspan="7"><?php echo showPage($page, $totalPage,"keywords={$keywords}&order={$order}");?></td>
                            </tr>
                            <?php endif;?>
                        </tbody>
                    </table>
                </div>
<script type="text/javascript">
function showDetail(id,t){
	$("#showDetail"+id).dialog({
		  height:"auto",
	      width: "auto",
	      position: {my: "center", at: "center",  collision:"fit"},
	      modal:false,
	      draggable:true,
	      resizable:true,
	      title:"商品名称："+t,
	      show:"slide",
	      hide:"explode"
	});
}
	function addPro(){
		window.location='addPro.php';
	}
	function editPro(id){
		window.location='editPro.php?id='+id;
	}
	function delPro(id){
		if(window.confirm("您确认要删除吗？")){
			window.location="doAdminAction.php?act=delPro&id="+id;
		}
	}
	function search(){
		if(event.keyCode==13){
			//alert("press");
			var val=document.getElementById("search").value;
			window.location="listPro.php?keywords="+val;
		}
	}
	function searchbtn(){
		var val=document.getElementById("search").value;
		window.location="listPro.php?keywords="+val;
	}
	function change(val){
		window.location="listPro.php?order="+val;
	}
</script>
</body>
</html>