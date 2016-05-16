<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/12
 * Time: 9:44
 */
require_once "lib.php";

$act = $_REQUEST['act'];
if($act=="logout") {
    logoutUser();
}elseif($act=="addUser"){
    $mes=registerUser();
}elseif($act=="addCart"){   //在商品详情页选择加入购物车
    $mes=addCart($_REQUEST['userName'],$_REQUEST['proID']);
}elseif($act="checkCart"){  //在商品详情页选择购买
    $mes=addCart($_REQUEST['userName'],$_REQUEST['proID'],1,$_REQUEST['amount']);
}elseif($act="modifyCart"){
    modifyCart();
}elseif($act="delCart"){
    $mes=delCart($_REQUEST['user'],$_REQUEST['proID']);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Insert title here</title>
</head>
<body>
<?php
if(isset($mes))
    echo $mes;
?>

</body>
</html>