
<?php

require_once '../include.php';
$link = connect();
$pro = null;
if(isset($_GET["id"]))
	$pro=getProById($link,$_GET["id"]);
$userName = getUserName();
$cartRows = getCartNum($link);
$orders=getOrderByUser($link,$userName);
if($userName==null){
	$userName="none";
}
else{
	clearUnSubmitCart($link,$userName);
}
?>



<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>产品详情</title>
<link href="style/reset.css" rel="stylesheet" type="text/css">
<link href="style/main.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="JS/goodsNum.js"></script>
<script src="JS/jquery-2.2.3.min.js"></script>
</head>

<body class="grey">
<div class="headerBar">
	<div class="topBar">
		<div class="comWidth">
			<div class="leftArea">
				<B> <a href="index.php" class="collection"><img src="images/icon/collection.png">Crazy shopping</a></B>
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
					&nbsp;<a href="doUserAction.php?act=logout">[退出]</a></B>
			</div>
		</div>
	</div>
	<div class="logoBar">
		<div class="comWidth">
			<div class="logo fl">
				<a href="index.php"><img src="images/icon/Fruits_Vegetable.png" alt="有机食品销售"></a>
			</div>
			<div class="search_box fl">
				<span class="search_glass fl" > </span>
				<form action="product.php" method="post">
					<input type="text" name="product_name" class="search_text fl">
					<input type="submit" value="搜 索" class="search_btn fr">
				</form>
			</div>
			<div class="shopCar fr">
				<span class="shopText fl"><a href="listCart.php">购物车</a></span>
				<span class="shopNum fl"><?php echo $cartRows; ?></span>
			</div>
		</div>
	</div>
	<div class="navBox">
		<div class="comWidth"  style="width:800px;">
			<div class="shopClass fl">
				<h3 ><i></i></h3>

			</div>
			<ul class="nav fl">
				<li><a href="index.php" class="active">首页</a></li>
				<li><a href="discount.php">优惠</a></li>
				<li><a href="hot.php">热销</a></li>
				<li><a href="health.php">健康知识</a></li>
				<li><a href="quality.php">质量管控</a></li>
				<li><a href="listOrder.php">订单中心</a></li>
			</ul>

		</div>
	</div>
</div>

	<div class="userPosition comWidth">
		<span>当前位置:</span>
		<strong><a href="index.php">&nbsp;首页</a></strong>
		<span>&nbsp;&gt;&nbsp;</span>
		<a href="cateDetail.php?CId=<?php echo $pro['cId']; ?>"><?php echo $pro['name'];?></a>
		<span>&nbsp;&gt;&nbsp;</span>
		<a href="goodsDetail.php?id=<?php echo $pro['id']; ?>"><?php echo $pro['pName'];?></a>
	</div>

<!-- <div class="border"> -->
    <div class="description_info comWidth">
    	<div class="description clearfix">
    	    <div class="leftArea">
    		  <div class="description_imgs">
				  <?php
				  	$proImgs = getAllProImgById($link,$pro["id"]);
				  ?>
    			<div class="big">
    			  <img height="280" width="240" src="../image_220/<?php echo $proImgs[0]['albumPath'];?>" alt="">
    		    </div>
    		    <ul class="des_smimg clearfix">
				<?php
					foreach($proImgs as $proImg):
				?>
    		     <li class="photo_list"><a href="#" onmouseover="changePhoto(this)"><img src="../image_50/<?php echo $proImg['albumPath'];?>" class="active"  alt=""></a></li>
    		     <?php
				 	endforeach;
				 ?>
    		    </ul>
    	      </div>
            </div>           
    		<form action="doUserAction.php" method="post">
    	      <div class="rightArea">
    	         <div class="des_content">
    	         <div class="dise">

					 <div class="dl clearfix">
						 <div class="dt k1">商品名称：</div>
						 <div class="dd clearfix"><?php echo $pro['pName'];?></div>
					 </div>

    	         	<div class="dl clearfix">
    	         		<div class="dt k1">Go价格：</div>
    	         		<div class="dd"><span class="des_money"><em>¥</em>&nbsp;<?php echo $pro['iPrice'];?></span></div>
    	         	</div>

					 <div class="dl clearfix">
						 <div class="dt k1">市场价：</div>
						 <div class="dd"><span class="des_money"><s><em>¥</em>&nbsp;<?php echo $pro['mPrice'];?></span></s></div>
					 </div>

    	         	<div class="dl clearfix">
    	         		<div class="dt k1">优惠：</div>
    	         		<div class="dd clearfix">暂无</div>
    	         	</div>

					 <div class="dl clearfix">
						 <div class="dt k1">简介：</div>
						 <div class="dd clearfix"><?php echo $pro['pDescription'];?></div>
					 </div>

    	         	<div class="des_position">
    	         	    <div class="dl clearfix">
    	         			<div class="dt k1">库存：</div>
    	         			<div class="dd clearfix"><?php echo $pro['pNum'];?>件<span class="theGoods"></span></div>
    	         		</div>
