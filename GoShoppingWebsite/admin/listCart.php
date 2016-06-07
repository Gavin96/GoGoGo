<?php
require_once '../include.php';
checkLogined();
$link = connect();
$sql="select c.id,userName,p.pName,p.iPrice,c.amount,c.isCommit,c.add_time from go_cart as c join go_product as p where c.proID=p.id and c.isCommit=3";
$totalRows=getResultNum($link,$sql);
$pageSize=2;
$totalPage=ceil($totalRows/$pageSize);
$page=isset($_REQUEST['page'])?(int)$_REQUEST['page']:1;
if($page<1||$page==null||!is_numeric($page))$page=1;
if($page>$totalPage)$page=$totalPage;
$offset=($page-1)*$pageSize;
$sql="select c.id,c.userName,p.pName,p.iPrice,c.amount,c.isCommit,c.add_time from go_cart as c join go_product as p where c.proID=p.id and c.isCommit=3 limit {$offset},{$pageSize}";
$rows=array();
if($totalPage!=0)
    $rows=fetchAll($link,$sql);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Insert title here</title>
    <link rel="stylesheet" href="styles/backstage.css">
</head>
<body>
<div class="details">
    <div class="details_operation clearfix">
    </div>

    <table class="table" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th>编号</th>
            <th>用户名</th>
            <th>商品名</th>
            <th>订单总价</th>
            <th>订单状态</th>
            <th>下单时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php  foreach($rows as $row):?>
            <tr>
                <td><?php echo $row['id'];?></td>
                <td><?php echo $row['userName'];?></td>
                <td><?php echo $row['pName'];?></td>
                <td><?php echo $row['iPrice']*$row['amount'];?></td>
                <td>审核中</td>
                <td><?php echo $row['add_time']?></td>
                <td align="center">
                    <input type="button" value="接受订单" class="btn" onclick="finishCart(<?php echo $row['id'];?>)">
                </td>
            </tr>
        <?php endforeach;?>
        <?php if($totalRows>$pageSize):?>
            <tr>
                <td colspan="4"><?php echo showPage($page, $totalPage);?></td>
            </tr>
        <?php endif;?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    function finishCart(id){        
        if(window.confirm("您确定要接受订单吗？")){
            window.location="doAdminAction.php?act=emitCart&id="+id;
        }
    }
</script>
</body>
</html>