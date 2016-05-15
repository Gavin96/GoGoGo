

<?php

require_once '../include.php';
$link = connect();

if(isset($_SESSION['userName']))
{
    $sql = "select * from go_cart where userName = '{$_SESSION['userName']}'";
    $cartRows=getResultNum($link,$sql);
    $orders=getOrderByUser($link,$_SESSION['userName']);
}elseif(isset($_COOKIE['userName']))
{
    $sql = "select * from go_cart where userName = '{$_COOKIE['userName']}'";
    $cartRows=getResultNum($link,$sql);
    $orders=getOrderByUser($link,$_COOKIE['userName']);
}else
{
    alertMes("请先登录","login.php");
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Shop Cards</title>
    <link href="style/reset.css" rel="stylesheet" type="text/css">
    <link href="style/main.css" rel="stylesheet" type="text/css">
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
                <li><a href="index.php">首页</a></li>
                <li><a href="discount.php">优惠</a></li>
                <li><a href="hot.php">热销</a></li>
                <li><a href="#">健康知识</a></li>
                <li><a href="#">质量管控</a></li>
                <li><a href="order.php">订单中心</a></li>
            </ul>

        </div>
    </div>
</div>


<div class="shoppingCart comWidth">
    <div class="shopping_item">
        <h3 class="shopping_tit">我的订单</h3>
        <div class="shopping_cont pb_10">
            <div class="cart_inner">

            </div>
        </div>
    </div>
</div>

<?php
foreach($orders as $order):
    $pro = getProById($link,$order["proID"]);
    if(($pro&&is_array($pro))):
        $proImg = getProImgById($link,$pro["id"]);
        ?>

        <div class="shoppingCart comWidth">
            <div class="shopping_item">
                <div class="shopping_cont pb_10">
                    <div class="cart_inner">
                        <div class="cart_head clearfix">
                            <div class="cart_item t_name">商品名称</div>
                            <div class="cart_item t_price">单价</div>
                            <div class="cart_item t_return">返现</div>
                            <div class="cart_item t_num">数量</div>
                            <div class="cart_item t_subtotal">小计</div>
                        </div>
                        <div class="cart_cont clearfix">
                            <div class="cart_item t_name">
                                <div class="cart_shopInfo clearfix">
                                    <img height="95" width="95" src="../image_220/<?php echo $proImg["albumPath"]?>" alt="">
                                    <div class="cart_shopInfo_cont">
                                        <p class="cart_link"><a href="#"><?php echo $pro['pName'];?></a></p>
                                        <p class="cart_info"><?php echo $pro['pDescription'];?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="cart_item t_price">
                                $ <?php echo $pro['iPrice'];?>
                            </div>
                            <div class="cart_item t_return"> $0</div>
                            <div class="cart_item t_num">1</div>
                            <div class="cart_item t_subtotal t_red">$500</div>
                        </div>
                        <div class="cart_message">
                            若有问题请留言，若有问题请留言

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    endif;
endforeach;
?>

<div class="cart_btnBox">
    <input type="button" class="cart_btn" value="确认提交">
</div>
</body>
</html>