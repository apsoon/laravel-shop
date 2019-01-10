<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->increments('id');
            $table->string("user_id");
            $table->integer("goods_id");
            $table->string("goods_name")->default("");
            $table->integer("number")->default(0);
            $table->integer("product_id");
            $table->string("specification_ids")->default("");
            $table->string("specification_values")->default("");
            $table->string("image_url")->default("");
            $table->decimal("origin_price")->default(0);
            $table->decimal("price")->default(0);
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
        Schema::dropIfExists('cart');
    }
}
