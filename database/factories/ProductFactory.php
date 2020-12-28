<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->sentence();
        $price = $this->faker->numberBetween(100, 2000);

        return [
            'category_id' => $this->faker->numberBetween(7, 28),
            'name' => $name,
            'slug' => Str::slug(Str::limit($name, 100, '')),
            'short_description' => $this->faker->text(250),
            'description' => $this->faker->text(500),
            'quantity' => $this->faker->numberBetween(10, 100),
            'sale_price' => $price,
            'price_show' => $price,
            'images' => [
                'products/2ncGtP2NptOnQrueGj17RicD7LbZFlT6q58lUnt9.jpg',
                'products/aGNNO4zkLtmoZTlHLrekfEuKDeSEPlZtMYA0Y4pu.jpg',
                'products/Poy2QlF7QYD22lg9kywU2OphRF8TvykS4LCqtKdc.jpg',
                'products/Lm8rNSMGRJHRiYrZDnXy4txm8kdAPohZBHGcQdIC.jpg'
            ]
        ];
    }
}
