<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('slug',255)->unique();
            $table->string('sku',255)->nullable();
            $table->string('code',255)->nullable();
        });

        Schema::create('product_localizations', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('product_id')->unsigned()->index();
            $table->string('lang', 2);
            $table->string('title',255);
            $table->string('unit',255)->default(NULL)->nullable();
            $table->text('content')->nullable();
            $table->string('keywords',255)->default(NULL)->nullable();
            $table->string('description',255)->default(NULL)->nullable();
            $table->text('details')->nullable();           
            $table->text('care')->nullable();       
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
