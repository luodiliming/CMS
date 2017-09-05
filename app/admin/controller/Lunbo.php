<?php namespace app\admin\controller;

use houdunwang\request\Request;
use houdunwang\route\Controller;
use houdunwang\view\View;
use system\model\Lunbo as l;
use system\model\Yuedu;

class Lunbo extends Controller{
    //动作
    public function lists(){                                                                                                                                                        //显示条数
        $data = l::field('lunbo.*,yuedu.title,category.name')->join('yuedu','lunbo.article_aid','=','yuedu.yid')->join('category','yuedu.cat_cid','=','category.cid')->paginate(v('config.tiaoshu'));
//        $data = s::field('slider.*,article.title,category.catname')->join('article','slider.article_aid','=','article.aid')->join('category','article.category_cid','=','category.id')->paginate(v('config.article_row') ?: 10);

//获得所有轮播图数据
//            dd($data);


        return view('',compact('data'));
    }


//        添加或修改
    public function post(l $lunbo){
//        三元判断进来是不是带参数来的修改  还是空的添加
        $sid = Request::get('sid');//先调用get下参数

       $model = $sid ? $lunbo->find($sid) : $lunbo ;

        if (IS_POST){
            $post = Request::post();
            $model->save($post);
            return message('保存成功！','lists');
        }

        //获取被选择推荐的文章
        $yuedu = Yuedu::where('iscommend','=','1')->get();
        return view('',compact('yuedu','model'));//model放进来进行分配数据  和yuedu表里的 推荐id  ！
    }



}
