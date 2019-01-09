<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("parent_id")->default(0)->comment("父级分类id");
            $table->string("name")->default("")->comment("名称");
            $table->tinyInteger("level")->default(1)->comment("级别");
            $table->string("image_url")->default("")->comment("图片地址");
            $table->tinyInteger("sort_order")->default(1)->comment("排序");
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
        Schema::dropIfExists('category');
    }
}
