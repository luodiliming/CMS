<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/7/20
 * Time: 10:33
 */

namespace app\weixin\controller;


use houdunwang\wechat\WeChat;
use module\wx\model\Keyword;
use module\wx\model\Wxcontent;

//此方法是向用户回复功能！
class Api{

//    public function __construct(){
//        WeChat::valid();
//    }
//
//    public function index(){
////消息管理模块
//        $instance =WeChat::instance('message');
////判断是否是文本消息
//        if ($instance->isTextMsg())
//        {
//            //向用户回复消息
//            $instance->text('后盾人收到你的消息了...:' . $instance->Content);
//        }
//
//
//    }

    public function __construct(){
        WeChat::valid();   //手册此方法是与微信公众好互通！！！！
    }

    public function index(){
        //消息管理模块
        $instance =WeChat::instance('message');//手册中获取消息方法！  //用户发来的消息
        $usermsg = $instance->Content;//把收到的信息接受一下！
        //三元判断下   关键字表中有没有跟 接受来里面内容有一样的   first获取指定数据
         $keyword = Keyword::where('keyword',$usermsg)->first();
        if ($keyword){
            //Wxcontent 表id   等于  keywored 中的content_id   就获得单一字段   content回复内容
           $wxcontent = Wxcontent::where('id',$keyword['content_id'])-pluck('content');
        }else{
            $wxcontent  = c('wechat.autoreply');//给它个地址找去
        }
        file_put_contents('a.php',$wxcontent);//建立一张表叫a.php   把变量存进去当内容！
        //判断是否是文本消息
        if ($instance->isTextMsg()){
//                  向用户回复消息
            $instance->text($wxcontent);
        }



    }

}