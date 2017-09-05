<?php namespace system\database\migrations;
use houdunwang\database\build\Migration;
use houdunwang\database\build\Blueprint;
use houdunwang\database\Schema;
class add_weixincofig extends Migration {
    //执行
	public function up() {
		Schema::create( 'add_weixinconfig', function ( Blueprint $table ) {
            $table->increments('id');
            $table->string('default_message');
            $table->string('welcome');
        });
    }

    //回滚
    public function down() {
        Schema::drop( 'add_weixinconfig' );
    }
}