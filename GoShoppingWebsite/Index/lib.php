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

function getUserName(){
    $userName = null;
    if(isset($_SESSION['userName'])){
        $userName = $_SESSION['userName'];
    }elseif(isset($_COOKIE['userName'])){
        $userName = $_COOKIE['userName'];
    }
    return $userName;
}
function getCartNum($link)
{
    $userName = getUserName();
    if ($userName == null)
        $cartRows = 0;
    else {
        $sql = "select * from go_cart where userName = '{$userName}' and isCommit = 0";
        $cartRows = getResultNum($link, $sql);
    }
    return $cartRows;
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

//得到用户的所有未接受订单，此时isCommit = 3
//得到用户的所有正在发货订单，此时isCommit = 4
//得到用户的所有完成订单，此时isCommit = 5
function getOrderByUser($link,$userName){

    $sql="select * from go_cart where userName = '{$userName}' and (isCommit = 3 or isCommit = 4 or isCommit = 5)";

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
    $rows=fetchOne($link,$sql);

    return $rows;
}

function modifyCart(){
    $link=connect();
    clearUnSubmitCart($link);
    header("location:listCart.php");
}

function commitCart($proID,$amount){
    $link=connect();
    
    $arr["isCommit"] = 3;
    if(isset($_SESSION['userName']))
    {
        $mes = update($link,"go_cart",$arr,"userName='{$_SESSION['userName']}' and isCommit = 1");
    }elseif(isset($_COOKIE['userName']))
    {
        $mes = update($link,"go_cart",$arr,"userName='{$_COOKIE['userName']}' and isCommit = 1");
    }


    updateProAmount($link,$proID,$amount);
    updateIsHot($link,$proID,$amount);
    header("location:listOrder.php");
}

function updateProAmount($link,$proID,$amount){
    $arr = getProById($link,$proID);
    $newAmount = $arr['pNum'] - $amount;
    $row['pNum'] = $newAmount;

    $where=" id={$proID}";
    //echo $newAmount.$proID;
    $rows=update($link,"go_product",$row,$where);
}

function updateIsHot($link,$proID,$amount){
    $arr = getProById($link,$proID);
    $newAmount = $arr['isHot'] + $amount;
    $row['isHot'] = $newAmount;

    $where=" id={$proID}";
    $rows=update($link,"go_product",$row,$where);
}

//商品添加进购物车以及购买
function addCart($userName,$proID,$isCommit=0,$amount=0){
    if($userName=="none")
        alertMes("请先登录","login.php");
    else {
        $link = connect();
        if ($isCommit == 0) {
            $res = checkCartExist($link, $userName, $proID);
            if ($res)
                header("location:listCart.php");
            else {

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
            }
        }elseif($isCommit == 1){
            clearUnSubmitCart($link);
            $res=checkCartExist($link,$userName,$proID);
           // print_r($res);
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
                    //header("location:CheckCart.php");
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
        header("location:review.php?proID={$proID}&userName={$userName}");//转到评价页
    }else{
        $mes= "删除失败！<br/><a href='listOrder.php'>请重新操作</a>";
    }
    return $mes;

}

function getAllReviewsByPro($link,$proID){
    $sql = "select * from go_review where proID = {$proID} order by reviewTime desc";
    $rows = fetchAll($link,$sql);
    return $rows;
}

function getReviewNumByPro($link,$proID){
    $sql = "select * from go_review where proID = {$proID}";
    $num=getResultNum($link,$sql);
    return $num;
}

function getReviewScoreByPro($link,$proID)
{
    $num = getReviewNumByPro($link, $proID);
    $totalScore = 0;
    $rows = getAllReviewsByPro($link, $proID);
    if ($num != 0) {
        foreach ($rows as $row):
            $totalScore = $totalScore + $row['score'];
        endforeach;
        return number_format($totalScore / $num, 1);
    }
    else{
        return 0.0;
    }

}

function addReview($userName,$proID,$review,$score){
    $link = connect();
    $arr['userName'] = $userName;
    $arr['proID'] = $proID;
    $arr['review'] = $review;
    $arr['score'] = $score;
    $arr['reviewTime'] = date("y-m-d h:i:s",time());
    $insertId = insert($link, "go_review", $arr);
    if ($insertId > 0) {
        $mes = "添加成功!<br/><a href='index.php'>回到订单页</a>";
        header("location:listOrder.php");
    } else {
        $mes = "添加失败!<br/><a href='listOrder.php'>回到订单页</a>";
    }
    return $mes;
}