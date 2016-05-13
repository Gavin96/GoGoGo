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

