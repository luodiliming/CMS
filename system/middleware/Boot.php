<?php namespace system\middleware;

use houdunwang\middleware\build\Middleware;
use houdunwang\request\Request;
use system\model\Config as c;
use system\model\Weixinconfig as w;

//implements接口引用区别于类继承关键字 extends ，继承只能只是单一性，而接口可以使用关键字 implements 多个引用并用逗号分开
class Boot implements Middleware{
	//执行中间件
	public function run($next) {

//因为中间件会再控制器之前启动，所以在这里判断是否安装cms系统
        $this->isInstall();
        if(is_file('lock.php')){//下载后有此文件的话
            $this->initConfig();
            $this->weixinconfig();
        }

         $next();
	}




//通过该方法判断用户是否安装cms系统
//如果存在lock.php，代表安装过，不存在代表尚未安装，需要跳转至安装控制器
    public function isInstall(){
//      如果判断无文件   并且 正则不到 s参数后面有 这段英文！system/install   就去安装
        if(!is_file('lock.php') && !preg_match('@system/install@i',Request::get('s'))) {
            go(u('system.install.copyright'));
        }
    }




//    获取数据库里的网站配置数据
 public function initConfig(){
     //	    dd(c::get());
//         获得网站设置配置的数据  json_decode()转成数组    pluck()只获得一个字段！
     $config = json_decode((c::find(1) ? c::find(1)->pluck('content') : ''),true) ?: '';
//        dd($config);
//        存到V方法中  他是全局变量   全局都能用！
     v('config',$config);
 }


public function weixinconfig(){
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
}





}