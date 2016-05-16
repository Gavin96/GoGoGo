<!-- There are there pages about the shopping card(This is the second page)
        this page for :
          ...Checking the buying goods;
                      the address be transed;
                      the way customer paid.
-->
<?php

require_once '../include.php';
$link = connect();
if(isset($_SESSION['userName']))
{
    $sql = "select * from go_cart where userName = '{$_SESSION['userName']}' and isCommit = 0";
    $cartRows=getResultNum($link,$sql);
    $carts=getCommittedCartByUser($link,$_SESSION['userName']);
}elseif(isset($_COOKIE['userName']))
{
    $sql = "select * from go_cart where userName = '{$_COOKIE['userName']}' and isCommit = 0";
    $cartRows=getResultNum($link,$sql);
    $carts=getCommittedCartByUser($link,$_COOKIE['userName']);
}
$totalPrice = 0;
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Goods Checking</title>
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

<div class="hr_25"></div>
<form action="" method="POST">
    <div class="shoppingCart comWidth">
        <div class="shopping_item">
            <h3 class="shopping_tit">收货地址</h3>
            <div class="shopping_cont padding_shop">
                <ul class="shopping_list">
                    <li><span class="shopping_list_text"><em>*</em>选择地区：</span>
                        <div class="select">
                            <select name="area" style="border: #CCC solid 1px;">
                                <option value="闵行区">闵行区</option>
                                <option value="嘉定区">嘉定区</option>
                                <option value="静安区">静安区</option>
                                <option value="杨浦区">杨浦区</option>
                            </select>
                        </div>
                    </li>
                    <li><span class="shopping_list_text"><em>*</em>详细地址：</span><input type="text" value="最多输入20个汉字" class="input input_b"></li>
                    <li><span class="shopping_list_text"><em>*</em>收 货 人：</span><input type="text" value="最多10个" class="input"></li>
                    <li><span class="shopping_list_text"><em>*</em>手	机：</span><input type="text" value="如：12312312" class="input"><span class="cart_tel">&nbsp;或固定电话：</span><input type="text" class="input input_s"><span class="jian">-</span><input type="text" class="input input_s2"><span class="jian">-</span><input type="text" class="input input_s2"></li>
                    <li><input type="button" class="affirm"></li>
                </ul>
            </div>
        </div>
        <div class="hr_25"></div>
        <div class="shopping_item">
            <h3 class="shopping_tit">支付方式</h3>
            <div class="shopping_cont padding_shop">
                <ul class="shopping_list">
                    <li><input type="radio" class="radio" id="r1"><label for="r1">线上支付</label></li>
                    <li><input type="radio" class="radio" id="r2"><label for="r2">货到付款</label></li>
                </ul>
            </div>
        </div>
        <div class="hr_25"></div>
        <div class="shopping_item">
            <h3 class="shopping_tit">送货清单<a href="doUserAction.php?act=modifyCart" class="backCar">返回购物车修改</a></h3>
            <?php
                foreach($carts as $cart):
                    $pro = getProById($link,$cart["proID"]);
                if(($pro&&is_array($pro))):
                    $proImg = getProImgById($link,$pro["id"]);
            ?>
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
                        <div class="cart_item t_price"><?php echo $pro['iPrice'];?>元</div>
                        <div class="cart_item t_return">0元</div>
                        <div class="cart_item t_num"><?php echo $cart['amount'];?></div>
                        <div class="cart_item t_subtotal t_red"><?php $totalPrice+=$cart['amount']*$pro['iPrice'];echo $cart['amount']*$pro['iPrice'];?>元</div>
                    </div>
                    <div class="cart_message">
                        
                    </div>

            </div>
        </div>

        <div class="hr_25"></div>

        <?php
            endif;
            endforeach;
        ?>

        <div class="shopping_item">
            <h3 class="shopping_tit">订单结算</h3>
            <div class="shopping_cont padding_shop clearfix">
                <div class="cart_count fr">
                    <div class="cart_rmb">
                        <i>总计：</i><span><?php echo $totalPrice;?>元</span>

                    </div>
                    <div class="cart_btnBox">
                        <input type="button" class="cart_btn" value="提交订单">
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>
<div class="hr_25"></div>





</body>
</html>