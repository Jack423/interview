<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->integer('ZipCode')->primary();
            $table->string('City');
            $table->string('MixedCity');
            $table->char('StateCode', '2');
            $table->integer('StateFIPS');
            $table->string('County');
            $table->string('MixedCounty');
            $table->integer('CountyFIPS');
            $table->decimal('Latitude', '8', '6');
            $table->decimal('Longitude', '9', '6');
            $table->integer('GMT');
            $table->char('DST', '1');
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
        Schema::dropIfExists('data');
    }
}
