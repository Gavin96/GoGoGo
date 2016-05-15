<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/12
 * Time: 9:43
 */
require_once '../include.php';
function logoutUser(){
    $_SESSION=array();
    if(isset($_COOKIE[session_name()])){
        setcookie(session_name(),"",time()-1);
    }
    if(isset($_COOKIE['userId'])){
        setcookie('userId',"",time()-1);
    }
    if(isset($_COOKIE['userName'])){
        setcookie('userName',"",time()-1);
    }
    session_destroy();
    header("location:index.php");

}

function registerUser()
{

    $link = connect();
    $arr = $_POST;

    $arr['regTime']=time();
    $uploadFile = uploadFile("../uploads");
    if ($uploadFile&&is_array($uploadFile)) {
        $arr['face'] = $uploadFile[0]['name'];
    }
    else
        return "注册失败<a href='register.php'>重新注册</a> ";
    unset($arr['act']);

    $insertId = insert($link,"go_user",$arr);
    if($insertId>0){
        require("../lib/smtp.php");
        $smtpserver = "smtp.163.com";
        $smtpserverport = 25;
        $smtpusermail = "wlmxjm@163.com";
        $smtpemailto = $arr['email'];
        $smtpuser = "wlmxjm";//SMTP服务器的用户帐号
        $smtppass = "tongji2016"; //SMTP服务器的用户密码
        $mailsubject = "用户帐号激活";
        $mailbody = "亲爱的".$arr['username']."：
        感谢您在我站注册了新帐号。
        请点击链接激活您的帐号。
        http://localhost/GoGoGo/GoShoppingWebsite/admin/doAdminAction.php?act=verify&verify=".$insertId."
        如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问，该链接24小时内有效。";//邮件内容;
        $mailtype = "HTTP";
        $smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);
        $smtp->debug = false;
        $smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype);

        $mes = "添加成功!请登录到邮箱及时激活帐号！<br/><a href='login.php'>登录</a>";
    }else{
        $filename="../uploads/".$uploadFile[0]['name'];
        if(file_exists($filename)){
            unlink($filename);
        }
        $mes = "注册失败!<br/><a href='register.php'>重新注册</a>";
    }
    return $mes;
}

function getCartByUser($link,$userName){

    $sql="select * from go_cart where userName = '{$userName}'";
    $rows=fetchAll($link,$sql);

    //$sql="select p.id,p.pName,p.pIndex,p.pNum,p.mPrice,p.iPrice,p.pDescription,p.pTime,p.isShow,p.isHot,c.name,p.cId from go_product as p join go_cate c on p.cId=c.id where p.cId={$rows["proID"]}";
    //$cart=fetchAll($link,$sql);
    return $rows;
}

function getCommittedCartByUser($link,$userName){

    $sql="select * from go_cart where userName = '{$userName}' and isCommit = 1";
    $rows=fetchAll($link,$sql);

    return $rows;
}

function modifyCart(){
    $link=connect();
    $arr["isCommit"]=0;
    $arr["amount"]=0;
    $rows=update($link,"go_cart",$arr);
    header("location:listCart.php");
}

//商品添加进购物车
function addCart(){
    $link = connect();
    $arr = $_POST;
    unset($arr['act']);
    $insertId = insert($link,"go_cart",$arr);
    if($insertId>0){
        $mes = "添加成功!<br/><a href='index.php'>回到首页</a>";
    }else{
        $mes = "添加失败!<br/><a href='index.php'>回到首页</a>";
    }
    return mes;
}

function delCart($user,$proID){
    $link = connect();


    $where="proID=".$proID." and user=".$user;
    if(delete($link,"go_cart",$where)){
        $mes="删除成功!<br/><a href='listCart.php'>查看购物车</a>";
    }else{
        $mes="删除失败！<br/><a href='listCart.php'>请重新操作</a>";
    }
    return $mes;

}