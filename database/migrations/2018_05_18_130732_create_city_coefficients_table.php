<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCityCoefficientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city_coefficients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('regions_id')->unsigned();
            $table->foreign('regions_id')
                ->references('id')
                ->on('regions')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('location');
            $table->float('auto');
            $table->float('tractor')->nullable();
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
        Schema::dropIfExists('city_coefficients');
    }
}
