<?php namespace system\database\migrations;
use houdunwang\database\build\Migration;
use houdunwang\database\build\Blueprint;
use houdunwang\database\Schema;
class seeds extends Migration {
    //执行
	public function up() {
		Schema::create( 'seedsattac', function ( Blueprint $table ) {
			$table->increments( 'id' );

        });
    }

    //回滚
    public function down() {
        Schema::drop( 'seedsattac' );
    }
}