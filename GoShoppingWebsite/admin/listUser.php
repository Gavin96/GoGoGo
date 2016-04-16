<?php
require_once '../include.php';
$link = connect();
$rows=getAllUser($link);
if(!$rows){
    alertMes("sorry,没有用户,请添加!","addUser.php");
    exit;
}
ob_clean();
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>-.-</title>
    <link rel="stylesheet" href="../../../GoGoGo/GoShoppingWebsite/admin/styles/backstage.css">
</head>

<body>
<div class="details">
    <div class="details_operation clearfix">
        <div class="bui_select">
            <input type="button" value="添&nbsp;&nbsp;加" class="add"  onclick="addUser()">
        </div>

    </div>

    <table class="table" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th width="15%">编号</th>
            <th width="20%">用户名称</th>
            <th width="20%">用户邮箱</th>
            <th width="20%">是否激活</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php  foreach($rows as $row):?>
            <tr>
                <td><label for="c1" class="label"><?php echo $row['id'];?></label></td>
                <td><?php echo $row['username'];?></td>
                <td><?php echo $row['email'];?></td>
                <td>
                    <?php
                    echo $row['activeFlag']==0?"未激活":"激活";
                    ?>
                </td>
                <td align="center">
                    <input type="button" value="修改" class="btn"  onclick="editUser(<?php echo $row['id'];?>)">
                    <input type="button" value="删除" class="btn"  onclick="delUser(<?php echo $row['id'];?>)">
                </td>
            </tr>
        <?php endforeach;?>
        <!--        全局变量，定义在admin.inc.php中-->
        </tbody>
    </table>
</div>
</body>
<script type="text/javascript">

    function addUser(){
        window.location="../../../GoGoGo/GoShoppingWebsite/admin/addUser.php";
    }

    function editUser(id) {
        window.location="editUser.php?id="+id;
    }
    function delUser(id){
        if(window.confirm("您确定要删除吗？删除之后不可以恢复!")){
            window.location="doAdminAction.php?act=delUser&id="+id;
        }
    }
</script>
</html>