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




            // 'product_id' => $product['id'],
            // 'sku' => $faker->word,
            // 'name' => $productFaker->productName,
            // 'url_key' => $urlKey,
            // 'new' => $new,
            // 'featured' => $feature,
            // 'visible_individually' => $visibleIndividually,
            // 'min_price' => $faker->numberBetween($min = 100, $max = 200),
            // 'max_price' => $faker->numberBetween($min = 200, $max = 500),
            // 'parent_id' => $parentId,
            // 'status' => 1,
            // 'color' => 1,
            // 'price' => $price,
            // 'width' => null,
            // 'height' =>null,
            // 'depth' => null,
            // 'meta_title' => '',
            // 'meta_keywords' => '',
            // 'meta_description' => '',
            // 'weight' => null,
            // 'color_label' => 'Red',
            // 'size' => null,
            // 'size_label' => null,
            // 'short_description' => '<p>' . $description . '</p>',
            // 'description' => '<p>' . $description . '</p>',
            // 'channel' => $channelCode,
            // 'locale' => $localeCode,
            // 'special_price' => null,
            // 'special_price_from' => null,
            // 'special_price_to' => null,
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