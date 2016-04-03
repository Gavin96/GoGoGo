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
    if(!isset($_SESSION['adminId'])&&$_COOKIE['adminId']==""){
        alertMes("请先登录","login.php");
    }

}

function logout(){
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

function addAdmin(){
    $link = connect();
    $arr = $_POST;
    //删除以post方式提交的act
    unset($arr['act']);
    if(insert($link,"go_admin",$arr)){
        $mes = "添加成功!<br/><a href='addAdmin.php'>继续添加</a>|<a href='listAdmin.php'>查看管理员列表</a>";
    }else{
        $mes = "添加失败!<br/><a href='addAdmin.php'>重新添加</a>";
    }
    return $mes;
}

function getAllAdmin($link){

    $sql="select id,username from go_admin order by id";
    $rows=fetchAll($link,$sql);
    return $rows;
}




function delAdmin($id){
    $link = connect();
    if(delete($link,"go_admin","id={$id}")){
        $mes="删除成功!<br/><a href='listAdmin.php'>查看管理员列表</a>";
    }else{
        $mes="删除失败!<br/><a href='listAdmin.php'>请重新删除</a>";
    }
    return $mes;
}