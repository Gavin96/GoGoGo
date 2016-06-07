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
    <div class="details_operation clearfix">
        <div class="bui_select">
            <input type="button" value="添&nbsp;&nbsp;加" class="add" onclick="addPro()">
        </div>
        <div class="fr">
            <div class="text">
                <span>商品价格：</span>
                <div class="bui_select">
                    <select id="" class="select" onchange="change(this.value)">
                        <option>-请选择-</option>
                        <option value="iPrice asc" >由低到高</option>
                        <option value="iPrice desc">由高到底</option>
                    </select>
                </div>
            </div>
            <div class="text">
                <span>上架时间：</span>
                <div class="bui_select">
                    <select id="" class="select" onchange="change(this.value)">
                        <option>-请选择-</option>
                        <option value="pTime desc" >最新发布</option>
                        <option value="pTime asc">历史发布</option>
                    </select>
                </div>
            </div>
            <div class="text">

                <input type="text" value="" class="search"  id="search" onkeypress="search()" >
                <input type="button" value="搜索" class="btn" onclick="searchbtn()">
            </div>
        </div>
    </div>
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
                <td><input type="checkbox" id="c<?php echo $row['Pid'];?>" class="check" value=<?php echo $row['Pid'];?>><label for="c1" class="label"><?php echo $row['Pid'];?></label></td>
                <td><?php echo $row['pName']; ?></td>
                <td>
                    <img width="100" height="100" src="..\image_800\<?php echo $row['albumPath']?>" alt=""/> &nbsp;&nbsp;
                </td>
                <td align="center">
                    <input type="button" value="添加文字水印" class="btn"  onclick="doImg1(<?php echo $row['Pid'];?>)">
                    <input type="button" value="添加图片水印" class="btn"  onclick="doImg2(<?php echo $row['Pid'];?>)">
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