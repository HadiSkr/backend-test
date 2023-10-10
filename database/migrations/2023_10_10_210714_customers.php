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
        Schema::create('customers', function (Blueprint $table) {
            $table->id('customer_id');
            $table->string('name')->nullable();
            $table->string('city');
            $table->string('status')->default("pending"); 
            $table->integer('phone')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->string('bank_name');
            $table->integer('bank_number')->nullable();
            $table->string('image');
            $table->decimal('latitude', 10, 7)->nullable(); #من اجل الموقع
            $table->decimal('longitude', 10, 7)->nullable(); #من اجل الموقغ
            $table->timestamps();
            $table->unsignedBigInteger('service_id')->nullable();
            $table->unsignedBigInteger('specific_service_id')->nullable();
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('specific_service_id')->references('id')->on('specific_services')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};