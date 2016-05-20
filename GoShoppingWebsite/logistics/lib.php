<?php
/**
 * Created by PhpStorm.
 * User: wx
 * Date: 2016/5/20
 * Time: 16:36
 */
require_once '../include.php';

function login(){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $verify = $_POST['verify'];
    $verify1 = $_SESSION['verify'];
    if(isset($_POST['autoFlag']))
        $autoFlag = $_POST['autoFlag'];
    $link = connect();
    if($verify==$verify1){
        $sql = "select * from go_admin where username='{$username}' and password='{$password}'";
        $result = checkAdmin($link,$sql);
        if($result&&$result['admType'] == 2) {
            $_SESSION['adminName'] = $result['username'];
            $_SESSION['adminId'] = $result['id'];
            if (isset($autoFlag) && $autoFlag == 1) {
                setcookie("adminId", $result['id'], time() + 7 * 24 * 3600);
                setcookie("adminName", $result['username'], time() + 7 * 24 * 3600);
            }
            echo "<script>window.location='index.php';</script>";
        }else{
            alertMes("登录失败，重新登录","login.php");
        }
    }else{
        alertMes("验证码错误","login.php");
    }
}

function logout2(){
    $_SESSION=array();
    if(isset($_COOKIE[session_name()])){
        setcookie(session_name(),"",time()-1);
    }
    if(isset($_COOKIE['adminId'])){
        setcookie('adminId',"",time()-1);
    }
    if(isset($_COOKIE['adminName'])){
        setcookie('adminName',"",time()-1);
    }
    session_destroy();
    header("location:login.php");

}

function finishCart($id){
    $link = connect();
    $sql = "update go_cart set isCommit=5 where id ={$id}";
    $url = "index.php";
    if(mysqli_query($link,$sql))
        echo '<script>alert("提交成功！");location.href="'.$url.'"</script>';
    else
        echo '<script>alert("修改失败！");location.href="'.$url.'"</script>';
}