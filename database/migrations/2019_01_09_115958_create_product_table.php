<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("goods_id");
            $table->string("specification_ids")->nullable();
            $table->string("specification_values")->nullable();
            $table->decimal("origin_price")->default(0);
            $table->decimal("price")->default(0);
            $table->integer("number")->default(0);
            $table->string("image_url")->default("");
            $table->tinyInteger("state")->default(0);
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
        Schema::dropIfExists('product');
    }
}
