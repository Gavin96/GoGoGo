

<?php

require_once '../include.php';
$link = connect();

if(isset($_SESSION['userName']))
{
    $userName = $_SESSION['userName'];
    $sql = "select * from go_cart where userName = '{$_SESSION['userName']}' and isCommit = 4";
    $cartRows=getResultNum($link,$sql);
    $orders=getOrderByUser($link,$_SESSION['userName']);
}elseif(isset($_COOKIE['userName']))
{
    $userName = $_COOKIE['userName'];
    $sql = "select * from go_cart where userName = '{$_COOKIE['userName']}' and isCommit = 4";
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
                <li><a href="listOrder.php" class="active">订单中心</a></li>
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
<form action="doUserAction.php" method="post">
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
                                    <a href="goodsDetail.php?id=<?php echo $pro['id'];?>"><img  src="../image_220/<?php echo $proImg["albumPath"]?>" alt=""></a>
                                    <div class="cart_shopInfo_cont">
                                        <p class="cart_link"><a href="#"><?php echo $pro['pName'];?></a></p>
                                        <p class="cart_info"><?php echo $pro['pDescription'];?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="cart_item t_price">
                                 <?php echo $pro['iPrice'];?>元
                            </div>
                            <div class="cart_item t_return"> 0元</div>
                            <div class="cart_item t_num"><?php echo $order['amount']?></div>
                            <div class="cart_item t_subtotal t_red">500元</div>
                        </div>
                        <div class="cart_message">
                           
                            <div class="cart_btnBox">
                                <input type="hidden" name="act" value="manipulateOrder">
                                <input type="hidden" name="userName" value="<?php echo $userName;?>">
                                <input type="hidden" name="proID" value="<?php echo $pro['id'];?>">
                                <input type="submit"  class="cart_btn" name="check" value="查看物流">
                                <input type="submit"  class="cart_btn" name="receive" value="确认收货">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</form>
        <?php
         endif;
         endforeach;
        ?>

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