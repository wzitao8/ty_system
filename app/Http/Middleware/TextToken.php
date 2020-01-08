<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Redis;

class TextToken
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    public function handle($request,Closure $next){
        $uid = session('id');
        if($uid){
            $key = 'uid'.$uid;
            Redis::expire('key',10);
        }
        return $next($request);
    }
}