<!--    	         		<div class="dl clearfix">-->
<!--    	         			<div class="dt colorSelect">选择颜色：</div>-->
<!--    	         			<div class="dd">-->
<!--    	         			   <div class="des_item des_item_active">-->
<!--    	         			   	白色-->
<!--    	         			   </div>-->
<!--    	         			   <div class="des_item">-->
<!--    	         			   	黑色-->
<!--    	         			   </div>-->
<!--    	         			   <div class="des_item">-->
<!--    	         			   	银色-->
<!--    	         			   </div>-->
<!--    	         			</div>-->
<!--    	         		</div>-->
<!--    	         		<div class="dl clearfix">-->
<!--    	         			<div class="dt typeSelect">选择规格：</div>-->
<!--    	         			<div class="dd1">-->
<!--    	         			   <div class="des_item des_item_sm des_item_active">-->
<!--    	         			   	WIFI 16GB-->
<!--    	         			   </div>-->
<!--    	         			   <div class="des_item des_item_sm">-->
<!--    	         			   	WIFI 16GB + 3G-->
<!--    	         			   </div>-->
<!--    	         			   <div class="des_item des_item_sm">-->
<!--    	         			   	WIFI 32GB-->
<!--    	         			   </div>-->
<!--    	         			   <div class="des_item des_item_sm">-->
<!--    	         			   	WIFI 32GB + 3G-->
<!--    	         			   </div>-->
<!--    	         			   <div class="des_item des_item_sm">-->
<!--    	         			   	WIFI 64GB-->
<!--    	         			   </div>-->
<!--    	         			   <div class="des_item des_item_sm">-->
<!--    	         			   	WIFI 64GB + 3G-->
<!--    	         			   </div>-->
<!--    	         			</div>-->
<!--    	         		</div>-->


						<input class="total_amount_left" type="hidden" value="<?php echo $pro['pNum'];?>">
    	         		<div class="dl clearfix">
    	         			<div class="dt des_num">已选择数量：</div>
    	         			<div class="dd dd2 clearfix">
    	         				<div class="des_number">
    	         					<div class="reduction"><span onclick="decrease2(this)" >-</span></div>
    	         					<div class="des_input">
    	         					  <input type="text" name="amount" id="amount" value="0"/>
    	         					</div>
    	         					<div class="plus" ><span onclick="increase2(this)">+</span></div>
    	         				</div>
    	         			</div>
    	         		</div>
    	         	</div>

                </div>
    	         	<div class="des_select">
    	         		已选择 <span><?php echo $pro['pName'];?>：<span class="span_amount">0</span>件</span>
    	         	</div>
    	         	<div class="shop_buy">
    	         		<a href="doUserAction.php?act=addCart&userName=<?php echo $userName;?>&proID=<?php echo $pro['id'];?>" class="shopping_btn"></a>
    	         		<span class="line"></span>

						<input type="hidden" name="act" value="checkCart">
						<input type="hidden" name="userName" value="<?php echo $userName;?>">
						<input type="hidden" name="proID" value="<?php echo $pro['id'];?>">
						<button type="submit" class="buy_btn" style="border:none;">
					</div>

    	         </div>
    	      </div>
			</form>

        </div>
	</div>


<div class="hr_15"></div>

