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
            $table->string("name")->default("")->comment("优惠券名称");
            $table->string("code")->default("")->comment("优惠码");
            $table->tinyInteger("is_number_limit")->default(0)->comment("是否限制数量");
            $table->integer("number")->default(0)->comment("数量限制");
            $table->tinyInteger("send_type")->default("0")->comment("优惠券发放类型");
            $table->timestamp("send_start_time")->nullable()->comment("开始发放时间");
            $table->timestamp("send_end_time")->nullable()->comment("停止发放时间");
            $table->tinyInteger("use_time_type")->default(0)->comment("使用时间类型");
            $table->integer("effect_duration")->nullable()->comment("有效期");
            $table->timestamp("use_start_time")->nullable()->comment("允许使用开始时间");
            $table->timestamp("use_end_time")->nullable()->comment("允许使用结束时间");
            $table->tinyInteger("use_type")->default(0)->comment("使用类型");
            $table->decimal("use_min_value")->nullable()->comment("最低消费金额");
            $table->integer("use_min_amount")->nullable()->comment("最低购买数量");
            $table->tinyInteger("discount_type")->default(0)->comment("折扣类型");
            $table->decimal("discount_value")->nullable()->comment("折扣金额");
            $table->decimal("discount_ratio")->nullable()->comment("折扣比例");
            $table->tinyInteger("state")->default(0)->comment("状态");
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
