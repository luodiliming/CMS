<?php namespace system\middleware;

use houdunwang\middleware\build\Middleware;
//拿到Config那张表
use system\model\Config as c;


class Config implements Middleware{
	//执行中间件
	public function run($next) {
//	    dd(c::get());
//         获得网站设置配置的数据  json_decode()转成数组    pluck()只获得一个字段！
        $config = json_decode(c::find(1)->pluck('content'),true) ?: '';
//        dd($config);
//        存到V方法中  他是全局变量   全局都能用！
        v('config',$config);
         $next();
	}
}