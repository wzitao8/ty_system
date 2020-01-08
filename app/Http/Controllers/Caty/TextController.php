<?php

namespace App\Http\Controllers\Caty;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\RegModel;
use DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
use Mail;
use GuzzleHttp\Client;
//use Illuminate\Support\Facades\Session;
class TextController extends Controller
{
    public function reg(){
    	return view('cate.reg');
    }

    public function send(Request $request){

//        $email = $request ->input('email');
//        dd($email);
        $email = '994754467@qq.com';
        $code=rand(1111,9999);
        Mail::send('cate/Password',['code'=>$code,'name'=>$email],function($message)use($email){
            $message->subject('邮箱验证码');
            $message->to($email);
        });
        //echo $code;
        return $code;
//        $u = RegModel::where(['email'=>$email])->first();
//        if($u){
//           // echo $email;die;
//        }else{
//            $respoer = [
//                'error' =>50007,
//                'msg' =>'获取不到邮箱',
//            ];
//            return $respoer;
//        }

    }
    public function regDo(Request $request){
//        echo '123';
        $post=$request->only(['email','pwd']);
//        dd($post);
        $email = $request->input('email');
        $u = RegModel::where(['email'=>$email])->first();
        if($u!=''){
            echo '邮箱已存在';die;
        } else{
            $pwd = password_hash($post['pwd'],PASSWORD_BCRYPT);
//            var_dump($pwd);die;
            $data = [
                'email'=>$post['email'],
                'pwd' => $pwd,
            ];
            $res = RegModel::insert($data);
            if($res){
                echo '1';
            }else{
                echo '2';
            }
        }
    }

    public function login(){
        return view('cate.login');
    }
    public function loginDo(Request $request){
        $email = $request->input('email');
        $pwd = $request->input('pwd');

//        dd($post);
        $a = DB::table('reguser')->where(['email'=>$email])->first();
//        dd($a);
        if($a){
            if(password_verify($pwd,$a->pwd)){
//                echo 'ok';
                $token = substr(md5($a->id.Str::random(8).mt_rand(11,99999)),10,10);
                session(['id' => $a->id]);
                $uid = $a->id;
                Redis::set($uid,$token);
                $respoer = [
                    'error' =>0,
                    'msg' =>'ok',
                    'data'=> [
                        'id'=>$a->id
                    ]
                ];
                return $respoer;
            }else{
                echo '登陆失败';
            }
        }else{
            echo '用户名不存在';
        }
    }
    public function test(Request $request){
        $api_key = '1810a_2019';
        $account_id = session('id');
//        dd($value);
        $url = 'https://api.1810shop.com/user/pay';
        $post_data = [
            'account_id'=>$account_id,
            'category_type'=>0,
        ];
       ksort($post_data);
       echo '<hr>';
//       print_r($post_data);
        $stra = '';
        foreach ($post_data as $k=>$v){
            $stra .= $k . '=' .$v . '&';
        }
        $straTemp = rtrim($stra,'&'). 'key='.$api_key;
//        dd($stra);
        $sign = strtoupper(md5($straTemp));
//        echo $sign;
        $post_data['sign']=$sign;
//        echo $post_data;
        $param_str = '?';
        foreach($post_data as $k=>$v){
            $param_str .= $k.'='.urlencode($v) . '&';
        }
        $param = rtrim($param_str,'&');
        $url = $url . $param;
//        echo $url;
        header("Location:".$url);
    }

}
