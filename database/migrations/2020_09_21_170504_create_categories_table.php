<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('slug',255)->unique();
            $table->string('parent_id')->nullable();          
        });

        Schema::create('category_localizations', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('category_id')->unsigned()->index();
            $table->string('lang', 2);
            $table->string('title',255);
            $table->string('keywords',255)->nullable();
            $table->string('description',255)->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
