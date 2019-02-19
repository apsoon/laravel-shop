<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpuAttrValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spu_attr_value', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("spu_id")->index()->comment("spu Id");
            $table->integer("attr_id")->comment("属性id");
            $table->integer("attr_group_id")->comment("属性组id");
            $table->integer("value")->comment("属性值");
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
        Schema::dropIfExists('spu_attr_value');
    }
}
