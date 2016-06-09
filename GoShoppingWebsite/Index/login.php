<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>登陆</title>
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
            <h3 class="welcome_title">欢迎登陆</h3>
        </div>
    </div>
</div>

<div class="loginBox">
    <div class="login_cont">
        <form action="doLogin.php" method="post">
            <ul class="login">
                <li class="l_tit">用户邮箱</li>
                <li class="mb_10"><input type="text"  name="email" placeholder="请输入用户邮箱" class="login_input user_icon"></li>
                <li class="l_tit">密码</li>
                <li class="mb_10"><input type="password"  name="password" class="login_input password_icon"></li>
                <li class="l_tit">验证码</li>
                <li class="mb_10"><input type="text"  name="verify" class="login_input password_icon"></li>
                <img src="../admin/getVerify.php" alt="验证码" />
                <li class="autoLogin"><input type="checkbox" id="a1" class="checked" name="autoFlag" value="1"><label for="a1">自动登陆(一周内自动登陆)</label></li>
                <li><input type="submit" value="登录" style="width:309px; height:36px;background-color: #ccc;"></li>
                <br/>
                <li><input type="button" value="注册" style="width:309px; height:36px;background-color: #ccc;" onclick="register()"></li>
            </ul>
        </form>
    </div>
</div>

<div class="hr_25"></div>
<div class="footer">
    <p><a href="#">Go简介</a><i>|</i><a href="#">Go公告</a><i>|</i> <a href="#">招纳贤士</a><i>|</i><a href="#">联系我们</a><i>|</i>客服热线：021-8888-8888</p>
</div>

<script type="text/javascript">

    function register(){
        window.location="register.php";
    }
</script>
</body>
</html>
