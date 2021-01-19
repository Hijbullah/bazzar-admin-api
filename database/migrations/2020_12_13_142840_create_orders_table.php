<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code', 11)->unique();

            $table->foreignId('user_id')
                    ->nullable()
                    ->constrained()
                    ->onDelete('set null');

            $table->string('delivery_name');
            $table->string('delivery_email')->nullable();
            $table->string('delivery_phone');
            $table->string('delivery_city');
            $table->string('delivery_address');
          
            $table->float('subtotal');
            $table->float('delivery')->nullable();
            $table->unsignedInteger('total_quantity');
            $table->float('total'); 

            $table->string('payment_method')->default('cod');
            $table->boolean('payment_status')->default(false);

            $table->json('order_meta_data');

            $table->enum('status', ['received', 'processing', 'delivered', 'cancelled'])->default('received');

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
        Schema::dropIfExists('orders');
    }
}
