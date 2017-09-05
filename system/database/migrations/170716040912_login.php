<?php namespace system\database\migrations;
use houdunwang\database\build\Migration;
use houdunwang\database\build\Blueprint;
use houdunwang\database\Schema;
class login extends Migration {
    //执行
	public function up() {
		Schema::create( 'login', function ( Blueprint $table ) {
			$table->increments( 'id' );
            $table->string('username')->defaults('liming');
            $table->string('password')->defaults( '123' );
        });
    }

    //回滚
    public function down() {
        Schema::drop( 'login' );
    }
}