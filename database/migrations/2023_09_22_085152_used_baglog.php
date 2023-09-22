<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UsedBaglog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('used_baglog', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('MyleaID');
            $table->foreign('MyleaID')->references('id')->on('mylea_production')->onDelete('cascade');
            $table->unsignedBigInteger('BaglogID');
            $table->foreign('BaglogID')->references('id')->on('baglog')->onDelete('cascade');
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
