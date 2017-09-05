<?php namespace app\weixin\controller;

use houdunwang\request\Request;
use houdunwang\route\Controller;
use system\model\Weixinconfig;
class Entry extends Controller{
    //动作
    public function index(Weixinconfig $wei){
//            echo  55415;die;
      $model =  $wei->find(1) ?: $wei;

        if(IS_POST){
          $data = Request::post();
          $model->save($data);//获得到的数据存进可能是添加也可能是修改 ，修改就在覆盖呗！
          return message('保存成功','refresh');
        }


//c函数有两个参数的话是设置配置。只影响本次！  一个参数的话  是获取

        //判断下有没有wechat文件夹里面有没有  token  空为真的话就创建一个!
        if(empty(c('wechat.token'))){
            $token = md5(time());//判断没有token  就设置一个
             c('wechat.token',$token);
        }

        if(empty(c('wechat.encodingaeskey'))){
            $encodingaeskey = md5(microtime()) . substr(md5(time()),0,11);//判断没有encodingaeskey  就设置一个配置下本次的秘钥
            c('wechat.encodingaeskey',$encodingaeskey);
        }
       return view();
    }



    public function reply(){
        $model = Weixinconfig::find(1) ?: new Weixinconfig();
        if(IS_POST){
            $post = Request::post();
            $model->save($post);
            return message('保存成功','refresh');
        }
        return view('',compact('model'));
    }






}
