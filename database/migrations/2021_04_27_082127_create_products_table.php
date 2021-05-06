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
        if (!Schema::hasTable('products')){
            Schema::create('products', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('company_id');
                $table->string('product_name', 50);
                $table->integer('price');
                $table->integer('stock');
                $table->text('comment');
                $table->string('product_img');
                $table->timestamps();
            });
        }
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
