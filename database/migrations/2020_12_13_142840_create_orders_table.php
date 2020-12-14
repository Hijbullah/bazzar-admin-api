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

            $table->string('billing_email')->nullable();
            $table->string('billing_name')->nullable();
            $table->string('billing_phone')->nullable();
            $table->string('billing_city')->nullable();
            $table->string('billing_address')->nullable();
          
            $table->float('billing_subtotal');
            $table->float('billing_tax')->nullable();
            $table->unsignedInteger('total_quantity');
            $table->float('billing_total'); 

            $table->string('payment_method')->default('cod');
            $table->boolean('payment_status')->default(false);

            $table->enum('status', ['pending', 'cancelled', 'received', 'delivered'])->default('pending');

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
