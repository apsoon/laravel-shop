<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("order_id")->comment("订单id");
            $table->integer("product_id")->comment("产品id");
            $table->string("order_sn")->comment("订单编号");
            $table->string("product_sn")->comment("产品sn号");
            $table->string("name")->default("")->comment("产品名称");
            $table->string("cover")->default("")->comment("产品封面图片");
            $table->decimal("origin_price")->default(0)->comment("产品原价");
            $table->decimal("price")->default(0)->comment("商品价格");
            $table->integer("number")->default(0)->comment("商品数量");
            $table->timestamp("created_at")->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        DB::statement("ALTER TABLE `order_product` comment'订单-产品对应表'"); // 表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_product');
    }
}
