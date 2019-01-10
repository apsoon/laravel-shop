<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->increments('id');
            $table->string("consignee")->default("")->comment("收件人姓名");
            $table->string("phone")->default("");
            $table->string("post_code")->default("");
            $table->string("country")->default("");
            $table->string("province")->default("");
            $table->string("city")->default("");
            $table->string("county")->default("");
            $table->string("address_detail")->default("");
            $table->tinyInteger("is_default")->default(0);
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
        Schema::dropIfExists('address');
    }
}
