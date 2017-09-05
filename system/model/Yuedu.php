<?php namespace system\model;
use houdunwang\model\Model;
class Yuedu extends Model{
	//数据表
	protected $table = "yuedu";

	//允许填充字段
	protected $allowFill = ['*'];

	//禁止填充字段
	protected $denyFill = [ ];

	//自动验证
	protected $validate=[
        //['字段名','验证方法','提示信息',验证条件,验证时间]
//        ['name','required','请输入栏目标题',3],
//        ['jieshao','required','请输入栏目介绍',3]

	];

	//自动完成
	protected $auto=[
		//['字段名','处理方法','方法类型',验证条件,验证时机]
	];

	//自动过滤
    protected $filter=[
        //[表单字段名,过滤条件,处理时间]
    ];

	//时间操作,需要表中存在created_at,updated_at字段
	protected $timestamps=true;



    //获得所有树状结构数状数据
    public static function getCategory(){
        $data = self::get();//获得所有内容！
        //获得树状结构！      参数1数组      2字段名    主键ID   父id
        $data = Arr::tree($data->toArray(),'title','yid','cat_cid');//cat_cid
        return $data;
    }




//删除方法
    public function deleteCategory($cid){
        $data = $this->find($cid);
        //先获取所有栏目的数组
//        $category = $this->get()_.toArray();
        $category = self::getCategory();
        //可以删除当前模型的数据，这时的模型等同于一个新模型，模型没有与表记录进行关联。
        if(Arr::hasChild($category, $cid, 'cat_cid')){
            //成立的话，说明有子栏目，不允许直接删除
            $this->setError(['请先删除子栏目，再来删除我吧！！哈哈哈']);
            return false;
        }
        return $data->destory();
    }













}