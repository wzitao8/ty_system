<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

    <div class="form-inline">
        <label for="exampleInputEmail1">UserName</label>
        <input type="text" class="form-control" id="username" placeholder="用户名">
    </div>
    <div class="form-inline">
        <label for="exampleInputEmail1">Email</label>
        <input type="email" class="form-control" id="email" placeholder="邮箱">
    </div>
    <div class="form-inline">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="pwd" placeholder="密码">
    </div>


    <button id="btn" class="btn btn-default">注册</button>

</body>
</html>
<script src="/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
    $(function () {
        $('#btn').click(function () {
            var username=$('#username').val();
            var email=$('#email').val();
            var pwd=$('#pwd').val();
            // console.log(username);
            $.post(
                "http://pass.1810shop.com/user/regdo",
                {username:username,email:email,pwd:pwd},
                function(res){
                    console.log(res);
                    // if ('res'==2) {
                    //     alert('注册失败');
                    // }else{
                    //     alert('注册成功');
                    // }
                }
            );
        })
    })
</script>