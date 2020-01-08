<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redis;
class LoginController extends Controller
{
    public function pad(){
        return view('login.log');
    }
    public function login(Request $request){
//        header("Access-Control-Allow-Origin:*");
//        echo '123';
        $name = $request->input('name');
        $pwd = $request->input('pwd');
        $a = \DB::table('reguser')->where(['username'=>$name])->first();
//        dd($a);
        if($a){
            if(password_verify($pwd,$a->pwd)){
//                echo 'ok';
                $token = substr(md5($a->id.Str::random(8).mt_rand(11,99999)),10,20);
//                var_dump($token);
                $redis_key = 'api:token:'.$a->id.'';
//                echo $redis_key;
                Redis::set($redis_key,$token);
                Redis::setTimeout($redis_key,10);

                $respoer = [
                    'error' =>0,
                    'msg' =>'ok',
                    'data'=> [
                        'token'=>$token,
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
}
