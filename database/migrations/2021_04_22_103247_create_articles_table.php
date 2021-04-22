<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('slug',255)->unique();
            $table->boolean('custom')->default(false);
            $table->string('img_path')->nullable();
        });

        Schema::create('article_localizations', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('article_id')->unsigned()->index();
            $table->string('lang', 2);
            $table->string('title',255);
            $table->text('content')->nullable();
            $table->string('keywords',255)->default(NULL)->nullable();
            $table->string('description',255)->default(NULL)->nullable();   
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
