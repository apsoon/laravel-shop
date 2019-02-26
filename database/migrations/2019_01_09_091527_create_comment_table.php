<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment', function (Blueprint $table) {
            $table->increments('id');
            $table->string("user_id");
            $table->integer("sku_id")->index();
            $table->string("order_sn")->comment("订单号");
            $table->text("content");
            $table->string("images")->nullable();
            $table->integer("sort_order")->default(0)->comment("排序");
            $table->tinyInteger("state")->default(0)->comment("状态");
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
        Schema::dropIfExists('comment');
    }
}
