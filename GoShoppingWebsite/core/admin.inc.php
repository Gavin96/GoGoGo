<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/3
 * Time: 11:10
 */
function checkAdmin($link,$sql){
    return fetchOne($link,$sql);
}

function checkLogined(){
    if($_SESSION['adminId']==""){
        alertMes("请先登录","login.php");
    }
}

function logout(){
    $_SESSION=array();
    if(isset($_COOKIE[session_name()])){
        setcookie(session_name(),"",time()-1);
    }
    session_destroy();
    header("location:login.php");

}