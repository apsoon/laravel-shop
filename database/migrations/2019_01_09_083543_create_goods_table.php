<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->string("goods_id")->comment("商品编号");
            $table->integer("category_id")->nullable();
            $table->integer("brand_id")->nullable();
            $table->string("name")->comment("商品名称");
            $table->string("brief")->comment("简述");
            $table->string("unit")->comment("单位");
            $table->integer("number")->comment("库存");
            $table->decimal("origin_price")->comment("原始价格");
            $table->decimal("price")->comment("价格");
            $table->string("cover")->comment("商品封面图片");
            $table->tinyInteger("state")->comment("商品状态");
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
        Schema::dropIfExists('goods');
    }
}
