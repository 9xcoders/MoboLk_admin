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
            $table->string('unique_id', 12)->unique();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('short_desc')->nullable();
            $table->longText('long_desc')->nullable();
            $table->decimal("price", 12, 2)->nullable();
            $table->decimal("off_price", 12, 2)->nullable();
            $table->boolean('in_stock')->default(false);
            $table->integer('category_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->text('keywords')->nullable();
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
}
