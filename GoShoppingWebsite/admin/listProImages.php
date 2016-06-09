<?php
require_once '../include.php';
checkLogined();
$link = connect();
$rows=getProInfo($link);
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>-.-</title>
    <link rel="stylesheet" href="styles/backstage.css">
    <link rel="stylesheet" href="scripts/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
    <script src="scripts/jquery-ui/js/jquery-1.10.2.js"></script>
    <script src="scripts/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
    <script src="scripts/jquery-ui/js/jquery-ui-1.10.4.custom.min.js"></script>
</head>

<body>
<div id="showDetail"  style="display:none;">

</div>
<div class="details">

    <!--表格-->
    <table class="table" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th width="10%">编号</th>
            <th width="10%">商品名称</th>
            <th width="20%">图片</th>
            <th width="10%">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($rows as $row):?>
            <tr>
                <!--这里的id和for里面的c1 需要循环出来-->
                <td><label for="c1" class="label"><?php echo $row['Pid'];?></label></td>
                <td><?php echo $row['pName']; ?></td>
                <td >
                    <img width="50" height="50" src="../image_220/<?php echo $row['albumPath']?>" alt=""/> &nbsp;&nbsp;
                </td>
                <td align="center">
                    <input type="button" value="添加文字水印" class="btn"  onclick="doImg1(<?php echo $row['id'];?>)">
<!--                    <input type="button" value="添加图片水印" class="btn"  onclick="doImg2()">-->
                </td>

            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>
<script type="text/javascript">

    function doImg1(id) {
        window.location="doAdminAction.php?act=waterText&id="+id;
    }
    function doImg2(id) {
        window.location="doAdminAction.php?act=waterPic&id="+id;
    }

</script>
</body>
</html>