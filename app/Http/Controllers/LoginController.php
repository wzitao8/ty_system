<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(){
//        echo '123';
        return view('post.login');
    }
    public function loginDo(Request $request){
        $email = $request->input('email');
        $pwd = $request->input('pwd');
        $date = [
            'email'=>$email,
            'pwd'=>$pwd
        ];
        $data=json_encode($date,JSON_UNESCAPED_UNICODE);

        $key="password";
        $method="AES-128-CBC";//密码学方式
        $iv="adminadminadmin1";//非 NULL 的初始化向量
        $a=openssl_get_privatekey("file://".storage_path('rsa_private_key.pem')); //获取秘钥
//        dump($a);
        openssl_sign($data,$exer,$a);//生成签名
//        dd($exer);
        $url="http://www.1810api.com/lolqwe?url=".urlencode($exer);//签名拼接到路由  发送到服务端
//        dd($url);
        $app=openssl_encrypt($data,$method,$key,OPENSSL_RAW_DATA,$iv);// 对称加密
//        dd($app);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);//设为 TRUE ，将在启用 CURLOPT_RETURNTRANSFER 时，返回原生的（Raw）输出
        curl_setopt($ch, CURLOPT_POSTFIELDS, $app);//数据
        curl_setopt($ch, CURLOPT_URL, 'http://www.1810api.com/lolqwe?url='.urlencode($exer));
        //3执行会话
        $info = curl_exec($ch);
        //4结束会话
        curl_close($ch);

    }
    public function loginsee(){
        $key="passwords";
        $method="AES-128-CBC";//密码学方式
        $iv="1212121212121212";//非 NULL 的初始化向量
        $re=$_GET['url']; //路由拼接的数据
        $data=file_get_contents('php://input');
        $data_post=openssl_decrypt($data,$method,$key,OPENSSL_RAW_DATA,$iv);
        echo "传过来的值".$data_post;
        $asymm=openssl_pkey_get_public("file://".storage_path('rsa_public_key.pem'));//从证书中解析公钥，以供使用
        dump($asymm);
        $result = openssl_verify($data_post,$re,$asymm);//验证签名
        echo "签名验证".$result;
    }

    public function reg(){
        return view('post.reg');
    }
    public function regDo(Request $request){
        $username = $request->input('username');
        $email = $request->input('email');
        $pwd = $request->input('pwd');
//        dd($username);


    }
}
