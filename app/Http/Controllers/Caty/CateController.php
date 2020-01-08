<?php

namespace App\Http\Controllers\Caty;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redis;
class CateController extends Controller
{
    public function reglogin(){
//        echo ('123');
        $key = 'passpwd';
        $iv = 'qweqweqweqweqwe1';
        $cipher = "AES-128-CBC";
        $env_code = base64_decode(file_get_contents("php://input"));
//        dd($env_code);
        $date = openssl_decrypt($env_code, $cipher, $key, OPENSSL_RAW_DATA, $iv);
//        dd($date);
        $a = json_decode($date,true);
//        dd($a);
        $v = DB::table('reguser')->where(['username'=>$a['username']])->first();
//        dd($v);
        $pwd = $a['pwd'];
//        echo $pwd;die;
        if($v){
            if(password_verify($pwd,$v->pwd)){
//                echo '123';die;
                $token = substr(md5($v->id.Str::random(8).mt_rand(11,99999)),10,20);
//                dd($token);
                session(['id' => $v->id]);
                $redis_key = 'u:token:'.$v->id.'';
                Redis::set($redis_key,$token);
                Redis::expire($redis_key,7200);
                $respoer = [
                    'error' =>0,
                    'msg' =>'ok',
                    'data'=> [
                        'id'=>$v->id,
                    ]
                ];
                echo "<script>alert('登陆成功-->正在前往登录页面');location.href='http://www.1810api.com/user/list?id='+$v->id;</script>";
                return $respoer;
            }else{
                $redis_key = 'u:token:'.$v->id;
//                echo $redis_key;die;
                $num = Redis::incr($redis_key);
//                echo $num;die;
//                if($num>='3'){
//                    $respoer = [
//                        'error' =>40001,
//                        'msg' =>'访问次数过多',
//                    ];
//                    return $respoer;
//                }
//                echo $num;die;
                $respoer = [
                    'error' =>1,
                    'msg' =>'passwordNO',
                ];
                return $respoer;
            }
        }else{
            $respoer = [
                'error' =>40002,
                'msg' =>'UserName-Non-existent',
            ];
            return $respoer;
        }
    }
}
