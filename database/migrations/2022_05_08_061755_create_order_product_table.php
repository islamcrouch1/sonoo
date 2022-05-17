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
        Schema::create('order_product', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->integer('product_type');
            $table->integer('order_id');
            $table->integer('stock_id');
            $table->double('selling_price', 8, 2);
            $table->double('commission_per_item', 8, 2);
            $table->double('profit_per_item', 8, 2);
            $table->double('vendor_price', 8, 2);
            $table->double('total_selling_price', 8, 2);
            $table->double('total_commission', 8, 2);
            $table->integer('quantity');
            $table->string('size_ar');
            $table->string('size_en');
            $table->string('color_ar');
            $table->string('color_en');
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
        Schema::dropIfExists('order_product');
    }
};
