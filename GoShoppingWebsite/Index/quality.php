<?php
require_once '../include.php';
$link = connect();

$loggedUserName = getUserName();
$cartRows = getCartNum($link);
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>质量管理</title>
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
                    &nbsp<a href="doUserAction.php?act=logout">[退出]</a></B>
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
                <li><a href="index.php">首页</a></li>
                <li><a href="discount.php">优惠</a></li>
                <li><a href="hot.php">热销</a></li>
                <li><a href="health.php">健康知识</a></li>
                <li><a href="quality.php" class="active">质量管控</a></li>
                <li><a href="listOrder.php">订单中心</a></li>
            </ul>

        </div>
    </div>
</div>



<div class="Intro">
    <div class="comWidth">
        <div class="head">
            <div class="ID">GOGO购自有农场</div>
        </div>
        <div class="mainbody1">
            <!-- <div class="text"> -->
            &nbsp&nbsp现在的污染无处不在，城里有噪音雾霾，农村有农药化肥，反正环境是大不如前了。<br>
            &nbsp&nbsp对于农田来说，农药和化肥都是大规模杀伤性武器，它杀灭了虫害病毒，同时也破坏了土地，玷污了作物，最终受伤的还是人类自己。<br>
            &nbsp&nbsp农田干净一点，作物就安全健康一点。所以，支持有机农业的呼声越来越高。在我们的有机农场里进行的正是当下倡导的有机农业。<br><br>
            <!-- </div> -->
            <a class="img1"> <img src="images/about/yard.jpg" width="755" height="350"> </a>
        </div>
        <div class="mainbody2">
            <br>
            <div class="title">&nbsp&nbsp我们的有机农业的优势：</div>
            <br>
            <a class="img2"><img src="images/about/diff.png"></a>
            <br>
            <br>
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
    </p>

</div>

</body>

</html>