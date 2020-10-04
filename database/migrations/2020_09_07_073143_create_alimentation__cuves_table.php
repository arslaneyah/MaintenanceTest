<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlimentationCuvesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alimentation_cuves', function (Blueprint $table) {
            $table->id();
            $table->foreignid('cuve_id')->constrained()->onDelete('cascade');
            $table->datetime('date');
            $table->float('quantite');
            $table->foreignid('user_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('alimentation_cuves');
    }
}
