<!doctype html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title>注册</title>
    <link type="text/css" rel="stylesheet" href="../admin/styles/reset.css">
    <link type="text/css" rel="stylesheet" href="../admin/styles/main.css">

</head>

<body>
<div class="headerBar">
    <div class="logoBar login_logo">
        <div class="comWidth">
            <div class="logo fl">
                <a href="#"><img src="../admin/images/logo.png" alt="GoGo购"></a>
            </div>
            <h3 class="welcome_title">欢迎注册</h3>
        </div>
    </div>
</div>

<div class="loginBox">
    <div class="login_cont">
        <form action="doUserAction.php" method="post" enctype="multipart/form-data">
            <ul class="login">
                <input type="hidden" name="act" value="addUser" >
                <li class="l_tit">用户名</li>
                <li class="mb_10"><input type="text"  name="username" placeholder="请输入用户名" class="login_input user_icon"></li>
                <li class="l_tit">密码</li>
                <li class="mb_10"><input type="password"  name="password" placeholder="请输入密码" class="login_input password_icon"></li>
                <li class="l_tit">邮箱</li>
                <li class="mb_10"><input type="text"  name="email" placeholder="请输入email" class="login_input"></li>
                <li class="l_tit">性别</li>
                <li class="mb_10 ">
                    <input type="radio" name="sex" value="1" checked="checked" class="sex" >男
                    <input type="radio" name="sex" value="2" class="sex">女
                    <input type="radio" name="sex" value="3" class="sex">保密
                </li>

                <li class="l_tit">头像</li>
                <li class="mb_10 "><input type="file" name="face"></li>


                <li><input type="submit" value="注册" style="width:309px; height:36px;background-color: #9fa8a3;"></li>
            </ul>
        </form>
    </div>
</div>

<div class="hr_25"></div>
<div class="footer">
    <p><a href="#">Go简介</a><i>|</i><a href="#">Go公告</a><i>|</i> <a href="#">招纳贤士</a><i>|</i><a href="#">联系我们</a><i>|</i>客服热线：021-8888-8888</p>
</div>


</body>
</html>
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/12
 * Time: 12:26
 */