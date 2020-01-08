<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        echo "123";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        echo "wordwrap";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // echo "string";
        $username = $request->input('username');
        $pwd = $request->input('pwd');
        $sex = $request->input('sex');
        // echo $username;
        // echo "<br>";
        // echo $pwd;
        // echo "<br>";
        // echo $sex;
        $data = [
            'username'=>$username,
            'pwd'=>$pwd,
            'sex'=>$sex,
        ];
        $a = DB::table('reguser')->insert($data);
        // dd($a);
        if ($a) {
            $respoer = [
                'error' =>0,
                'msg' =>'注册成功',
                ];
            return $respoer;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // echo "9947";
        $a = DB::table('reguser')->get();
        // $e = json_decode($a,true);
        // dd($e);
        $respoer = [
                'error' =>0,
                'msg' =>'查询成功',
                'data'=>$a,
                ];
        return $respoer;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $p = DB::table('reguser')->where('id',$id)->update(['username'=>'8848']);
        $respoer = [
                'error' =>0,
                'msg' =>'修改成功',
                ];
        return $respoer;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // echo 'DELETE';
        // echo 'SHOW ID:'.$id;
        $w = $id;
        echo "<hr>";
        echo $w;
        $a = DB::table('reguser')->where(['id'=>$w])->delete();
        dd($a);
    }
}
