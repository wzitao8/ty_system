<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Model\GoodsModel;
class UserController extends Controller
{
    public function list(){
        return view('list.listapi');
    }

    public function listapi(){
        $arr=GoodsModel::select()->paginate(5);
//        dd($a);
        return view('list.listapi',['data'=>$arr]);
    }
    public function new(Request $request){
//        echo '123';
        $name = $request->input('name');
//        dd($name);
        $key = 'passpwd';
        $iv = 'qweqweqweqweqwe1';
        $cipher = "AES-128-CBC";
        $env_code = openssl_encrypt($name,$cipher,$key,OPENSSL_RAW_DATA,$iv);
//        dd($env_code);
        $url = "http://pass.1810shop.com/api/res";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);//设为 TRUE ，将在启用 CURLOPT_RETURNTRANSFER 时，返回原生的（Raw）输出
        curl_setopt($ch, CURLOPT_POSTFIELDS, $env_code);//数据
        curl_setopt($ch, CURLOPT_URL, 'http://pass.1810shop.com/api/res');
        //3执行会话
        $info = curl_exec($ch);
        //4结束会话
        curl_close($ch);

    }
    public function res(Request $request){
//        echo '123';
        $key = 'passpwd';
        $iv = 'qweqweqweqweqwe1';
        $cipher = "AES-128-CBC";
        $data = file_get_contents('php://input');
//        dd($data);
        $data_post = openssl_decrypt($data, $cipher, $key, OPENSSL_RAW_DATA, $iv);
//        var_dump($data_post);
        $where =[
            'is_new'=>$data_post
        ];
        $arr=GoodsModel::select()->where($where)->paginate(5);
//        dd($arr);
        return view('list.listapis',['data'=>$arr]);
    }
    public function hot(Request $request){
        $uname = $request->input('uname');
//        dd($uname);
        $key = 'passpwds';
        $iv = 'qweqweqweqweqwe2';
        $cipher = "AES-128-CBC";
        $env_code = openssl_encrypt($uname,$cipher,$key,OPENSSL_RAW_DATA,$iv);
//        dd($env_code);
        $url = "http://pass.1810shop.com/api/data";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);//设为 TRUE ，将在启用 CURLOPT_RETURNTRANSFER 时，返回原生的（Raw）输出
        curl_setopt($ch, CURLOPT_POSTFIELDS, $env_code);//数据
        curl_setopt($ch, CURLOPT_URL, 'http://pass.1810shop.com/api/data');
        //3执行会话
        $info = curl_exec($ch);
        //4结束会话
        curl_close($ch);

    }
    public function data(Request $request){
//        echo '123';
        $key = 'passpwds';
        $iv = 'qweqweqweqweqwe2';
        $cipher = "AES-128-CBC";
        $data = file_get_contents('php://input');
//        dd($data);
        $data_post = openssl_decrypt($data, $cipher, $key, OPENSSL_RAW_DATA, $iv);
//        var_dump($data_post);die;
        $where =[
            'is_new'=>$data_post
        ];
        $arr=GoodsModel::select()->where($where)->paginate(5);
//        dd($arr);
        return view('list.listapis',['data'=>$arr]);
    }

    public function goodsname(Request $request){
        $goods_name = $request->input('goods_name');
        if (empty($goods_name)){
            $respoer = [
                'error' =>40001,
                'msg' =>'goods_name,empty!',
                'data'=> [
                ]
            ];
            return $respoer;
        }else{
            $private=openssl_get_privatekey("file://".storage_path('rsa_private_key.pem'));
            $url="http://pass.1810shop.com/api/goodscode";
            openssl_private_encrypt($goods_name,$crypted,$private);
//        dd($crypted);
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);//设为 TRUE ，将在启用 CURLOPT_RETURNTRANSFER 时，返回原生的（Raw）输出
            curl_setopt($ch, CURLOPT_POSTFIELDS, $crypted);//数据
            curl_setopt($ch, CURLOPT_URL, 'http://pass.1810shop.com/api/goodscode');
            //3执行会话
            $info = curl_exec($ch);
            //4结束会话
            curl_close($ch);
        }

    }

    public function goodscode(){
//        echo '213';
        $data = file_get_contents('php://input');
//        dd($data);
        $key = openssl_pkey_get_public("file://" . storage_path('rsa_public_key.pem'));
        openssl_public_decrypt($data, $decrypted, $key);

        $arr=GoodsModel::select()->where('goods_name','like',"%$decrypted%")->paginate(2);
//        dd($arr);
        return view('list.listapis',['data'=>$arr,'goods_name'=>$decrypted]);
    }
    public function price(){
//        echo '1232';
        $aa = DB::table('shop_goods')->orderBy('self_price','desc')->get();
//        return view('list.listapis',['data'=>$aa]);
    }
    
        public function test(){
        $data = '12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890';
        $i= 0;
        $all = '';
        $key = openssl_pkey_get_public("file://" . storage_path('rsa_public_key.pem'));
        while ($sub_str = substr($data,$i*117,177)){
//            echo $sub_str;die;
            openssl_public_encrypt (
                $sub_str,
                $cipher,
                $key,
            OPENSSL_PKCS1_PADDING
            );
        }
        echo $cipher;

    }
}


