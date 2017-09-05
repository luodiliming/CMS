<?php

namespace app\admin\controller;

use houdunwang\request\Request;
use houdunwang\route\Controller;
use houdunwang\view\View;
use module\wx\model\Keyword;
use system\model\Yuedu as Yd;
use system\model\Category;

    class Yuedu extends Controller{
    public function __construct()
    {
//        执行函数会触发  auth控制器中间件来检测是否有sesssin 没有是跳回登录
        Middleware::set('auth');
    }





//    显示栏目列表方法
    public function lists(){

//获取文章列表的数据
//field方法就相当于查询条件方法
//join方法 是连接哪张表， 参数1表名。
        // 此时的$data  已经是表关联的  拿到了yuedu表的所有和category的name字段了。所以在模板上可以用catgory的name字段了！
        $data  = Yd::field('yuedu.*,category.name')->join('category','category.cid','=','yuedu.cat_cid')->paginate(v('config.tiaoshu'));//这里放中间件的分页数据


//        Request这个方法只能适合有参数的！ 也只能抓到参数，无法抓到数据！ 适用于编辑，删除的！抓到第几条数据！  记住
//        return view('',compact('data'));
        //加载模板方法：
        return View::make()->with(compact('data'));
    }


//        添加或者修改文章方法
    public function post(Yd $yuedumodel){
        $yid = Request::get('yid');//get到第几个cid
//  三元表达式判断是带参数的修改型   还是为空值得添加型~~~~

        $model = $yid ?$yuedumodel->find($yid) : $yuedumodel;

//        判断POST到参数没
        if(IS_POST){
            $post =Request::post();//获得所有参数
//            调用save方法存数据
            $lastid = $model->save($post);
            $content_id = $yid ? $yid : $lastid;   //要么是修改来的参数  要么就用添加的所有参数！
//            讲关键字存进  keyword表中！
            $keyarr = [
                    'keyword' =>$post['keywords'],//阅读表中的关键字
                    'module' => 'yuedu',
                    'content_id' => $content_id
            ];              //三元判断 $yid  是关键词表  content_id等于 阅读表 中的id 的话就取！  不是的话  就实例化Keyword类
            $keyword = $yid ? Keyword::where('content_id','=',$yid) : new Keyword();
              //如果$yid 是修改的话也是存起来 。不是修改的话，就创建一个keyword表！然后把上面自己新建立的关键字表 存进去！ok
            $keyword->save($keyarr);
            return message('保存成功','lists');//message方法是给句话，参数二是给个地址
        }
 //   $data存的这里是拿到Category模型也是Category表里面所有的数据  获得树状所有的数据
        $data = Category::getCategory($yid);
        return view('',compact('model','data'));
    }





//删除 栏目数据的方法
    public function delete(Yd $category){
        $cid = Request::get('yid');
        //先获取到需要删除的数据
        if($category->deleteCategory($cid)){
//            return $this->setRedirect('lists')->success('删除成功');
            //还要删除主键里面的东西！  关键字表里面  和  yid  相当也要删除掉！
                $model = Keyword::where('content_id',$cid)->first();
                $model->destory();

            return message('删除成功','lists');
        }else{
            return $this->error($category->getError());
        }
//        return message('保存成功','lists');
        //返回成功或者失败信息的方法二




    }





}











