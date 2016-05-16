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

//得到用户的所有未收货订单，此时isCommit = 2
//得到用户的所有收货订单，此时isCommit = 3
function getOrderByUser($link,$userName){

    $sql="select * from go_cart where userName = '{$userName}' and isCommit = 2
          union select * from go_cart where userName = '{$userName}' and isCommit = 3";
    $rows=fetchAll($link,$sql);
    
    return $rows;
}

//isCommit=0,表示商品加入购物车
//isCommit=1,表示商品已经生成待提交订单
function getCartByUser($link,$userName){

    $sql="select * from go_cart where userName = '{$userName}' and isCommit = 0";
    $rows=fetchAll($link,$sql);

    return $rows;
}

function getCommittedCartByUser($link,$userName){

    $sql="select * from go_cart where userName = '{$userName}' and isCommit = 1";
    $rows=fetchAll($link,$sql);

    return $rows;
}

function modifyCart(){
    $link=connect();
    clearUnSubmitCart($link);
    header("location:listCart.php");
}

//商品添加进购物车
function addCart($userName,$proID,$isCommit=0,$amount=0){
    if($userName=="none")
        alertMes("请先登录","login.php");
    else {
        $link = connect();
        if ($isCommit == 0) {


            $arr['userName'] = $userName;
            $arr['proID'] = $proID;
            $arr['amount'] = 0;
            $arr['isCommit'] = $isCommit;
            $insertId = insert($link, "go_cart", $arr);
            if ($insertId > 0) {
                $mes = "添加成功!<br/><a href='index.php'>回到首页</a>";
                header("location:listCart.php");
            } else {
                $mes = "添加失败!<br/><a href='index.php'>回到首页</a>";
            }
        }elseif($isCommit == 1){
            clearUnSubmitCart($link);
            $res=checkCartExist($link,$userName,$proID);
            if($res){

                $arr['isCommit'] = $isCommit;
                $arr['amount'] = $amount;
                $where=" userName='{$userName}' and proID={$proID}";
                $rows=update($link,"go_cart",$arr,$where);
                //$mes="here";
                header("location:CheckCart.php");
            }else{
                $arr['userName'] = $userName;
                $arr['proID'] = $proID;
                $arr['amount'] = $amount;
                $arr['isCommit'] = $isCommit;
                $insertId = insert($link, "go_cart", $arr);
                if ($insertId > 0) {
                    $mes = "添加成功!<br/><a href='index.php'>回到首页</a>";
                    header("location:CheckCart.php");
                } else {

                    $mes = "添加失败!<br/><a href='index.php'>回到首页</a>";
                }
            }
        }
        return $mes;

    }
}

//将iscommit=1但为提交订单的cart，isCommit设为0
function clearUnSubmitCart($link){
    $arr['isCommit'] = 0;
    $where=" isCommit=1";
    $rows=update($link,"go_cart",$arr,$where);
}

function checkCartExist($link,$userName,$proID){
    $sql="select * from go_cart where userName='{$userName}' and proID={$proID}";

    $rows=fetchAll($link,$sql);
    return $rows;
}

function delCart($userName,$proID){
    $link = connect();

    $where="proID=".$proID." and userName='{$userName}'";

    if(delete($link,"go_cart",$where)){
        //$mes="删除成功!<br/><a href='listCart.php'>查看购物车</a>";
        header("location:listCart.php");
    }else{
        $mes="删除失败！<br/><a href='listCart.php'>请重新操作</a>";
    }
    return $mes;

}

function delOrder($userName,$proID){
    $link = connect();

    $where="proID=".$proID." and userName='{$userName}'";

    if(delete($link,"go_cart",$where)){
        header("location:order.php");
    }else{
        $mes="删除失败！<br/><a href='order.php'>请重新操作</a>";
    }
    return $mes;

}