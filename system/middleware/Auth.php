<?php namespace system\middleware;

use houdunwang\middleware\build\Middleware;
use system\model\Login;

class Auth implements Middleware{
	//执行中间件
	public function run($next) {
        $id = Session::get('id');//获得id
//        dd($id);
        if ($id){       //find方法是查询指定字段    在转成数组留用
            v('userlogin',Login::find($id)->toArray());
        }else{
            //没有的话就die掉
            die(message('请你先登录','admin.login.login'));
        }
         $next();
	}
}