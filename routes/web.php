<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//首页
Route::get('/login', 'Index\IndexController@login');
//注册
Route::get('/login/reg', 'Index\LoginController@reg');
Route::post('/login/regdo', 'Index\LoginController@regDo');
Route::post('/weather/login', 'Index\LoginController@login');
Route::get('/weather/login', 'Index\LoginController@login');

//登陆执行
Route::post('/login/loginDo', 'Index\IndexController@loginDo');
//邮箱唯一验证
Route::post('login/checkEmail', 'Index\IndexController@checkEmail');

Route::get('/index/text', 'Index\IndexController@text');




//*******
Route::get('/cate/reg', 'Caty\TextController@reg');
Route::post('/send', 'Caty\TextController@send');
Route::post('/cate/regDo', 'Caty\TextController@regDo');

Route::get('/cate/login', 'Caty\TextController@login');
Route::post('/cate/loginDo', 'Caty\TextController@loginDo');
Route::get('/text', 'Caty\TextController@test');

Route::get('/cate/type', 'Caty\IndexController@index');


Route::get('/exam/login', 'Caty\KeyController@login');

//乘法口诀
Route::get('/cate/pithy', 'Caty\IndexController@pithy');


Route::get('/cate/key', 'Caty\KeyController@key');
Route::get('/cate/keys', 'Caty\KeyController@keys');



Route::get('/cate/a', 'Caty\KeyController@a');


Route::post('/logindo', 'Caty\IndexController@logindo');

Route::post('/reg/login', 'Caty\CateController@reglogin');
//资源控制器
Route::resource('posts', 'PostController');



Route::get('/user/login', 'LoginController@login');

Route::get('/user/reg', 'LoginController@reg');

Route::post('/user/logindo', 'LoginController@loginDo');

Route::post('/loginsee', 'LoginController@loginsee');

Route::get('/user/regdo', 'LoginController@regDo');

Route::get('/api/pad', 'Api\LoginController@pad');

Route::post('/api/login', 'Api\LoginController@login');
Route::post('/api/login', 'Api\LoginController@login');




Route::get('/api/list', 'Api\UserController@list');

Route::get('/api/listapi', 'Api\UserController@listapi');


Route::post('/api/new', 'Api\UserController@new');
Route::post('/api/res', 'Api\UserController@res');
Route::post('/api/hot', 'Api\UserController@hot');
Route::post('/api/data', 'Api\UserController@data');

Route::post('/api/goodsname', 'Api\UserController@goodsname');
Route::post('/api/goodscode', 'Api\UserController@goodscode');

Route::post('/api/price', 'Api\UserController@price');


Route::get('/api/test', 'Api\UserController@test');

// Route::resource('posts/{post}?id={$id}', 'PostController');/

