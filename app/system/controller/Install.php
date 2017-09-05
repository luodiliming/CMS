<?php
namespace app\system\controller;


use houdunwang\route\Controller;

class Install extends Controller {
    public function __construct(){
        $this->checkinstall();//判断是否已经安装
    }
//判断是否已经安装
public function checkinstall(){
        if(is_file('lock.php')){
            return view('isInstalled');//有lock.php就跟他说安装过了，别安了
        }
}






//版权信息控制器
    public function copyright(){
        return view();
    }

//环境检测控制器
    public function check(){
        $data =[
          'server_software' =>$_SERVER['SERVER_SOFTWARE'],//服务器标识的字符串，  操作系统
          'php_version' => PHP_VERSION,//获得当前版本的变量！                     PHP版本
          'curl' => extension_loaded('curl'), //php中的cURL是一个可以让你发送http请求的库，
          'openssl' => extension_loaded('openssl'),// openssl  加密算法
          'gd' => extension_loaded('gd'),         // GD库是用来处理图形的包含有验证码，缩略图
          'pdo' => extension_loaded('Pdo'),
          'root_dir' => is_writable('.'),//is_writable  函数判断指定的文件是否可写。

        ];
        return view('',compact('data'));
    }

//初始数据控制器
    public function database(){
//        判断页面没有没提交上来数据
        if(IS_POST){
            $post = Request::post();
            $this->connection($post);//是与数据源进行连接！
            //连接成功的话，需要创建项目需要的表
            cli('hd migrate:make');//执行数据迁移
            cli('hd seed:make');//进行数据填充
        $sql =<<<str
DROP TABLE IF EXISTS `attachment`;
CREATE TABLE `attachment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '会员编号',
  `name` varchar(80) NOT NULL,
  `filename` varchar(300) NOT NULL COMMENT '文件名',
  `path` varchar(300) NOT NULL COMMENT '文件路径',
  `extension` varchar(10) NOT NULL DEFAULT '' COMMENT '文件类型',
  `createtime` int(10) NOT NULL COMMENT '上传时间',
  `size` mediumint(9) NOT NULL COMMENT '文件大小',
  `data` varchar(100) NOT NULL DEFAULT '' COMMENT '辅助信息',
  `status` tinyint(1) unsigned NOT NULL COMMENT '状态',
  `content` text NOT NULL COMMENT '扩展数据内容',
  PRIMARY KEY (`id`),
  KEY `data` (`data`),
  KEY `extension` (`extension`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='附件';
str;
            Schema::sql($sql);//执行多条 sql语句，框架自带

            return $this->setRedirect('finish')->success('数据库初始化成功');
            //返回 之后跳转到 finish 方法中！并且说一句话
        }
        return view();
}




//连接数据库！！！！！！！！
    public function connection($data){
        $dsn = "mysql:host={$data['host']};dbname={$data['database']}";
        try {
            new \PDO($dsn,$data['user'],$data['password']);//实例连接数据库PDO
//如果连接成功，将传过来的post参数写入php文件
            Dir::create('data');
            //写入数据库  分配data数据转成字符串
           file_put_contents('data/database.php',"<?php return " . var_export($data,true) . ";?>");
        }catch (\Exception $e){
            $this->error($e->getMessage());
        }
    }






//--------------项目安装完毕-----------------------
            public function finish(){
                //生成lock.php页面
                touch('lock.php');
                return view();

            }








};




















