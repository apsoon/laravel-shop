<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderSkuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_sku', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("sku_id")->comment("产品id");
            $table->string("name")->comment("sku Name");
            $table->string("order_sn")->comment("订单编号");
            $table->decimal("price")->comment("价格");
            $table->decimal("total")->comment("总价");
            $table->integer("number")->default(0)->comment("商品数量");
            $table->timestamp("created_at")->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        DB::statement("ALTER TABLE `order_sku` comment'订单-SKU对应表'"); // 表注释
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_sku');
    }
}
