<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/10
 * Time: 10:28
 */

require_once '../include.php';
$link = connect();
$cates=getAllCate($link);
if(!($cates&&is_array($cates))){
	alertMes("sorry,网站维护中!","login.php");
	exit;
}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>首页</title>
<link href="style/reset.css" rel="stylesheet" type="text/css">
<link href="style/main.css" rel="stylesheet" type="text/css">
<script language="JavaScript">

</script>
</head>

<body>
	<div class="headerBar">
		<div class="topBar">
			<div class="comWidth">
			    <div class="leftArea">
				 <B> <a class="collection"><img src="images/icon/collection.png">Crazy shopping</a></B>
			    </div>
			    <div class="rightArea">
			    	<B><em>欢迎您
							<?php
							if(isset($_SESSION['userName'])){
								echo $_SESSION['userName'];
							}elseif(isset($_COOKIE['userName'])){
								echo $_COOKIE['userName'];
							}
							?>
						</em></B>
			    	<B>
						<?php
							if(!(isset($_SESSION['userName'])||isset($_COOKIE['userName']))):
						?>
						<a href="login.php">[登录]</a>
						<?php
							endif
						?>
						&nbsp<a href="doUserAction.php?act=logout">[退出]</a></B>
			    </div>
			</div>
		</div>
		<div class="logoBar">
			<div class="comWidth">
				<div class="logo fl">
					<a href="#"><img src="images/icon/Fruits_Vegetable.png" alt="有机食品销售"></a>
			    </div>
			<div class="search_box fl">
                  <span class="search_glass fl" > </span>
				  <form action="cateDetail.php" method="post">
				  <input type="text" class="search_text fl">
				  <input type="submit" value="搜 索" class="search_btn fr">
				  </form>
			    </div>  
			    <div class="shopCar fr">
				<span class="shopText fl"><a href="#">购物车</a></span>
				<span class="shopNum fl">0</span>
				</div>
			</div>
		</div>
		<div class="navBox">
			<div class="comWidth">
				<div class="shopClass fl">
					<h3>全部商品分类<i></i></h3>
					<div class="shopClass_show">
						<?php  foreach($cates as $cate):?>
						<dl class="shopClass_item">
							<dt><a href="cateDetail.php?CId=<?php echo $cate["id"]; ?>" class="b"><?php echo $cate['name'];?></a> </dt>
<!--						    <dd><a href="#">单反</a> <a href="#">四旋螺翼</a></dd>-->
						</dl>
						<?php endforeach;?>
					</div>
				</div>
				<ul class="nav fl">
					<li><a href="#" class="active">首页</a></li>
					<li><a href="discount.php">优惠</a></li>
					<li><a href="hot.php">热销</a></li>
					<li><a href="#">健康知识</a></li>
					<li><a href="#">质量管控</a></li>
					<li><a href="#">名品会</a></li>
				</ul>

			</div>
		</div>
	</div>

	<div class="banner comWidth clearfix">
		<div class="banner_bar banner_big">
			<ul class="imgBox">
				<li><a href="#"><img src="images/banner/banner_01.png" alt="banner"></a></li>
				<li><a href="#"><img src="images/banner/banner_02.png" alt="banner"></a></li>
			</ul>
			<div class="imgNum">
				<a href="#" class="active"></a> <a href="#"></a>
			</div>
		</div>
	</div>

	<?php  foreach($cates as $cate):?>

	<div class="shopTit comWidth">
		<span class="icon"> </span><h3><?php echo $cate['name'];?></h3>
		<a href="cateDetail.php?CId=<?php echo $cate["id"]; ?>" class="more">更多&gt;&gt;</a>
	</div>
	<div class="shopList comWidth clearfix">
		<div class="leftArea">
         <div class="banner_bar banner_sm">
			<ul class="imgBox">
				<li><a href="#"><img src="images/banner/banner_sm_01.png" alt="banner"></a></li>
				<li><a href="#"><img src="images/banner/banner_sm_02.png" alt="banner"></a></li>
			</ul>
			<div class="imgNum">
				<a href="#" class="active"></a> <a href="#"></a>
			</div>
		</div>
        </div>
        <div class="leftArea2">
         	<div class="shopList_top clearfix">
				<?php
					$pros = getProByCId($link,$cate["id"]);
					if(($pros&&is_array($pros))):
						foreach($pros as $pro):
							$proImg = getProImgById($link,$pro["id"]);
				?>
         		<div class="shop_item">
         			<div class="shop_img">
         				<a href="#"><img height="200" width="187" src="../image_220/<?php echo $proImg["albumPath"]?>" alt=""></a>
         			</div>
         			<h3><?php echo $pro['pName'];?></h3>
         			<p><?php echo $pro['iPrice'];?>元</p>

         		</div>
         		<?php
					endforeach;
					endif;
				?>
         	</div>

         	<div class="shopList_sm clearfix">
				<?php
					$pros_small = getSmallProByCId($link,$cate["id"]);
					if(($pros_small&&is_array($pros_small))):
						foreach($pros_small as $pro_small):
							$proSmallImg = getProImgById($link,$pro_small["id"]);
				?>
         		<div class="shopItem_sm">
         			<div class="shopItem_smImg">
         				<a href="#"><img height="95" width="95" src="../image_220/<?php echo $proSmallImg["albumPath"]?>" alt=""></a>
         			</div>
         			<div class="shopItem_text">
         				<p><?php echo $pro_small['pName'];?></p>
         				<h3>￥<?php echo $pro_small['iPrice'];?>.00</h3>
         			</div>
         		</div>
				<?php
					endforeach;
					endif;
				?>
         		

         	</div>
        </div>
	</div>
	<br/>
	<?php endforeach;?>



	

    <div class="footer">
    	<p><a href="#">同济大学</a><i>|</i><a href="#">软件学院</a><i>|</i><a href="#">2013级</a><i>|</i><a href="#">专业综合</a></p>
    	<p>BlaBlaBlaBlaBlaBlaBlaBlaBlaBlaBlaBlaBla</p>
    	<p class="weblogo">
    	   <br/> <br/>
    	   <a href="#"><img src="images/banner/weblogo.png" alt="logo"></a>&nbsp;
    	   <a href="#"><img src="images/banner/weblogo.png" alt="logo"></a>&nbsp;
           <a href="#"><img src="images/banner/weblogo.png" alt="logo"></a>&nbsp;
           <a href="#"><img src="images/banner/weblogo.png" alt="logo"></a>
       </p>

    </div>

</body>

</html>