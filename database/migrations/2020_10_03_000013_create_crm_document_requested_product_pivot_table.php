<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrmDocumentRequestedProductPivotTable extends Migration
{
    public function up()
    {
        Schema::create('crm_document_requested_product', function (Blueprint $table) {
            $table->unsignedInteger('crm_document_id');
            $table->foreign('crm_document_id', 'crm_document_id_fk_2320147')->references('id')->on('crm_documents')->onDelete('cascade');
            $table->unsignedInteger('requested_product_id');
            $table->foreign('requested_product_id', 'requested_product_id_fk_2320147')->references('id')->on('requested_products')->onDelete('cascade');
        });
    }
}
