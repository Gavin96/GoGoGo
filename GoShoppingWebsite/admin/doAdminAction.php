<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/3
 * Time: 13:03
 */
require_once "../include.php";
ob_clean();
$act = $_REQUEST['act'];
if($act=="logout"){
    logout();
}elseif($act=="addAdmin"){
    $mes = addAdmin();
}elseif($act=='delAdmin'){
    $mes = delAdmin($_REQUEST['id']);
}elseif($act=="addCate"){
    $mes=addCate();
}elseif($act=="delCate"){
    $mes = delCate($_REQUEST['id']);
}elseif($act=="addPro"){
    $mes=addPro();
}elseif($act=="editPro"){
    $mes=editPro($_REQUEST['id']);
}elseif($act=="delPro"){
    $mes=delPro($_REQUEST['id']);
}elseif($act=="addUser"){
    $mes=addUser();
}elseif($act=='delUser'){
    $mes = delUser($_REQUEST['id']);
}elseif($act=='editUser'){
    $mes = editUser($_REQUEST['id']);
}elseif($act=='verify'){
    $mes = verify($_REQUEST['verify']);
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
