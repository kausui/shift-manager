<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique()->index();
            $table->string('first_name');
            $table->string('last_name');
            
            //所属する事業所id。新規ユーザ登録した場合は自動的に新しい事業所のレコードが作成され、そのレコードのidが参照先となる。
            $table->integer('office_id')->unsigned()->index();
            
            //roleはmanagerとviewerがある。新規登録した場合は自動的にmanagerとなる。
            $table->string('role')->index();
            
            //1月の最大労働時間
            $table->integer('monthly_max_workhours');
            
            //出勤日の最大労働時間
            $table->integer('daily_max_workhours');
            
            //出勤日の最低労働時間
            $table->integer('daily_min_workhours');
            
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->rememberToken();
            $table->timestamps();
            
            // 外部キー設定
            $table->foreign('office_id')->references('id')->on('offices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
