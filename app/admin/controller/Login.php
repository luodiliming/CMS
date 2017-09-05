<?php
namespace app\admin\controller;



use houdunwang\request\Request;
use houdunwang\route\Controller;
use houdunwang\session\Session;
use system\model\Login as LG;
use houdunwang\view\View;
use system\model\Lunbo;
class Login extends Controller{


    public function __construct()
    {
        Middleware::set('auth', ['except' => ['login']]);
    }

//        显示后台登录方法

        public function login(Lunbo $lunbo){
//如果这里不做个POST判断的话那么，logindl方法直接判断你没填。报出用户名不存在 ！
            if(IS_POST){
               return LG::logindl(Request::post());
            }

            $model = $lunbo->get();

//            dd(compact('model'));
            return view('',compact('model'));
        }


//        退出操作
        public function loginout(){
            Session::del('id');//删除id Session
            Session::flush();//删除所有数据
            return go('login.login');
        }


//        修改密码操作
        public function xgmima(LG $login){

            if (IS_POST){
            return $login->xgmima(Request::post());
            }
           return View();
        }









}
