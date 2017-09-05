<?php

namespace module\wx\controller;
use houdunwang\request\Request;
use module\Hdcontroller;
use module\wx\model\Keyword;
use module\wx\model\Wxcontent;

class Wx extends Hdcontroller {//继承他就可以自动加载页面方法！

    public function lists(){
        //获得了 回复信息表中的所有  和关键字表中的 关键
        $data = Keyword::field('keyword.keyword,wxcontent.*')->join('wxcontent','keyword.content_id','=','wxcontent.id')->paginate(10);
//        p($data);
        return view($this->template . 'wx/lists',compact('data'));
        //里面的到的结果是     module/base/template/huifu/lists   路径就有了！
        //    $this->template   存入了m=module/base ./template/了！  在用view方法  后面连接huifu/lists  调用页面
    }

   public function post(){
//    先获得下有id  参数的信息！
       $id = Request::get('id');
       $wxcontent =  $id ? Wxcontent::find($id) : new Wxcontent();//三元判断  要不就是有参数  要不就是没参数new一个对象！

        if(IS_POST){
            $post = Request::post();//获取信息
            $lastid = $wxcontent->save($post);//获取信息存在回复表一起！
            $content_id = $id ? $id : $lastid;  //三元判断是带过来的数据  还是添加上来的数据
//             处理存储关键字的数据表
            $model = Request::get('m');//get到 m参数 ->  model/wx

            //新建数组
            $data = [
                'module'=>$model,    //model/wx
                'keyword'=>$post['keyword'],  //获取信息里面的主键！
                'content_id'=>$content_id,  //三元判断是带过来的数据  还是添加上来的数据
            ];

            $this->saveKeyword($data);//通过这个方法就可以Keyword表也能存数据了！
            return message('保存成功',url('wx.lists'));
        }
//分配变量！
// $this->assignKeyword($id);
//        return view($this->template.'wx/post',compact('Wxcontent'));  //保存后进去lists   回复内容表留用
       $this->assignKeyword($id);
       return view($this->template . 'wx/post',compact('wxcontent'));
   }


//   删除   find是找主键！  field是找指定字段。join是连接哪张表！  paginate 是分页 save存  destory 删除销毁内容！
        public function delete(){
          $id = Request::get('id');
//          删除回复内容
              $data = Wxcontent::find($id);
                $data->destory();
            //还需要删除关键字表中对应的触发关键字
            $this->removeKeyword($id);//此方法也删除了  主键表中的内容
            return message('删除成功',url('wx.lists'));
        }







}