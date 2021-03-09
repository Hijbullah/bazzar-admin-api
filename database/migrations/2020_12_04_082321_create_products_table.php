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

            $table->enum('product_type', ['simple', 'variable']);

            $table->string('name');
            $table->string('slug', 100)->unique();
            $table->longText('description')->nullable();

            $table->unsignedInteger('quantity')->nullable();
            $table->float('price', 8, 2)->nullable();
            $table->json('images')->nullable();

            $table->boolean('is_popular')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_flash_sale')->default(false);
            $table->boolean('is_spa')->default(false);

            $table->float('discount', 8, 1)->nullable();
            $table->float('price_after_discount', 8, 2)->nullable();

            $table->json('variations')->nullable();

            $table->string('meta_title')->nullable();
            $table->json('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();

            $table->enum('stock_status', ['in_stock', 'low', 'out_of_stock']);
            $table->boolean('status')->default(false);

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
