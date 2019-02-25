<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpuGalleryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spu_gallery', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("spu_id")->index();
            $table->string("image_url");
            $table->integer("sort_order")->default(0);
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
        Schema::dropIfExists('spu_gallery');
    }
}
