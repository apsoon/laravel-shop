<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name")->default("")->comment("名称");
            $table->string("brand_id")->default("")->comment("品牌编号");
            $table->string("region")->nullable()->default("")->comment("地区");
            $table->string("logo")->nullable()->default("")->comment("LOGO");
            $table->text("describe")->nullable()->comment("描述");
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
        Schema::dropIfExists('brand');
    }
}
