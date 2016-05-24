
<?php

require_once '../include.php';
$link = connect();
$pro = null;
if(isset($_GET["id"]))
	$pro=getProById($link,$_GET["id"]);
if(isset($_SESSION['userName']))
{
	$userName = $_SESSION['userName'];
	$sql = "select * from go_cart where userName = '{$_SESSION['userName']}' and isCommit = 0";
	$cartRows=getResultNum($link,$sql);
	$orders=getOrderByUser($link,$_SESSION['userName']);
}elseif(isset($_COOKIE['userName']))
{
	$userName = $_COOKIE['userName'];
	$sql = "select * from go_cart where userName = '{$_COOKIE['userName']}' and isCommit = 0";
	$cartRows=getResultNum($link,$sql);
	$orders=getOrderByUser($link,$_COOKIE['userName']);
}else
{
	$userName="none";
	$cartRows=0;
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
				<li><a href="#">健康知识</a></li>
				<li><a href="#">质量管控</a></li>
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
		<a href="goodsDetail.php?id=$pro['id']"><?php echo $pro['pName'];?></a>
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
    		     <li><a href="#"><img src="../image_50/<?php echo $proImg['albumPath'];?>" class="active"  alt=""></a></li>
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
    	         		<div class="dt k1">价格：</div>
    	         		<div class="dd"><span class="des_money"><em>¥</em><?php echo $pro['iPrice'];?></span></div>
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
    	         					  <input type="text" name="amount" id="amount" value="1"/>
    	         					</div>
    	         					<div class="plus" ><span onclick="increase2(this)">+</span></div>
    	         				</div>
    	         			</div>
    	         		</div>
    	         	</div>

                </div>
    	         	<div class="des_select">
    	         		已选择 <span><?php echo $pro['pName'];?>：<span class="span_amount">1</span>件</span>
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
			<ul class="des_tit">
				<li class="active"><span class="a">产品介绍</span> </li>
				<li class="x"><span class="b">商品评价(10001)</span> </li>
			</ul>

			<div class="ad">
				<a href="#"><img src="images/banner/ad.png"></a>
			</div>
			<div class="info_text">
				<div class="info_tit">
					<h3>强烈推荐</h3><h4>吹一波</h4>
				</div>
				<p>&nbsp&nbsp5月12日，美国正式启动在罗马尼亚南部德韦塞卢空军基地部署的反导系统，并随时准备与北约在欧洲的反导系统并网接轨。13日，美又在波兰破土动工东欧第二处反导系统陆基站点，该项建设任务预计将于2018年底全面完工。

					虽然北约秘书长斯托尔滕贝格等多位高级官员宣称反导系统并非针对俄罗斯，但消息一经播出立即在俄国内激起千层浪。俄外交部发言人扎哈罗娃在新闻发布会上对北约此举表达强烈抗议。此前俄战略火箭部队司令卡拉卡耶夫5月10日表示，针对美国现有和未来布设的反导系统，俄将采取包括换装、研制新型导弹在内的多种反制手段加以应对。</p>
				<div class="hr_45"></div>
				<div class="info_tit">
					<h3>强烈推荐</h3><h4>吹一波</h4>
				</div>
				<p>&nbsp&nbsp5月12日，美国正式启动在罗马尼亚南部德韦塞卢空军基地部署的反导系统，并随时准备与北约在欧洲的反导系统并网接轨。13日，美又在波兰破土动工东欧第二处反导系统陆基站点，该项建设任务预计将于2018年底全面完工。

					虽然北约秘书长斯托尔滕贝格等多位高级官员宣称反导系统并非针对俄罗斯，但消息一经播出立即在俄国内激起千层浪。俄外交部发言人扎哈罗娃在新闻发布会上对北约此举表达强烈抗议。此前俄战略火箭部队司令卡拉卡耶夫5月10日表示，针对美国现有和未来布设的反导系统，俄将采取包括换装、研制新型导弹在内的多种反制手段加以应对。</p>
				<div class="hr_45"></div>
			</div>
		</div>

		<div class="hr_15"></div>
		<div class="des_infoContent">
			<h3 class="shopDes_tit">商品评价</h3>
			<div class="score_box clearfix">
				<div class="score">
					<span>4.7</span><em>分</em>
				</div>
				<div class="score_speed">
					<ul class="score_speed_text">
						<li class="speed_01">非常不满意</li>
						<li class="speed_02">不满意</li>
						<li class="speed_03">一般</li>
						<li class="speed_04">满意</li>
						<li>非常满意</li>
					</ul>
					<div class="score_num">
						4.7<i></i>
					</div>
					<p>共有1999位顾客参与此项评分</p>
				</div>

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