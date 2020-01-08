<?php
$color = array('蓝色','黄色','白色','黑色');
$size  = array('36','37','38','39','40');
$class = array('男士','女士');
$goods = array('衬衫','裤子','鞋子');
$str = "";
echo "<br/>";
foreach($class as $k=>$v){
    for($i=0;$i<count($color);$i++){
        foreach($goods as $key=>$value){
            foreach($size as $key=>$values){
                $str.= $v.$color[$i].$value.$values."码"."<br/>";
            }
        }
    }
}
echo '<hr>';
print_r($str);
echo '<hr>';

$arr1 = ['blue'=>'蓝色','red'=>'红色','white'=>'白色','pink'=>'粉色'];
$arr2 = ['first'=>'第一个','second'=>'第二个','third'=>'第三个'];
$arr12=[];
foreach ($arr1 as $k=>$v){
    $arr12[$v]=$k;
}
foreach ($arr2 as $k=>$value){
    $arr12[$value]=$k;
}
print_r($arr12);

?>