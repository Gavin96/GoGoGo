<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Insert title here</title>
</head>
<body>
<h3>添加管理员</h3>
<form action="doAdminAction.php" method="post">
    <table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
<!--        表单无法同时以post get传递参数，采用该方法传递。-->
        <input type="hidden" name="act" value="addAdmin" >
        <tr>
            <td align="right">管理员名称</td>
            <td><input type="text" name="username" placehoder="请输入管理员名称"></td>
        </tr>
        <tr>
            <td align="right">管理员密码</td>
            <td><input type="password" name="password" placehoder="请输入管理员密码"></td>
        </tr>
        <tr>
            <td align="right">管理员类型</td>
            <td>
                <div class="bui_select">
                    <select name="admType" class="select">
                        <option value="1" >网站管理员</option>
                        <option value="2">运输管理员</option>
                    </select>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="添加管理员"></td>
        </tr>
    </table>
</form>

</body>
</html>