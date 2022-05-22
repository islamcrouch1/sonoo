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
            $table->integer('vendor_id');
            $table->integer('admin_id')->nullable();
            $table->string('status')->default('pending');
            $table->integer('country_id');
            $table->string('name_en');
            $table->string('name_ar');
            $table->string('sku')->nullable();
            $table->text('description_en');
            $table->text('description_ar');
            $table->double('vendor_price', 8, 2)->default(0);
            $table->double('max_price', 8, 2)->default(0);
            $table->double('extra_fee', 8, 2)->default(0);
            $table->double('price', 8, 2)->default(0);
            $table->double('total_profit', 8, 2)->default(0);
            $table->integer('unlimited')->default(0);
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
