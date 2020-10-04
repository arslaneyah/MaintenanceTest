<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGasoilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gasoils', function (Blueprint $table) {
            $table->id();
            $table->foreignid('vehicule_id')->constrained()->onDelete('cascade');
            $table->foreignid('kilometrage_id')->constrained()->onDelete('cascade');
            $table->float('litres');
            $table->float('prix');
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
        Schema::dropIfExists('gasoils');
    }
}
