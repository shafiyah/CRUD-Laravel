<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->bigIncrements('cst_id')->uniqid()->nullable();
            $table->unsignedBigInteger('nationality_id')->unsigned()->nullable();
            $table->foreign('nationality_id')->references('nationality_id')->on('nationality')->onDelete('cascade');;
            $table->string('cst_name',50)->nullable();
            $table->date('cst_dob')->nullable();
            $table->string('cst_phoneNum',20)->nullable(); 
            $table->string('cst_email',50)->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer');
    }
}
