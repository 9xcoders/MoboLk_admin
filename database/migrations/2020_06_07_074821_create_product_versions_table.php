<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_versions', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id', 12)->unique();
            $table->string('name');
            $table->string('slug')->unique();
            $table->integer('product_id');
            $table->decimal("price", 12, 2)->nullable();
            $table->decimal("off_price", 12, 2)->nullable();
            $table->longText('features')->nullable();
            $table->boolean('in_stock')->default(false);
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
        Schema::dropIfExists('product_versions');
    }
}
