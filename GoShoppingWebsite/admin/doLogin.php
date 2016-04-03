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
$autoFlag = $_POST['autoFlag'];
$link = connect();
if($verify==$verify1){
    $sql = "select * from go_admin where username='{$username}' and password='{$password}'";
    $result = checkAdmin($link,$sql);
    if($result){
        $_SESSION['adminName'] = $result['username'];
        $_SESSION['adminId'] = $result['id'];
        if($autoFlag){
            setcookie("adminId",$result['id'],time()+7*24*3600);
            setcookie("adminName",$result['username'],time()+7*24*3600);
        }
        echo "<script>window.location='index.php';</script>";
    }else{
        alertMes("登录失败，重新登录","login.php");
    }
}else{
    alertMes("验证码错误","login.php");
}
