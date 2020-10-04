<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrmDocumentsTable extends Migration
{
    public function up()
    {
        Schema::create('crm_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->date('quotation_request_date')->nullable();
            $table->string('department_name')->nullable();
            $table->boolean('quotation_is_signed')->default(0)->nullable();
            $table->boolean('quotation_is_new')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
