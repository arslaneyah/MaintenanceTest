<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropPrixColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gasoils', function (Blueprint $table) {
            $table->dropColumn('prix');
            $table->foreignid('fournisseur_id')->constrained()->onDelete('cascade');

        });    
        Schema::table('fournisseurs', function (Blueprint $table) {
            $table->boolean('etat');

        });    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gasoils', function (Blueprint $table) {
        $table->dropForeign('fournisseur_id');
        }); 
        Schema::table('fournisseurs', function (Blueprint $table) {
            $table->dropColumn('etat');

        });    }
}
