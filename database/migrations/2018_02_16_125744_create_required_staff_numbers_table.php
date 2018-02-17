<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequiredStaffNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('required_staff_numbers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('office_id')->unsigned()->index();
            
            //曜日
            $table->string('weekday');
            
            //時間
            $table->integer('time')->unsigned();
            
            //スタッフの数
            $table->integer('number')->unsigned();
            
            $table->timestamps();
            
            // 外部キー設定
            $table->foreign('office_id')->references('id')->on('offices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('required_staff_numbers');
    }
}
