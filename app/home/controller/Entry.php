<?php
/** .-------------------------------------------------------------------
 * |  Software: [HDPHP framework]
 * |      Site: www.hdphp.com  www.hdcms.com
 * |-------------------------------------------------------------------
 * |    Author: 向军 <2300071698@qq.com>
 * |    WeChat: aihoudun
 * | Copyright (c) 2012-2019, www.houdunwang.com. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace app\home\controller;

use houdunwang\request\Request;
use houdunwang\route\Controller;
use system\model\Stu;

class Entry extends Controller{

            //执行函数   判断是移动端还是PC端
        public $template;
        public function __construct(){
            $this->template = 'tpl/' . (IS_MOBILE ? 'mobile' : 'web') ;//就是  tpl/web/  组成这样！
// __ROOT__是项目的根目录    http://www.zhuzengqun.com/cms/index.php


//  这个常量指的是-》 这个路径！http://www.zhuzengqun.com/cms/index.php?s=tpl/web/index
            define('__TEMPLATE__',__ROOT__ .'/'. $this->template);//define()是设置一个常量！

            $data = $this->makeurl();
//        if($data !== false){
//            return $data;
//        }
        }


    //跳转模块！
    public function index(){
//就是  tpl/web/index.html
        return view($this->template . '/index.html');

    }



    //前台栏目控制器
public function lists(){
//就是  tpl/web/index.html
    return view($this->template.'/list.html');
}



    //文章控制器
    //就是  tpl/web/index.html
public function content(){
    return view($this->template.'/content.html');
}



//  文章显示功能！
    public function home(){
        return view($this->template . '/home.html');
    }















/**
 * 用来给自定义模块跳转的方法 参数m   a跳转的方法
 */
    public function runModule(){
            $module = Request::get('m');
            $action = Request::get('a');
            if($module && $action){
                $info = explode('/',$action);//转数组  controller/huifu/lists
                $info = ucfirst($info[1]);//头一个转大写!
                //配一起成命名空间
                $class = 'addons\\'.$module.'\\'.$info[0].'\\'.$info[1];
                $a=$info[2];
                return call_user_func_array([new $class,$a],[]);
            }
                //判断上面没有的话就  false
                    return false;
    }






    /**
     * 用来给自定义模块跳转的方法 参数m   action  跳转的方法
     */
        public function makeurl(){
            $module = Request::get('m');//m参数    GET到的参数                      module/base
            $action = Request::get('action');//action参数  GET到的参数  string(22) "controller/huifu/lists"
            if($module && $action){//判断$module  和 action  都存在!
                $info = explode('/',$action);//转数组
                $info[1] = ucfirst($info[1]);//因为数组1要当控制器名字，所以要设置大写！
//把$module/base / 替换成  \  成为命名空间的正斜杠！
                $module = str_replace('/','\\',$module);
//组合成一个命名空间！！！         成为这样的！     module\base\controller\huifu
                $class = $module .'\\'.$info[0].'\\'.$info[1];
                $a = $info[2];     //lists


                return call_user_func_array([new $class,$a],[]);
 //返回回调函数相当于  $class里面的  module\base\controller\huifu 最后一个heifu类 调用了  lists方法 。后面给了空参数

            }
 //           以上没有就返回  false  要不都调用了这个方法
            return false;
        }

}