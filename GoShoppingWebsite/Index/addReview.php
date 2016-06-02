<!-- 评论发布界面 -->
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/10
 * Time: 10:28
 */

require_once '../include.php';
$link = connect();

$proID = null;
if(isset($_GET["proID"]))
	$proID=$_GET["proID"];

$loggedUserName = getUserName();
$cartRows = getCartNum($link);

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>首页</title>
<link href="style/reset.css" rel="stylesheet" type="text/css">
<link href="style/main.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div class="headerBar">
		<div class="topBar">
			<div class="comWidth">
				<div class="leftArea">
					<B> <a href="index.php" class="collection"><img src="images/icon/collection.png">Crazy shopping</a></B>
				</div>
				<div class="rightArea">
					<B><em>欢迎您
							<?php
							echo $loggedUserName;
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

		<div class="comment">
			<div class="textline">
				评价商品
			</div>
			<form action="doUserAction.php" method="post">
			<div class="pingjia">
				<div class="pingji">评级：</div>
				
				<ul>
					<li class="xuanze1"><input type="radio" name="score" value="5"> 非常满意</li>
					<li class="xuanze"><input type="radio" name="score" value="4">满意</li>
					<li class="xuanze"><input type="radio" name="score" value="3">一般</li>
					<li class="xuanze"><input type="radio" name="score" value="2">不满意</li>
					<li class="xuanze"><input type="radio" name="score" value="1">非常不满意</li>
				</ul>
			</div>
			<div class="commenttext">
				<div class="pingji">评价：</div>
				<!-- <input type="text" name="comments" class="text" /> -->
				<textarea rows="3" cols="20" class="text" name="review" placeholder="亲，您的评价对我们非常重要！"></textarea>
				<div>
					<input type="hidden" name="userName" value="<?php echo $loggedUserName;?>">
					<input type="hidden" name="proID" value="<?php echo $proID;?>">
					<input type="hidden" name="act" value="addReview">
					<button class="submit">发 布</button>
					<button class="back">返 回</button>
				</div>
			</div>
			</form>
		</div>

</body>

</html>