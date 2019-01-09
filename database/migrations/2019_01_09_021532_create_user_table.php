<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string("user_id")->comment("用户id");
            $table->string("open_id")->comment("openId");
            $table->string("token")->comment("token");
            $table->string("nickname")->comment("昵称");
            $table->string("avatar_url")->comment("头像地址");
            $table->string("phone")->comment("电话");
            $table->tinyInteger("is_auth")->comment("用户是否授权");
            $table->timestamp("create_time")->useCurrent();
            $table->timestamp('update_time')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
