<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAfterSaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('after_sale', function (Blueprint $table) {
            $table->increments('id');
            $table->string("user_id")->comment("userId");
            $table->string("sn")->comment("售后编号");
            $table->string("order_sn")->comment("订单编号");
            $table->string("reason")->comment("申请原因");
            $table->text("describe")->comment("描述");
            $table->tinyInteger("state")->comment("售后状态");
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
        Schema::dropIfExists('after_sale');
    }
}
