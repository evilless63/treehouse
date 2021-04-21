<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sizes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('slug',255)->unique();
        });

        Schema::create('size_localizations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('size_id')->unsigned()->index();
            $table->string('lang', 2);
            $table->string('title',255);
            $table->foreign('size_id')->references('id')->on('sizes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sizes');
    }
}
