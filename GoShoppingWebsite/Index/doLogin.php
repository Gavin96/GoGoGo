<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/3
 * Time: 10:23
 */
require_once "../include.php";
$email = $_POST['email'];
$password = $_POST['password'];
$verify = $_POST['verify'];
$verify1 = $_SESSION['verify'];
if(isset($_POST['autoFlag']))
    $autoFlag = $_POST['autoFlag'];
$link = connect();
if($verify==$verify1){
    $sql = "select * from go_user where email='{$email}' and password='{$password}'";
    $result = checkUser($link,$sql);
    if($result){
        $_SESSION['userName'] = $result['username'];
        $_SESSION['userId'] = $result['id'];
        if($autoFlag){
            setcookie("userId",$result['id'],time()+7*24*3600);
            setcookie("userName",$result['username'],time()+7*24*3600);
        }
        echo "<script>window.location='index.php';</script>";
    }else{
        alertMes("登录失败，重新登录","login.php");
    }
}else{
    alertMes("验证码错误","login.php");
}