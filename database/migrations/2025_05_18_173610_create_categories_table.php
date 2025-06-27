<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id('cat_id');
            $table->string('cat_image');
            $table->string('cat_title_en');
            $table->string('cat_title_ar');
            $table->string('cat_description_en');
            $table->string('cat_description_ar');
            $table->decimal('discount',10,2)->default(0);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
