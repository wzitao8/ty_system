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

</body>
</html>
<script type="text/javascript">
    function doExchange(arr){
        var len = arr.length;
        // 当数组大于等于2个的时候
        if(len >= 2){
            // 第一个数组的长度
            var len1 = arr[0].length;
            // 第二个数组的长度
            var len2 = arr[1].length;
            // 2个数组产生的组合数
            var lenBoth = len1 * len2;
            //  申明一个新数组
            var items = new Array(lenBoth);
            // 申明新数组的索引
            var index = 0;
            for(var i=0; i<len1; i++){
                for(var j=0; j<len2; j++){
                    if(arr[0][i] instanceof Array){
                        items[index] = arr[0][i].concat(arr[1][j]);
                    }else{
                        items[index] = [arr[0][i]].concat(arr[1][j]);
                    }
                    index++;
                }
            }
            var newArr = new Array(len -1);
            for(var i=2;i<arr.length;i++){
                newArr[i-1] = arr[i];
            }
            newArr[0] = items;
            return doExchange(newArr);
        }else{
            return arr[0];
        }
    }

    //
    var arr = [['蓝色','黄色','白色','黑色'], [36,37,38,39,40], ['男士','女士'],['衬衫','裤子','鞋子']];
    var arr1 = [['a','b','c']];
    console.log(doExchange(arr));
</script>