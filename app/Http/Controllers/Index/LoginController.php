<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\RegModel;
use DB;
class LoginController extends Controller
{
    public function reg(){
        return view('login.reg');
    }
//    public function regDo(Request $request){
//        echo '123';
////        $username = $request->input('username');
//////         $pwd= $request->input('pwd');
//////        $email = $request->input('email');
//////        $tel = $request->input('tel');
//        $post=$request->only(['username','pwd','email','tel','photo']);
//        $post['photo']=$this->upload($request,'photo');
//
//        dd($post);
//        $a = RegModel::insert($post);
//        var_dump($a);
//    }
    public function regDo(Request $request){
        $data=request()->all();
        //hasFile判断文件在请求中是否存在
        if($request->hasFile('photo')){
            $data['photo']=$this->upload($request,'photo');
        }
        $data['pwd']=password_hash($data['pwd'],PASSWORD_BCRYPT);
        //邮箱唯一
        $emailInfo=DB::table('reg_user')->where(['email'=>$data['email']])->first();
        if(!empty($emailInfo)){
            echo "<script>alert('该邮箱以注册');location.href='/reg';</script>";exit;
        }
        //用户名唯一
        $usernameInfo=DB::table('reg_user')->where(['username'=>$data['username']])->first();
        if(!empty($usernameInfo)){
            echo "<script>alert('该用户名以注册');location.href='/reg';</script>";exit;
        }
        //手机号唯一
        $telInfo=DB::table('reg_user')->where(['tel'=>$data['tel']])->first();
        if(!empty($telInfo)){
            echo "<script>alert('该手机号以注册');location.href='/reg';</script>";exit;
        }
        //入库
        $res=DB::table('reg_user')->insert($data);
        if($res){
            //注册成功  生成APPID和APPSecret
            $appid='zitao'.time().mt_rand(111,999);
            $appsecret=base64_encode(date('Y-m-d H:i:s').mt_rand(111,999));
            DB::table('reg_user')->where(['username'=>$data['username']])->update(['appid'=>$appid,'appsecret'=>$appsecret]);
            echo "<script>alert('注册成功-->正在前往登录页面');location.href='/weather/login';</script>";
        }else{
            echo "<script>alert('注册失败');location.href='/weather/login';</script>";
        }
    }
    // 文件上传
    public function upload(Request $request,$filename){
        if ($request->hasFile($filename) && $request->file($filename)->isValid()) {
            $photo = $request->file($filename);
            $extension = $photo->extension();
            //$store_result = $photo->store('photo');
            $pre_path = 'upload/';
            $store_result = $photo->store($pre_path.date('Ymd'));
            return $store_result;
        }
        exit('未获取到上传文件或上传过程出错');
    }
    public function login(){
        echo '123';
    }
}
