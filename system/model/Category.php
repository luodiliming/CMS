<?php namespace system\model;
use houdunwang\model\Model;

//通过小黑屋创建的一个category的 名字会和表名一样！                 模型！！！！！！！！！
class Category extends Model{
	//数据表
	protected $table = "category";

	//允许填充字段
	protected $allowFill = ['*'];

	//禁止填充字段
	protected $denyFill = [ ];

	//自动验证
	protected $validate=[
		//['字段名','验证方法','提示信息',验证条件,验证时间]
        ['name','required','请输入栏目标题',3],
        ['jieshao','required','请输入栏目介绍',3]
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

	    //获得树状结构
    public static function getCategory(){
        $data = self::get();//获得所有内容！
        //获得树状结构！      对象转成数组           字段    主键id  pid
        $data = Arr::tree($data->toArray(),'name','cid','pid');
        return $data;
    }


    public function getCategoryByCid($cid){
//首先不能选择自己作为自己的父级
//判断当前要修改的栏目，不能选择自己作为父级

//        先获得树状的所有内容！
        $data = self::getCategory();
//
        foreach ($data as $k=>$v){
//           判断对比。如果跟自己的cid一样的话!
//           if($v['cid'] == $cid  ){
////// 代表着当前修改的和循环里的某个栏目cid相同   在$data 创建一个键名。
//                $data[$k]['_disabled'] = 'disabled="disabled"';
//           }else{
//////  判断cid跟某个栏目不相同的话就 为空！
//                $data[$k]['_disabled'] = '';
//            }
//
//
//
//           //            是否为子栏目
////            $data[$k]['_disabled'] = Arr::isChild($data, $v['cid'], $cid, 'cid', 'pid') ? 'disabled="disabled"' : '';
//
//////                      是否有子栏目
//            if(Arr::isChild($data, $v['cid'], $cid, 'cid', 'pid')){
//               $data[$k]['_disabled'] = 'disabled="disabled"';
//           }else{
//               $data[$k]['_disabled'] = '';
//           }






//因为修改只能选中自己的父级！ 通过三元表达式，可以避免可以不选自己，不选下级的作用！！！！

//$data[$k]['_disabled'] 这句话就相当于生成一个_disabled   通过三元判断 获得所有的数据里面的$v里的cid 等于点击到第几个带过来的$cid.
//就是代表找到的它自己。或者    找到了它的子栏目！ 下拉列表有个属性就是 disabled="disabled那就不能选  ？disabled=“  ”  就是可以选中！！！
 $data[$k]['_disabled'] = $v['cid'] == $cid || Arr::isChild($data, $v['cid'], $cid, 'cid', 'pid') ? 'disabled="disabled"' : '';


        }
            return  $data;
    }


//删除方法
    public function deleteCategory($cid){
        $data = $this->find($cid);
        //先获取所有栏目的数组
//        $category = $this->get()_.toArray();
        $category = self::getCategory();
        //可以删除当前模型的数据，这时的模型等同于一个新模型，模型没有与表记录进行关联。
        if(Arr::hasChild($category, $cid, 'pid')){
            //成立的话，说明有子栏目，不允许直接删除
            $this->setError(['请先删除子栏目，再来删除我吧！！哈哈哈']);
            return false;
        }
        return $data->destory();
    }







}