<div class="des_info comWidth clearfix">
	<div class="leftArea">
		<div class="recommend">
			<h3 class="tit">类似产品</h3>

			<?php
				$similarPros = getSimilarProByCId($link,$pro["cId"],$pro['id']);
				if(($similarPros&&is_array($similarPros))):
					foreach($similarPros as $similarPro):
						$similarProImg = getProImgById($link,$similarPro["id"]);
			?>
			<div class="item">
				<div class="item_cont">
					<div class="img_item">
						<a href="goodsDetail.php?id=<?php echo $similarPro['id'];?>"><img  height="180" width="187" src="../image_220/<?php echo $similarProImg['albumPath'];?>"></a>
					</div>
					<center>
					<p><a href="#"><?php echo $similarPro['pName'];?></a></p>
					<p class="money"><?php echo $similarPro['iPrice'];?>元</p>
					</center>
				</div>
			</div>
			<?php
				endforeach;
				endif;
			?>

			<h3 class="tit2">推荐一下</h3>
			<?php
			    $recommendPros = getRecommendPro($link);
				if(($recommendPros&&is_array($recommendPros))):
					foreach($recommendPros as $recommendPro):
						$recommendProImg = getProImgById($link,$recommendPro["id"]);
			?>
			<div class="item">
				<div class="item_cont">
					<div class="img_item">
						<a href="goodsDetail.php?id=<?php echo $recommendPro['id'];?>"><img  height="180" width="187" src="../image_220/<?php echo $recommendProImg['albumPath'];?>"></a>
					</div>
					<center>
						<p><a href="#"><?php echo $recommendPro['pName'];?></a></p>
						<p class="money"><?php echo $recommendPro['iPrice'];?>元</p>
					</center>
				</div>
			</div>
			<?php
				endforeach;
				endif;
			?>
			
		</div>
	</div>
	<div class="rightArea">


		<div class="des_infoContent">
			<h3 class="shopDes_tit">商品评价</h3>
			<div class="score_box clearfix">
				<div class="score">
					<span><?php echo getReviewScoreByPro($link,$pro['id']);?></span><em>分</em>
				</div>
				<div class="score_speed">

					<ul class="score_speed_text" >
						<li class="speed_01">非常不满意</li>
						<li class="speed_02">不满意</li>
						<li class="speed_03">一般</li>
						<li class="speed_04">满意</li>
						<li class="speed_05">非常满意</li>
					</ul>
					<div class="score_num0">
						0.0分
					</div>
					<div class="score_num">
						5.0分
					</div>
					<p>共有<?php echo getReviewNumByPro($link,$pro['id']);?>位顾客参与此项评分</p>
				</div>

			</div>
		</div>
		<div class="hr_15"></div>
		<div class="des_infoContent">
			<ul class="des_tit">
				<li class="active"><span class="a">商品评价</span> </li>
<!--				<li class="x"><span class="b">商品评价(10001)</span> </li>-->
			</ul>

			<div class="ad">
				<a href="#"><img src="images/banner/ad.jpg"></a>
			</div>
			<div class="info_text">

				<?php
					$reviews = getAllReviewsByPro($link,$pro['id']);
					if(($reviews&&is_array($reviews))):
						foreach($reviews as $review):

				?>
				<div class="info_tit">
					<div style="float:left;"><h3><?php echo $review['userName'];?></h3></div>
					<div style="float:left;"><h4><?php echo number_format($review['score'],1);?>分</h4></div>
					<div style="float:right;"><h4><?php echo $review['reviewTime'];?></h4></div>

				</div>
				<p>
					<?php echo $review['review'];?>
				</p>
				<div class="hr_45"></div>
				<?php
					endforeach;
					endif;
				?>

			</div>
		</div>






	</div>
</div>


<div class="hr_15" style="clear:both;"></div>
<!-- <div> -->
<div class="footer" style="margin-top:100px;">
	<p><a href="#">Go简介</a><i>|</i><a href="#">招贤纳士</a><i>|</i><a href="#">联系我们</a><i>|</i>客服热线：021-8888-8888</p>
	<p>Copyright &copy; 2016 - 2020 同济大学版权所有</p>
	<p class="weblogo">
	   <br/> <br/>
	   <a href="#"><img src="images/banner/weblogo.png" alt="logo"></a>&nbsp;
<!--    	   <a href="#"><img src="images/banner/weblogo.png" alt="logo"></a>&nbsp;-->
<!--           <a href="#"><img src="images/banner/weblogo.png" alt="logo"></a>&nbsp;-->
<!--           <a href="#"><img src="images/banner/weblogo.png" alt="logo"></a>-->
   </p>

</div>

</body>

</html>