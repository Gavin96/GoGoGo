<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/3
 * Time: 10:23
 */
require_once "../include.php";
$username = $_POST['username'];
$password = $_POST['password'];
$verify = $_POST['verify'];
$verify1 = $_SESSION['verify'];
$link = connect();
if($verify==$verify1){
    $sql = "select * from go_admin where username='{$username}' and password='{$password}'";
    $result = checkAdmin($link,$sql);
    if($result){
        $_SESSION['adminName'] = $result['username'];
        $_SESSION['adminId'] = $result['id'];
        alertMes("登陆成功","index.php");
    }else{
        alertMes("登录失败，重新登录","login.php");
    }
}else{
    alertMes("验证码错误","login.php");
}
