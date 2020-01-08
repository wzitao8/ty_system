<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>用户注册</h2>
    <form action="/login/regdo" method="post" enctype="multipart/form-data">
        <table>
        <tr>
            <td>用户名</td>
            <td> <input type="text" name="username" ></td>
        </tr>
        <tr>
            <td>密码</td>
            <td><input type="password" name="pwd" id=""></td>
        </tr>
        <tr>
            <td>email</td>
            <td><input type="email" name="email" id=""></td>
        </tr>
        <tr>
            <td>电话</td>
            <td><input type="text" name="tel" id=""></td>
        </tr>
        <tr>
            <td>上传身份证</td>
            <td><input type="file" name="photo" id=""></td>
        </tr>
            <tr>
                <td align=""><input type="submit" value="点击注册"></td>
            </tr>
        </table>
    </form>
</body>
</html>