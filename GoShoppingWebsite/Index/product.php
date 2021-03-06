<?php

require_once '../include.php';
$link = connect();

if(isset($_POST["product_name"])) {
    $pros = getAllProByName($link, $_POST["product_name"]);
    $_SESSION['pros'] = $_POST["product_name"];
}elseif(isset($_SESSION['pros'])){
    $pros = getAllProByName($link, $_SESSION['pros']);
}
$loggedUserName = getUserName();
$cartRows = getCartNum($link);
$orders=getOrderByUser($link,$loggedUserName);
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
    <div class="navBox">
        <div class="comWidth"  style="width:800px;">
            <div class="shopClass fl">
                <h3><i style="background: url()"></i></h3>

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




<div class="shopList comWidth clearfix" >

<div class="leftArea2" style="width:1000px;overflow:visible;height:auto;border:none;">
    <div class="shopList_top clearfix">
        <?php
        
        if(($pros&&is_array($pros))):
            foreach($pros as $pro):
                $proImg = getProImgById($link,$pro["id"]);
                ?>
                <div class="shop_item" style="margin-left: 40px;margin-top:15px;border:#999 solid 1px;">
                    <div class="shop_img">
                        <a href="goodsDetail.php?id=<?php echo $pro['id'];?>"><img height="200" width="187" src="../image_220/<?php echo $proImg["albumPath"]?>" alt=""></a>
                    </div>
                    <h3><?php echo $pro['pName'];?></h3>
                    <p><?php echo $pro['iPrice'];?>元</p>

                </div>
                <?php
                     endforeach;
                     endif;
                ?>
    </div>
</div>

</div>

<div style="clear:both"></div>





<div class="footer" style="margin-top:100px;">
    <p><a href="#">Go简介</a><i>|</i><a href="#">招贤纳士</a><i>|</i><a href="#">联系我们</a><i>|</i>客服热线：021-8888-8888</p>
    <p>Copyright &copy; 2016 - 2020 同济大学版权所有</p>
    <p class="weblogo">
        <br/> <br/>
        <a href="#"><img src="images/banner/weblogo.png" alt="logo"></a>&nbsp;
<!--        <a href="#"><img src="images/banner/weblogo.png" alt="logo"></a>&nbsp;-->
<!--        <a href="#"><img src="images/banner/weblogo.png" alt="logo"></a>&nbsp;-->
<!--        <a href="#"><img src="images/banner/weblogo.png" alt="logo"></a>-->
    </p>

</div>

</body>

</html>