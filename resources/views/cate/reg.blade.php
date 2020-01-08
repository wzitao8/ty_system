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
    <h2>注册</h2>
    <form action="#">
        <b>邮箱</b>
        <input type="text" id="email"><br/>
        <b>密码</b>
        <input type="text" id="pwd"><br/>
        <input type="text">
        <input type="hidden" id = "uid" name = "uid">
        <button id="code">获取验证码</button>
        <br>
        <input type="submit" id="reg" value="点击注册">
    </form>
</body>
</html>
<script src="/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
    $(function(){
        $('#code').click(function(){
            // alert('123');
            var email=$('#email').val();
            // console.log(name);
            $.post(
                "/send",
                {email:email},
                function(res){
                    console.log(res);
            //         if (res==1) {
            //         	alert('登陆失败');
            //         }else{
            //         	alert('登陆成功');
            //         		localStorage.setItem('token',res.data.token);
            //         		localStorage.setItem('id',res.data.id);
            //         		// $r = localStorage.getItem('id')
            //         		// console.log($r);
            //         	location.href = 'http://127.0.0.1:8849/h5/login/new.html?token='+localStorage.getItem('token')+"&id="+localStorage.getItem('id');
            //         }
                }
            )
        });
        $('#reg').click(function(){
            // alert('123');
            var pwd=$('#pwd').val();
            var email=$('#email').val();
            // console.log(pwd);
            // console.log(email);
            $.post(
                "/cate/regDo",
                {email:email,pwd:pwd},
                function(res){
                    console.log(res);
                    if ('res'==2) {
                        alert('注册失败');
                    }else{
                        alert('注册成功');
                        location.href = 'http://pass.1810shop.com/cate/login';
                    }
                }
            );
    });

    })
</script>