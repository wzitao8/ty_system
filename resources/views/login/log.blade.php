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
{{--<form class="form-horizontal">--}}
    <div class="form-group">
        <label for="inputEmail3"  class="col-sm-2 control-label" >Email</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="account" placeholder="Email">
        </div>
    </div>
    <div class="form-group">
        <label for="inputPassword3"  class="col-sm-2 control-label">Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="password" placeholder="Password">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <label>
                    <input type="checkbox"> Remember me
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button  id="login" class="btn btn-default">Sign in</button>
        </div>
    </div>
{{--</form>--}}

</body>
</html>
<script src="/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
    $(function(){
        $('#login').click(function(){
            // alert('123');
            var name=$('#account').val();
            var pwd=$('#password').val();

            $.post(
                "http://pass.1810shop.com/api/login",
                {name:name,pwd:pwd},
                function(res){
                    console.log(res);
                    // if (res==1) {
                    //     alert('登陆失败');
                    // }else{
                    //     alert('登陆成功');
                        // localStorage.setItem('token',res.data.token);
                        // localStorage.setItem('id',res.data.id);
                        // // $r = localStorage.getItem('token')
                        // // console.log($r);
                        // location.href = 'http://m.cstm.org.cn/index?token='+localStorage.getItem('token')+"&id="+localStorage.getItem('id');
                    // }
                }
            );
        })
    })
</script>