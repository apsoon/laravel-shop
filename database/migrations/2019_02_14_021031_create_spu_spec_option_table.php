<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpuSpecOptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spu_spec_option', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("spu_id")->comment("SPUId");
            $table->integer("spec_id")->comment("SPECId");
            $table->string("name")->comment("可选项内容");
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
        Schema::dropIfExists('spu_spec_option');
    }
}
