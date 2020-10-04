<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestedProductsTable extends Migration
{
    public function up()
    {
        Schema::create('requested_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantity');
            $table->float('price', 15, 2);
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
