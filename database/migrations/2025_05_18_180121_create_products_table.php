<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{

    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('pro_id');
            $table->string('pro_img');
            $table->string('pro_title_en');
            $table->string('pro_title_ar');
            $table->string('pro_description_en');
            $table->string('pro_description_ar');
            $table->decimal('original_price', 10, 2);
            $table->decimal('discount', 5, 2)->default(0);
            $table->decimal('net_price', 10, 2);
            $table->integer('quantity');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->timestamps();

            // 🔗 Add foreign key constraint
            $table->foreign('category_id')->references('cat_id')->on('categories')->onDelete('set null');
        });
    }


    public function down()
    {
        Schema::dropIfExists('products');
    }
}
