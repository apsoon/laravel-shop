<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spu', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("category_id")->comment("分类id");
            $table->integer("brand_id")->comment("品牌id");
            $table->integer("list_price")->comment("列表价");
            $table->string("name")->comment("SPU名称");
            $table->string("brief")->comment("简述");
            $table->string("cover")->nullable()->comment("商品封面图片");
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
        Schema::dropIfExists('spu');
    }
}
