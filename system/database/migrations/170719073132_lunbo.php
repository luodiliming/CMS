<?php namespace system\database\migrations;
use houdunwang\database\build\Migration;
use houdunwang\database\build\Blueprint;
use houdunwang\database\Schema;
class lunbo extends Migration {
    //执行
	public function up() {
		Schema::create( 'lunbo', function ( Blueprint $table ) {
			$table->increments( 'sid' );
            $table->string('thumb');
            $table->integer('article_aid');
            $table->string('description');
            $table->tinyInteger('orderby');
        });
    }

    //回滚
    public function down() {
        Schema::drop( 'lunbo' );
    }
}