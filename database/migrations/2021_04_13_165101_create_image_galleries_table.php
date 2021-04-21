<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_galleries', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('img_path')->nullable();
            $table->string('slug',255)->unique();
            $table->integer('color_variation_id');
        });

        Schema::create('image_gallery_localizations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('image_id')->unsigned()->index();
            $table->string('lang', 2);
            $table->string('title',255);
            $table->foreign('image_id')->references('id')->on('image_galleries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('image_galleries');
    }
}
