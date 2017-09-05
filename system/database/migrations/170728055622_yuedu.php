<?php namespace system\database\migrations;
use houdunwang\database\build\Migration;
use houdunwang\database\build\Blueprint;
use houdunwang\database\Schema;
class yuedu extends Migration {
    //执行
	public function up() {
		Schema::create( 'yuedu', function ( Blueprint $table ) {
            $table->increments( 'yid' );
            $table->timestamps();
            $table->string('title');
            $table->smallint('click');
            $table->mediumtext('description');
            $table->text('content');
            $table->string('source');
            $table->string('author');
            $table->smallint('orderby');
            $table->string('linkurl');
            $table->string('keywords');
            $table->string('iscommend');
            $table->string('ishot');
            $table->string('thumb');
            $table->integer('cat_cid');
        });
    }

    //回滚
    public function down() {
        Schema::drop( 'yuedu' );
    }
}