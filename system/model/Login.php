<?php namespace system\model;
use houdunwang\model\Model;
use houdunwang\session\Session;

class Login extends Model{
	//数据表
	protected $table = "login";

	//允许填充字段
	protected $allowFill = ['*'];

	//禁止填充字段
	protected $denyFill = [ ];

	//自动验证
	protected $validate=[
		//['字段名','验证方法','提示信息',验证条件,验证时间]
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



    public function logindl($a){
        $username = $a['username'];
        $password = $a['password'];

//      先用select语句 写出条件判断  名字等于名字的   用户数据信息！
        $data = Login::where("username = '{$username}'")->get();

//        p($data);die;
//1：里面没有username 就是说没有用户名
// 上面get()到的信息是没有用toArray()方法的话  得到的只有两个情况————>   空或者对的用户名！那么直接判断空还是不空就好了！
//就可以判断存不 存在用户名了！
        if(empty($data)){
//            return $this->setRedirect()->success('用户名不存在');
            return ['valid'=>false,'message'=>'该用户不存在'];
        }else{
//用户名存在的话  在判断密码  但是需要变成数组！ 在判断
            $data = $data->toArray();
            if($password != $data[0]['password']){
                return ['valid'=>false,'message'=>'输入的密码错误'];
            }
        }

 //存session  几种存Session 的方法！
//        $_SESSION['username'] = $data['username'];
//        Session::set('username',$data['username']);

//        判断成立的话就存进 Session
        Session::set('id',$data[0]['id']);
        return ['valid'=>true,'message'=>'登录成功'];
    }



        public function xgmima($data){


            if ($data['username'] != $data['xgmima']) {
                return ['valid=false', 'message' => '两次密码输入不一致'];
            }

            $user = self::find(Session::get('id'));
           $data['password'] = $data['xgmima'];
            $user->save($data);
            return ['valid'=>true,'message'=>'修改成功'];
        }














}