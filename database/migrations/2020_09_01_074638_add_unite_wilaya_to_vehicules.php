<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUniteWilayaToVehicules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vehicules', function (Blueprint $table) {
            $table->integer('annee') ;
            $table->foreignid('unite_id')->constrained()->onDelete('cascade');
            $table->foreignid('wilaya_id')->constrained()->onDelete('cascade');
            $table->foreignid('kilometrage_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vehicules', function (Blueprint $table) {
            $table->dropColumn('annee');
            $table->dropForeign('unite_id');
            $table->dropForeign('wilaya_id');
            $table->dropForeign('kilometrage_id');
            $table->dropForeign('user_id');
        });
    }
}
