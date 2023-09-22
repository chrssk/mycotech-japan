<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FinishGood extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finish_good', function(Blueprint $table){
            $table->id();
            $table->string('FinishGoodCode')->unique();
            $table->unsignedBigInteger('HarvestID');
            $table->foreign('HarvestID')->references('id')->on('mylea_harvest')->onDelete('cascade');
            $table->integer('Total');
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
