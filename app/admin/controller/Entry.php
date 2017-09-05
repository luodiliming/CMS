<?php
namespace app\admin\controller;
use houdunwang\view\View;
//后台入口！
class Entry{

    public function __construct()
    {
//        执行函数会触发  auth控制器中间件来检测是否有sesssin 没有是跳回登录
        Middleware::set('auth');
    }





    public function index(){
//  找到entry里面的index模板！懂就好，框架自带的！
        return View::make();
    }

}