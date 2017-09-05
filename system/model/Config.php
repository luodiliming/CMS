<?php namespace system\model;
use houdunwang\model\Model;
class Config extends Model{
	//数据表
	protected $table = "config";

	//允许填充字段
	protected $allowFill = ['*'];

	//禁止填充字段
	protected $denyFill = [ ];

	//自动验证
	protected $validate=[
		//['字段名','验证方法','提示信息',验证条件,验证时间]
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
	protected $timestamps=false;





//	通过这个方法 我们得到一个字段，存了多个小字段的数据!

//	我们要把几个字段放在一个字段栏里！所以要传将  将数值转换成json数据存储格式
            //要用json_encode通过处理转JSON，只保存content一个字段
        public function saveconfig($data){
            $content = json_encode($data);
//            把转成的字符串  存进一个字段中
            $saveData = ['content'=>$content];
//            dd($saveData);
            return $this->save($saveData);
        }









}