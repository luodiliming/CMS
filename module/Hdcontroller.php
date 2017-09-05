<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/7/20
 * Time: 22:42
 */
namespace module;
use houdunwang\request\Request;
use houdunwang\view\View;
use module\wx\model\Keyword;

class Hdcontroller{

    public $template;  //存入了m=module/wx ./template/了！


    public function __construct(){
            $model = Request::get('m');//m参数 列如m=module/wx
            $this->template = $model.'/template/';
    }


    //存关键字的方法！
    public function saveKeyword(array $data){//Wxcontent表  内容
                    //关键之表的  content_id  等于  这个数  说明就是修改
       $keyword = Keyword::where('content_id',$data['content_id'])->first();

        if($keyword) {//判断有的话    就单独存keyword 这一个字段放进关键字表中！
            $keyword->keyword = $data['keyword'];
            $keyword->save();
        }else{         // 没有的话就创建一个 关键字对象  全部存到表中！
            $keyword = new Keyword();
//            dd($data);
            $keyword->save($data);
        }
    }


////分配变量！
//  public function assignKeyword($id){//传进来的ID
//      $data = Keyword::where('content_id',$id)->pluck('keyword');//关键字的  content_id 等于 传进来的  id 的话 取得单一数据列的单一字段
//      View::with('keyword',$data);//得到了  关键字表中的 keyword 字段！
//  }

//分配变量
    public function assignKeyword($id){
        $data = Keyword::where('content_id',$id)->pluck('keyword');
        View::with('keyword',$data);
    }



//        删除方法
        public function removeKeyword($content_id){//带过来的id
        $model = Keyword::where('content_id',$content_id)->first();//判断  关键表中 对比下，content_id 等于 id   就用flisrt 方法 获取出来！
        $model->destory();//删除关键词表中的内容
        }











}