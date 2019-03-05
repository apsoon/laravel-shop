<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("position_id");
            $table->tinyInteger("key")->default(0);
            $table->string("name")->default("");
            $table->string("content")->nullable()->default("");
            $table->string("image_url")->default("");
            $table->tinyInteger("link_type")->default(0);
            $table->integer("skuId")->nullable()->default(0)->comment("SKU ID");
            $table->integer("sort_order")->default(0);
            $table->tinyInteger("state")->nullable(0);
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
        Schema::dropIfExists('ad');
    }
}
