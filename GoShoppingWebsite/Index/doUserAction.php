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
}elseif($act=="checkCart"){  //在商品详情页选择购买
    if($_REQUEST['amount']==0){
        echo "<script>alert('商品数量不能为零!');history.go(-1);</script>";

    }else
        $mes=addCart($_REQUEST['userName'],$_REQUEST['proID'],1,$_REQUEST['amount']);

}elseif($act=="modifyCart"){
    modifyCart();
}elseif($act=="commitCart"){
    commitCart($_REQUEST['proID'],$_REQUEST['amount']);
}elseif($act=="manipulateCart"){
    
    if(isset($_POST['delete']))
        $mes=delCart($_REQUEST['userName'],$_REQUEST['proID']);
    elseif(isset($_POST['purchase']))
        $mes=addCart($_REQUEST['userName'],$_REQUEST['proID'],1,$_REQUEST['number1']);
}elseif($act=="manipulateOrder"){
    if(isset($_POST['check']))
    {
        header("location:listOrder.php");
    }
    elseif(isset($_POST['receive']))
        $mes=delOrder($_REQUEST['userName'],$_REQUEST['proID']);
}elseif($act=="addReview"){
    $mes = addReview($_REQUEST['userName'],$_REQUEST['proID'],$_REQUEST['review'],$_REQUEST['score']);
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