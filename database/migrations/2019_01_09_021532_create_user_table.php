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
            $table->string("user_id")->comment("用户id")->index();
            $table->string("open_id")->comment("openId")->index();
            $table->string("token")->comment("token");
            $table->string("nickname")->default("")->comment("昵称");
            $table->string("avatar_url")->default("")->comment("头像地址");
            $table->string("phone")->default("")->comment("电话");
            $table->tinyInteger("is_auth")->comment("用户是否授权");
            $table->timestamp("created_at")->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
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
