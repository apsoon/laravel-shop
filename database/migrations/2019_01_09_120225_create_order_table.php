<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->string("user_id");
            $table->string("sn");
            $table->decimal("price")->comment("总价格");
            $table->decimal("discount")->comment("折扣");
            $table->string("consignee")->default("")->comment("收件人姓名");
            $table->string("phone")->default("");
            $table->string("post_code")->default("");
            $table->string("country")->default("");
            $table->string("province")->default("");
            $table->string("city")->default("");
            $table->string("county")->default("");
            $table->string("address_detail")->default("");
            $table->integer("coupon_id")->nullable();
            $table->integer("address_id")->nullable();
            $table->tinyInteger("status")->comment("订单状态");
            $table->timestamp("create_time")->comment("订单创建时间");
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
        Schema::dropIfExists('order');
    }
}
