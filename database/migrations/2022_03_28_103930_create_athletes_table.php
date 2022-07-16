<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAthletesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('athletes', function (Blueprint $table) {
            $table->id();
            $table->text('surname');
            $table->text('lastname');
            $table->integer('age');
            $table->integer('height');
            $table->integer('weight');
            $table->integer('sportexperience');
            $table->integer('frequency');
            $table->integer('sleeptime')->nullable();
            $table->boolean('incompatibility');
            $table->integer('actualkcal');
            $table->integer('level');
            $table->integer('aim');
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
        Schema::dropIfExists('athletes');
    }
}
