<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsAttributeOptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_attribute_option', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("goods_id")->index()->comment("商品id");
            $table->integer("attribute_id")->comment("属性id");
            $table->integer("attribute_group_id")->comment("属性组id");
            $table->integer("attribute_option_id")->comment("属性选项id");
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
        Schema::dropIfExists('goods_attribute');
    }
}
