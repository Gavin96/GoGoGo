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
    <title>健康知识</title>
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
                <li><a href="health.php" class="active">健康知识</a></li>
                <li><a href="quality.php">质量管控</a></li>
                <li><a href="listOrder.php">订单中心</a></li>
            </ul>

        </div>
    </div>
</div>



<div class="Intro2">
    <div class="comWidth">
        <div class="head">
            <div class="ID">健康的水果和蔬菜</div>
        </div>
        <div class="mainbody1">
            <div class="title">&nbsp&nbsp水果：</div>
            <a class="img1"> <img src="images/about/fruit.jpg" width="755" height="450"> </a>
            <div class="content">
                > 龙眼、荔枝要适量：
                龙眼、荔枝性温，食之过多则生热上火，因此身体热盛者、阴虚火旺者切勿多吃，多吃会导致牙龈肿痛出血、鼻衄。严重的会患上人们常见的所谓“荔枝病”。 <br>
                > 梨子、柚子不是人人能吃 
                其性寒，食之过多则伤阳气，身体阳虚、畏寒肢冷者、腹胃虚弱者、产妇不宜多吃或者最好不吃。 <br>
                > 西瓜：
                西瓜是夏季消暑良品，但是糖尿病患者和易胀气的人禁吃西瓜。西瓜和许多含糖量高的水果是在肠内而不是在胃里消化的。因此当西瓜与那些需要用唾液和胃进行消化的食品一起食用时，西瓜就会在胃中很快被分解，然后开始发酵并形成气体，使人感到胃胀不舒服。由于上述原因，西瓜应当与其他食品分开吃、空腹吃或者食用其他食品两个小时后再吃。 <br>
                > 香蕉：
                畏寒体弱和胃虚的人不适宜于吃香蕉。因为香蕉在胃肠中消化得很慢，对胆囊不好。
            </div>
        </div>
        <div class="mainbody2">
            <div class="title">&nbsp&nbsp蔬菜：</div>
            <a class="img2"> <img src="images/about/vegetable.jpg" width="755" height="420"> </a>
            <div class="content">
                > 有机蔬菜的营养价值比普通蔬菜的高？<br>
                &nbsp&nbsp有机蔬菜在干物质含量、维生素C和粗纤维的含量上高于普通蔬菜。有专家对来自北京4个有机蔬菜种植基地的5种菜品进行了营养分析，有的蔬菜维生素C含量高于普通蔬菜，有的低于普通蔬菜；有机蔬菜的粗蛋白和粗纤维表现低于普通蔬菜；有些有机蔬菜的钙、镁、磷、钾高于普通蔬菜，但同种蔬菜的不同栽培会对这些宏量元素产生影响；在这次试验中，5种有机蔬菜的铁、锌、锰、铜都低于普通同种蔬菜。<br>
                &nbsp&nbsp由此可见，有机蔬菜的营养价值与普通蔬菜差不太多，蔬菜的营养成分与环境、气候、土壤、栽培技术和品种有很大关系。也有专家认为有机蔬菜的微量元素的结构合理，营养更均衡，所以好吃。<br>

                > 有机蔬菜与常规蔬菜的区别<br>
                &nbsp&nbsp1.转换期<br>
                &nbsp&nbsp有机蔬菜一年生蔬菜至少需要经过2年的转换期，多年生蔬菜需要经过3年的转换期。而常规蔬菜不需要转换期。
                <br>
                &nbsp&nbsp2.隔离<br>
                &nbsp&nbsp如果有机蔬菜生产基地中有的地块有可能受到邻近常规地块污染的影响，则必须在有机和常规地块之间设置缓冲带或物理障碍物，保证有机地块不受污染。 缓冲带上种植的植物不能认证为有机产品。有机蔬菜必须边界清晰，与常规地块之间有明显的界限。<br>
                &nbsp&nbsp3.认证方式<br>
                &nbsp&nbsp绿色、无公害标准是对产品进行认证； 有机标准是对地块和过程进行认证。<br>
                &nbsp&nbsp> 有机蔬菜的市场前景<br>
                &nbsp&nbsp随着人们生活水平的日益提高，对健康和环保的认识不断增强，人们对有机产品的消费也越来越迫切。根据中国产业信息网发布的《2011-2015年中国无公害蔬菜市场及前景预测报告》以后有机蔬菜的市场需求会逐年加大，它会逐渐替代普通蔬菜成为日常蔬菜消费的主流。<br>
                &nbsp&nbsp> 有机蔬菜为什么价格高？<br>
                &nbsp&nbsp这是因为<br>
                &nbsp&nbsp（1）有机食品在其生产加工过程中绝对禁止使用农药、化肥、激素等人工合成物质，并
                且不允许使用基因工程技术；而其他食品则允许有限使用这些技术，且不禁止基因工程技术的使用。如绿色食品对基因工程和辐射技术的使用就未作规定。<br>
                &nbsp&nbsp（2） 生产转型方面，从生产其他食品到有机食品需要2－3年的转换期，而生产其他食品（包括绿色食品和无公害食品）没有转换期的要求。<br>
                &nbsp&nbsp（3）数量控制方面，有机食品的认证要求定地块、定产量，而其他食品没有如此严格的要求。
                因此，生产有机食品要比生产其他食品难得多，需要建立全新的生产体系和监控体系，
                采用相应的病虫害防治、地力保护、种子培育、产品加工和储存等替代技术。<br>
            </div>
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