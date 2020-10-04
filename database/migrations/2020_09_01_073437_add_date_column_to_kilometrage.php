<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateColumnToKilometrage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kilometrages', function (Blueprint $table) {
            $table->DateTime('date',0);
            $table->integer('km_avant');
            $table->integer('dernier_km');
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
        Schema::table('kilometrages', function (Blueprint $table) {
            $table->dropColumn('date');
            $table->dropColumn('km_avant');
            $table->dropColumn('dernier_km');
            $table->dropForeign('user_id');
        
        });
    }
}
