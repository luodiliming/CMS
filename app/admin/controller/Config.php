<?php namespace app\admin\controller;

use houdunwang\request\Request;
use houdunwang\route\Controller;
use houdunwang\view\View;
use system\model\Config as c;
class Config extends Controller{
//    动作
    public function __construct()
    {
//        执行函数会触发  auth控制器中间件来检测是否有sesssin 没有是跳回登录
        Middleware::set('auth');
    }




    public function setting(c $config){
        $model = $config->find(1) ?: $config; //判断是修改还是添加
//        这里的判断是留个分配数据做出的
        if ($model->toArray()){//判断下model转数组   有的话就转数组 下面显示用  空的话就为空数组
            $conData = json_decode($model->pluck('content'),true);
        }else{                           //puuck 获得单一字段
            $conData = [];
        }

//        判断有没有POST上来
        if (IS_POST){
         $post = Request::post();
            if($model->saveConfig($post)){//获得的是JSon字段
                    return message('保存成功','refresh');//保存一个字段  并且刷新
            }
            return message('保存失败');
        }
        return view('',compact('conData'));
    }
}
