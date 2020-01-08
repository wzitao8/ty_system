<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>table模块快速使用</title>
    <link rel="stylesheet" href="/layui/css/layui.css" media="all">
</head>
<body>

{{--<form class="layui-form">--}}
商品名称：
<div class="layui-input-inline">
    <input type="text" name="goods_name" id="goods_name" placeholder="请输入关键字" autocomplete="off" class="layui-input">
</div>

<button class="layui-btn" lay-submit lay-filter="formDemo" id="demo1">点击搜索</button>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
商品筛选
<div class="layui-input-inline">
    <button class="layui-btn"  id="new" value="1">新品</button>
    <button class="layui-btn" id="hots" value="2">精品</button>
</div>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


{{--</form>--}}
{{--<from>--}}
<table width="700" height="150" border="1" cellpadding="0" cellspacing="0">
    <tr>
        <td>ID</td>
        <td>商品名称</td>
        <td>商品价格</td>
        <td>商品类型</td>
        <td>商品时间</td>
        <td>操作</td>
    </tr>
    @foreach ($data as $v)
        <input type="hidden" class="ppp" name="{{$v->is_new}}">
        <tr>
            <td id="">{{$v->goods_id}}</td>
            <td>{{$v->goods_name}}</td>
            <td>{{$v->self_price}}</td>
            <td class="hst">@if($v->is_new==1)
                    <b>新品</b>
                @else
                    <b>精品</b>
                @endif</td>
            <td>{{$v->create_time}}</td>
            <td>
                <a href="#" class="del">删除</a>
                | <a href="">修改</a>
            </td>
        </tr>
    @endforeach
</table>
{{--</from>--}}
{{$data->links()}}
<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>
<script src="/layui/layui.js"></script>
<script src="/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
    $(function () {
        $('#new').click(function () {
            // alert('123');
            var name = $('#new').val();
            // console.log(name);
            $.post(
                "http://pass.1810shop.com/api/new",
                {name:name},
                function(res){
                    // location.replace("http://pass.1810shop.com/api/new");
                    console.log(res);
                }
            );
        });
        $('#hots').click(function () {

            var uname = $('#hots').val();
            // console.log(uname);
            $.post(
                "http://pass.1810shop.com/api/hot",
                {uname:uname},
                function(res){
                    console.log(res);
                }
            );
        })

    })
</script>




</body>
</html>