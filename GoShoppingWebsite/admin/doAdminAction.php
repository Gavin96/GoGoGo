<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/3
 * Time: 13:03
 */
require_once "../include.php";
$act = $_REQUEST['act'];
if($act=="logout"){
    logout();
}elseif($act=="addAdmin"){
    $mes = addAdmin();
}elseif($act=='delAdmin'){
    $mes = delAdmin($_REQUEST['id']);
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
