<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->text('de_name');
            $table->text('en_name');
            $table->text('fr_name');
            $table->text('es_name');
            $table->double('kcal');
            $table->double('carbs');
            $table->double('protein');
            $table->double('fat');
            $table->double('amount');
            $table->text('unity');
            $table->boolean('lactose_intolerance')->default(false);
            $table->boolean('gluten_intolerance')->default(false);
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
        Schema::dropIfExists('ingredients');
    }
}
