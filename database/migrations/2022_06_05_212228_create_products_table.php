<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('name');
            $table->json('category')->nullable(true);
            $table->text('description')->nullable(true);
            $table->string('status')->nullable(true);;
            $table->boolean('favorite');
            $table->boolean('is_cotton');
            $table->json('photos')->nullable(true);
            $table->json('videos')->nullable(true);
            $table->tinyInteger('sale_percent')->nullable(true);
            $table->timestamps();
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
};
