<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\GoodsModel;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
//use Illuminate\Support\Facades\Cookie;
class IndexController extends Controller
{
    //
    public function login(){
        $referer = $_SERVER['HTTP_REFERER'];
        $data = [
            'referer'=>urlencode($referer)
        ];
        return view('login.login',$data);
    }
    public function checkEmail(Request $request){
        $email = $request-> input('email');
//        var_dump($email);
        $a = GoodsModel::where(['user_email'=>$email])->first();
//        var_dump($a);
        if ($a==''){
            echo '2';
        }
    }
    public function loginDo(Request $request){
        $email = $request ->input('email');
        $passwork = $request ->input('passwork');
        $referer = $request -> input('referer');
//        dd($referer);
        $where=[
            'user_email'=>$email
        ];
        $a = GoodsModel::where($where)->first();
        if($a) {
            if (password_verify($passwork, $a->user_pwd)) {
                //执行登录
                setcookie('user_id',$a->user_id,time()+3600,'/','1810shop.com',false,true);
                setcookie('rand',mt_rand(1111,9999),time()+3600,'/','1810shop.com',false,true);
                //页面回跳
//                header("Refresh:2,url=".urldecode($request['referer']));
//                echo '登录成功，正在跳转';
                return urldecode($referer);
            } else {
                echo '2';
            }
        }
    }

    public function text(){
        echo '123';
        $oid = '1810a_'.mt_rand(111111,999999);
        $send = [
          'oid' =>$oid,
            'order_name' =>'测试号',
            'add_time' =>time(),
        ];
//        print_r($send);
        ksort($send);
//        print_r($send);
        $str = '';
        foreach ($send as $k=>$v){
            $str .= $k . '=' .$v .'&';
        }
        $stringSignTemp = $str . 'key='.$oid;      //拼接key
        echo '待签名字符串: '. $stringSignTemp;echo '</br>';

        // 3做签名  strtoupper(md5($stringSignTemp))
        $sign = strtoupper(md5($stringSignTemp));       //签名值
        echo '签名： '.$sign;echo '</br>';

        $send_data['sign'] = $sign;
        echo '<hr>';
        echo '待发送的数据及签名： ';
        echo '<pre>';print_r($send_data);echo '</pre>';


        $param = "";
        foreach ($send_data as $k=>$v){
            $param .= $k . '=' .urlencode($v) .'&';     //通过url传递参数 urlencode处理
        }

        $param = rtrim($param,'&');
        echo 'param: '.$param;echo '</br>';

        //发送数据
        //GET发送
        $b_api = 'http://api.1810shop.com/pay?'.$param;
        echo '<hr>';
        echo '请求的接口地址： '.$b_api;
    }
}
