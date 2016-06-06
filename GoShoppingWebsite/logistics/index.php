<?php
require_once '../include.php';
if(!isset($_SESSION['admin2Id'])&&$_COOKIE['admin2Id']==""){
    alertMes("请先登录","login.php");
}
$link = connect();
$sql="select c.id,c.name,p.pName,c.add_district,c.add_detail,c.phoneNumber from go_cart as c join go_product as p where c.proID=p.id and c.isCommit=4 ";
$totalRows=getResultNum($link,$sql);
$pageSize=2;
$totalPage=ceil($totalRows/$pageSize);
$page=isset($_REQUEST['page'])?(int)$_REQUEST['page']:1;
if($page<1||$page==null||!is_numeric($page))$page=1;
if($page>$totalPage)$page=$totalPage;
$offset=($page-1)*$pageSize;
$sql="select c.id,c.name,p.pName,c.add_district,c.add_detail,c.phoneNumber from go_cart as c join go_product as p where c.proID=p.id and c.isCommit=4 limit {$offset},{$pageSize}";
$rows=array();
if($totalPage!=0)
    $rows=fetchAll($link,$sql);

$Dname[1]='闵行';
$Dname[2]='嘉定';
$Dname[3]='静安';
$Dname[4]='杨浦';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Insert title here</title>
    <link rel="stylesheet" href="../admin/styles/backstage.css">
</head>
<body>
<div class="head">
    <div class="logo fl"><a href="#"></a></div>
    <h3 class="head_text fr">GOGO购物流管理系统</h3>
</div>
<div class="operation_user clearfix">

    <div class="link fr">
        <b>欢迎您
            <?php
            if(isset($_SESSION['admin2Name'])){
                echo $_SESSION['admin2Name'];
            }elseif(isset($_COOKIE['admin2Name'])){
                echo $_COOKIE['admin2Name'];
            }
            ?>

        </b>&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php" class="icon icon_i">首页</a>
        
        <span></span><a href="doLogAction.php?act=logout" class="icon icon_e">退出</a>

    </div>
</div>

<div class="details">
    <div class="details_operation clearfix">
    </div>

    <table class="table" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th>编号</th>
            <th>商品名称</th>
            <th>收货人姓名</th>
            <th>地址</th>
            <th>电话</th>
            <th>订单状态</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php  foreach($rows as $row):?>
            <tr>
                <td><?php echo $row['id'];?></td>
                <td><?php echo $row['pName'];?></td>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $Dname[$row['add_district']];?>&nbsp;<?php echo $row['add_detail'];?></td>
                <td><?php echo $row['phoneNumber'];?></td>
                <td>已发送</td>
                <td align="center">
                    <input type="button" value="完成订单" class="btn" onclick="finishCart(<?php echo $row['id'];?>)">
                </td>
            </tr>
        <?php endforeach;?>
        <?php if($totalRows>$pageSize):?>
            <tr>
                <td colspan="6"><?php echo showPage($page, $totalPage);?></td>
            </tr>
        <?php endif;?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    function finishCart(id){
        if(window.confirm("您确定要完成订单吗？")){
            window.location="doLogAction.php?act=finishCart&id="+id;
        }
    }
    function reload(){
        window.frames.mainFrame.location.reload();
    }
    function back(){
        window.frames.mainFrame.history.back();
    }
    function forward(){
        window.frames.mainFrame.history.forward();
    }
</script>
</body>
</html>