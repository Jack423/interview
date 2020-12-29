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
            $table->integer('ZipCode')->primary()->unique();
            $table->string('City')->nullable();
            $table->string('MixedCity')->nullable();
            $table->char('StateCode', '2')->nullable();
            $table->integer('StateFIPS')->nullable();
            $table->string('County')->nullable();
            $table->string('MixedCounty')->nullable();
            $table->integer('CountyFIPS')->nullable();
            $table->decimal('Latitude', '8', '6')->nullable();
            $table->decimal('Longitude', '9', '6')->nullable();
            $table->integer('GMT')->nullable();
            $table->char('DST', '1')->nullable();
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
