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

function getAdminByPage($page,$pageSize=2){
    $link = connect();
    $sql="select * from go_admin";
    global $totalRows;
    $totalRows=getResultNum($link,$sql);
    global $totalPage;
    $totalPage=ceil($totalRows/$pageSize);
    if($page<1||$page==null||!is_numeric($page)){
        $page=1;
    }
    if($page>=$totalPage)$page=$totalPage;
    $offset=($page-1)*$pageSize;
    $sql="select id,username from go_admin order by id limit {$offset},{$pageSize} ";
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

function addUser()
{
    $link = connect();
    $arr = $_POST;
    $arr['password']=md5($_POST['password']);
    $arr['regTime']=time();
    $uploadFile = uploadFile("../uploads");
    if ($uploadFile&&is_array($uploadFile)) {
        $arr['face'] = $uploadFile[0]['name'];
    }
    else
        return "添加失败<a href='addUser.php'>重新添加</a> ";
    //删除以post方式提交的act
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

        $mes = "添加成功!请登录到邮箱及时激活帐号！<br/><a href='addUser.php'>继续添加</a>|<a href='listUser.php'>查看用户列表</a>";
    }else{
        $filename="../uploads/".$uploadFile[0]['name'];
        if(file_exists($filename)){
            unlink($filename);
        }
        $mes = "添加失败!<br/><a href='addUser.php'>重新添加</a>";
    }
    return $mes;
}

function verify($verify){
    $link = connect();
    $arr['activeFlag']=1;

    if(update($link,"go_user",$arr,"id={$verify}")>0){
        $msg = '激活成功！';
    }else{
        $msg = '已激活！';
    }
    echo $msg;
}

function getAllUser($link){

    $sql="select id,username,email,activeFlag from go_user order by id";
    $rows=fetchAll($link,$sql);
    return $rows;
}

function delUser($id){
    $link = connect();
    $sql="select face from go_user where id = ".$id;
    $row=fetchOne($link,$sql);
    $face=$row['face'];
    if(file_exists("../uploads/".$face)){
        unlink("../uploads/".$face);
    }
    if(delete($link,"go_user","id={$id}")){
        $mes="删除成功!<br/><a href='listUser.php'>查看用户列表</a>";
    }else{
        $mes="删除失败!<br/><a href='listUser.php'>请重新删除</a>";
    }
    return $mes;
}

function editUser($id){
    $arr=$_POST;
    $arr['password']=md5($arr['password']);
    $link=connect();
    if(update($link,"go_user",$arr,"id={$id}")>0){
        $mes="修改成功!<br/><a href='listUser.php'>查看用户列表</a>";
    }else{
        $mes="修改失败!<br/><a href='listUser.php'>请重新修改</a>";
    }
    return $mes;
}