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
    <header class="mui-bar mui-bar-nav">
        <h1 class="mui-title">登录</h1>
    </header>
<div class="mui-content">
    <form id='login-form' class="mui-input-group">
        <div class="mui-input-row">
            <label>邮箱</label>
            <input id='email' type="email" placeholder="请输入邮箱">
        </div>
        <div class="mui-input-row">
            <label>密码</label>
            <input id='password' type="password"  placeholder="请输入密码">
        </div>
        <input type="hidden" id='referer' name="referer" value="{{$referer}}">
    </form>

    <div class="mui-content-padded">
        <button id='login' class="mui-btn mui-btn-block mui-btn-primary">登录</button>
        <div class="link-area"><a id='reg' href="reg.html">注册账号</a> <span class="spliter">|</span> <a href="forget_password.html" id='forgetPassword'>忘记密码</a>
        </div>
    </div>
    <div class="mui-content-padded oauth-area">

    </div>
</div>
</body>
</html>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="/layui/layui.js"></script>
<script type="text/javascript">
    layui.use(['layer','form'], function(){
        $('#login').click(function(){
            var email = $('#email').val();
            var passwork = $('#password').val();
            var referer = $('#referer').val();
            console.log(referer);
            if(passwork == ''){
                return layer.msg('密码不能为空',{icon:2});
            }
            if(email ==''){
                return layer.msg('邮箱不能为空',{icon:2});
            }else{
                $.post(
                    "{{url('login/checkEmail')}}",
                    {email:email},
                    function (res) {
                        if(res =='2') {
                            return layer.msg('邮箱账号不存在', {icon: 2});
                        }
                    }
                )
            }
            $.post(
                "{{url('login/loginDo')}}",
                {email:email,passwork:passwork,referer:referer},
                function(res){
                    // console.log(res);
                    if (res =='2') {
                        return layer.msg('请输入正确邮箱密码', {icon: 2});
                        // alert('2');
                    }else{
                        layer.msg('登陆成功', {icon: 1});
                        location.href=res;
                    }

                }
            );

        })
    })
</script>