<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRequestedProductsTable extends Migration
{
    public function up()
    {
        Schema::table('requested_products', function (Blueprint $table) {
            $table->unsignedInteger('product_id');
            $table->foreign('product_id', 'product_fk_2320140')->references('id')->on('products');
        });
    }
}
