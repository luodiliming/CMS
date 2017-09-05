<?php namespace app\admin\controller;

use houdunwang\route\Controller;
use houdunwang\view\View;
use system\model\Category as CategoryModel;
use Request;






class Category extends Controller{

    public function __construct()
    {
        Middleware::set('auth');
    }






//    显示栏目列表方法
    public function lists(){
//     通过本类的别名CategoryModel  实例化 get()方法得到所有树状数据！
       $data = CategoryModel::getCategory();
//        两种方法都行
//        return View::make()->with(compact('data'));
//     第二种方法 view 里面第一个是空的话那么就抓当前类的模板。后面是数据！
 //  用写make方法了  直接调用 ‘ ’ 空就代表自身的方法名  做模型！ 后面跟上传进去的参数
        return view('',compact('data'));//          变量变数组的作用！  compact
    }

//
////栏目修改或添加方法
//$CategoryModel  = new CategoryModel  的意思
    public function post(CategoryModel $CategoryModel){//这里相当于实例化这个$CategoryModel  一开始是空值
        $cid = Request::get('cid');//get到第几个cid
//
////        //三元判断，有得到第几条数据的得到。没有还是为$CategoryModel
        $model = $cid ? $CategoryModel->find($cid) : $CategoryModel;
//        p(compact('model'));die;
////
//////        判断有没有post到！
        if(IS_POST){
//        调用save方法存数据
            $model->save(Request::post());
            return message('保存成功','lists');//message方法是给句话，参数二是给个地址
        }
        $data = $model->getCategoryByCid($cid);//
        return view('',compact('data','model'));
                  //这个compact可以放多个参数。data是获得不是父父，于子的数据
                 //compact方法里的model 是三元表达付的$model  要是修改的话就代表里面有值。要是添加，

//        return View::make();
// post的方法的作用是修改或者添加！都走这。！ 首先进来是引模板，上面的GET，或者是三元判断一开始没用的，过来就是空的！
//引完模板不管是添加还是修改，在走IS_POST.在调用Request是调用POST到的数据存起来！。通过message方法，告诉你保存成功，在给你个地址
    }



//删除 栏目数据的方法
    public function delete(CategoryModel $category){
        $cid = Request::get('cid');
        //先获取到需要删除的数据
        if($category->deleteCategory($cid)){
//            return $this->setRedirect('lists')->success('删除成功');
            return message('删除成功','lists');
        }else{
            return $this->error($category->getError());
        }
//        return message('保存成功','lists');
        //返回成功或者失败信息的方法二

    }






 //---------------------------------  以上为栏目部分------------------------------------------------------------









}
