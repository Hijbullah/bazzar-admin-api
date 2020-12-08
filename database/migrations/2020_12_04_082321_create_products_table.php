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
            $table->foreignId('category_id')
                    ->constrained()
                    ->onDelete('cascade');

            $table->string('name');
            $table->string('slug', 100)->unique();
            $table->mediumText('short_description');
            $table->longText('description')->nullable();

            $table->unsignedInteger('quantity')->nullable();
            $table->float('sale_price', 8, 2)->nullable();
            $table->float('discount', 8, 1)->nullable();
            $table->float('price_show', 8, 2)->nullable();
            $table->json('images')->nullable();
            $table->boolean('status')->default(0);
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
