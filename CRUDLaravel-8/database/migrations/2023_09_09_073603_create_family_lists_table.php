<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_list', function (Blueprint $table) {
            $table->bigIncrements('fl_id')->uniqid()->nullable();
            $table->unsignedBigInteger('cst_id')->unsigned()->nullable();
            $table->foreign('cst_id')->references('cst_id')->on('customer')->onDelete('cascade');;
            $table->string('fl_relation',50)->nullable();
            $table->string('fl_name',50)->nullable(); 
            $table->date('fl_dob')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('family_list');
    }
}
