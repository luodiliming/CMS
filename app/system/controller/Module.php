<?php namespace app\system\controller;

use houdunwang\request\Request;
use houdunwang\route\Controller;
use houdunwang\view\View;
use system\model\Module as M;
class Module extends Controller{
    //动作
    public function lists(){
        $data = M::get();
        return view('',compact('data'));

    }



                //判断添加还是修改！
    public function post(M $module){
        if (IS_POST){
            $post = Request::post();//得到所有的信息
            $this->makeModule($post);//调用创建系统或非系统目录

//          三元判断  是不是系统模块！
            $is_system = $post['is_system'] ?: 0;
//          在判断m表中的模型名字=post上来的模型名      而且都是     系统模块
            $check = m::where('name',$post['name'])->andwhere('is_system',$is_system)->first();
            if ($check){
            return message('该模块名已存在！换个名字','back');
            }

            $module->save($post);//存起来
            return message('保存成功！','lists');
        }
      return view();

    }


//            此函数是创建方法
    public function makeModule($post){
        $name =  $post['name'];//得到要创建的名字
//          创建模型需要的目录结构
        $dirs = [
            'controller','model','system','template'

        ];
//    循环创建目录
        foreach ($dirs as $dir){
// 三元判断 。如果是系统模块是等于1的 就以module开头    不是系统的就addonss
            $dirPath = ($post['is_system'] == 1) ? 'module' : 'addons';

//创建目录Dir::create方法 手册有！
//            创建 头部名字三元判断得出  /模块标示 /   'controller','model','system','template'
            Dir::create($dirPath . '/' .$name . '/' . $dir);
        }

//直接把里面的东西写出来。每次创建就不用写了！！！
        $content = <<<str
<?php
namespace addons\\{$name}\\system;

class Processor
{
    //动作
    public function index(){
        //代码在这里写
    }
}
str;

//在system创建一个默认类
 //      三元判断得到  module 还是 addons  / 名字 /
        file_put_contents($dirPath . '/' . $name . '/system/Processor.php',$content);

    }

}
