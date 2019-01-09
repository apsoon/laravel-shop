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
            $table->integer("category_id")->nullable();
            $table->integer("brand_id")->nullable();
            $table->string("name");
            $table->string("brief")->comment("简述");
            $table->string("unit")->comment("单位");
            $table->integer("number")->comment("库存");
            $table->decimal("origin_price")->comment("原始价格");
            $table->decimal("price")->comment("价格");
            $table->string("image_url")->comment("图片地址");
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
