<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PostTreatmentDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_treatment_details', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('PostTreatmentID');
            $table->foreign('PostTreatmentID')->references('id')->on('post_treatment')->onDelete('cascade');
            $table->unsignedBigInteger('HarvestID');
            $table->foreign('HarvestID')->references('id')->on('mylea_harvest')->onDelete('cascade');
            $table->integer('Total')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
