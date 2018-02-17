<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shifts', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('user_id')->unsigned()->index();
            
            //年
            $table->integer('year')->unsigned();
            
            //月
            $table->integer('month')->unsigned();
            
            //日
            $table->integer('day')->unsigned();
            
            //勤務開始時間
            $table->integer('start')->unsigned();
            
            //勤務時間の長さ
            $table->integer('hours')->unsigned();
            
            $table->timestamps();
            
            // 外部キー設定
            $table->foreign('user_id')->references('id')->on('users');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('shifts');
    }
}
