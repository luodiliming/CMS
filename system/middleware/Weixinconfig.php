<?php namespace system\middleware;

use houdunwang\middleware\build\Middleware;
use system\model\Weixinconfig as w;

class Weixinconfig implements Middleware{
	//执行中间件
	public function run($next) {
        //获取wechat配置项的数据
        $wechatconfig = c('wechat');
        //获取数据库中的微信连接配置数据
        $data = w::find(1);
        //判断下有没有
        if($data){
            $data = $data->toArray();
        }else{
            $data = [];
        }

//      并
        $hebing = array_merge($wechatconfig,$data);//后面数据库有参数的话就覆盖前面的数据
//        p($hebing);
        c('wechat',$hebing);
         $next();
	}
}