<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name")->default("");
            $table->integer("number")->default(0);
            $table->tinyInteger("send_type")->default("0");
            $table->timestamp("send_start_time")->nullable();
            $table->timestamp("send_end_time")->nullable();
            $table->tinyInteger("use_time_type")->default(0);
            $table->integer("effect_duration")->nullable();
            $table->timestamp("use_start_time")->nullable();
            $table->timestamp("use_end_time")->nullable();
            $table->tinyInteger("use_type")->default(0);
            $table->decimal("use_min_value")->nullable();
            $table->integer("use_min_amount")->nullable();
            $table->tinyInteger("discount_type")->default(0);
            $table->decimal("discount_value")->nullable();
            $table->decimal("discount_ratio")->nullable();
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
        Schema::dropIfExists('coupon');
    }
}
