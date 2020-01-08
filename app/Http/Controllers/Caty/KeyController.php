<?php

namespace App\Http\Controllers\Caty;
use App\Tools\Auth\JWTAuth;
//use App\Tools\JWTAuth\JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

use App\Http\Controllers\Controller;

class KeyController extends Controller
{

    public function a(){

//        //要发送的数据
//
//        $api_key = '1810a_2019';            //双方协商好的key , 共用
//
//        $oid = '1810a_' . mt_rand(1111111,9999999);
//        $send_data = [
//            'oid'           => $oid,
//            'order_name'    => '测试订单'.$oid,
//            'amount'        => mt_rand(1,100),
//            'add_time'      => time(),
//            'year'          => date('Y'),
//            'create_date'   => date('md')
//        ];
//        echo '<pre>';print_r($send_data);echo '</pre>';
//
//
//        // 1 排序
//        ksort($send_data);
//        echo '<hr>';
//
//        echo '<pre>';print_r($send_data);echo '</pre>';
//
//        //$stra = 'add_time=1561771949&amount=71&create_date=0629&oid=1810a_2453607&order_name=测试订单1810a_2453607&year=2019';
//
//        //2 拼接待签名字符串
//        $stra = "";
//        foreach ($send_data as $k=>$v){
//            $stra .= $k . '=' .$v .'&';
//        }
//
//        $stringSignTemp = $stra . 'key='.$api_key;      //拼接key
//        echo '待签名字符串: '. $stringSignTemp;echo '</br>';
//
//        // 3做签名  strtoupper(md5($stringSignTemp))
//        $sign = strtoupper(md5($stringSignTemp));       //签名值
//        echo '签名： '.$sign;echo '</br>';
//
//        $send_data['sign'] = $sign;
//        echo '<hr>';
//        echo '待发送的数据及签名： ';
//        echo '<pre>';print_r($send_data);echo '</pre>';
//
//
//        $param = "";
//        foreach ($send_data as $k=>$v){
//            $param .= $k . '=' .urlencode($v) .'&';     //通过url传递参数 urlencode处理
//        }
//
//        $param = rtrim($param,'&');
//        echo 'param: '.$param;echo '</br>';
//
//        //发送数据
//        //GET发送
//        $b_api = 'http://www.1810api.com/key/b?'.$param;
//        echo '<hr>';
//        echo '请求的接口地址： '.$b_api;
//        header("Location:".$b_api);
    }

    public function login(){
        $id = 1;
        $jwtAuth = JWTAuth::getInstance();
        $token = $jwtAuth->setuid($id)->encode()->getToken();
        $data=[
            'code'=>200,
            'msg'=>'success',
            'date'=>[
                'token'=>$token,
                'expire_in'=>time()+3600
            ],
        ];
    dd(json_encode($data,JSON_UNESCAPED_UNICODE));
    }
//    public function key(){
//        $str = "zhangsan";
//        $cipher = "AES-128-CBC";
//        $key = "passwork";
//        $iv = 'qweqweqweqweqwe1';
//        $private = file_get_contents('./storage/rsa_public_key.pem');
//        dd($private);
//        $code = base64_encode(openssl_encrypt($str,$cipher,$key,OPENSSL_RAW_DATA,$iv));
////        echo $code;
//        echo "<a href='/cate/keys?code=".$code."'>跳转</a>";
//    }
//
//    public function keys(){
////        echo '123';
//        $key = 'passpwd';
//        $iv = 'qweqweqweqweqwe1';
//        $cipher = "AES-128-CBC";
//        $env_code = $_GET['code'];
////        echo $env_code;
//        $res = base64_decode($env_code,true);
//        $date = openssl_decrypt($res, $cipher, $key, OPENSSL_RAW_DATA, $iv);
//        var_dump($date);
//    }
}
