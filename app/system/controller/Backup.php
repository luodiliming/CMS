<?php namespace app\system\controller;

use houdunwang\route\Controller;
use houdunwang\backup\Backup as back;
class Backup extends Controller{
    //备份列表开始
    public function lists(){
        $dirs = back::getBackupDir('backup');
        return view('',compact('dirs'));
    }
    //备份列表结束





    //执行备份方法   直接把框架里面的复印过来
public function backup(){
    $config = [
        'size' => 200,//分卷大小单位KB
        'dir'  => 'backup/' . date( "Ymdhis" ),//备份目录
    ];
    $status = back::backup( $config, function ( $result ) {
        if ( $result['status'] == 'run' ) {
            //备份进行中
            echo $result['message'];
            //刷新当前页面继续下次
            echo "<script>setTimeout(function()		{location.href='{$_SERVER['REQUEST_URI']}'},500);</script>";
        } else {
            //备份执行完毕
            die(message($result['message'],'lists'));
        }
    } );
    if($status===false){
        //备份过程出现错误
        echo  back::getError();
    }
    }
//  备份完毕



//还原数据备份开始
    public function recovery() {
        $name = Request::get('name');
        //要还原的备份目录
        $config=['dir'=>'backup/' . $name];
        $status = back::recovery( $config, function ( $result ) {
            if ( $result['status'] == 'run' ) {
                //还原进行中
                echo $result['message'];
                //刷新当前页面继续执行
                echo "<script>setTimeout(function(){location.href='{$_SERVER['REQUEST_URI']}'},1000);</script>";
            } else {
                //还原执行完毕
                die(message($result['message'],'lists'));
            }
        } );
        if($status===false){
            //还原过程出现错误
            echo  back::getError();
        }
    }

//还原数据备份结束




//删除备份开始
    public function delete(){
        $name = Request::get('name');
        Dir::del('backup/' . $name);
        return message('删除成功','lists');
    }

//删除备份结束

}
