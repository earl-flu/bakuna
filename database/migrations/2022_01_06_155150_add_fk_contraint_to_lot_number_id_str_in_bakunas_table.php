<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkContraintToLotNumberIdStrInBakunasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bakunas', function (Blueprint $table) {
            $table->foreign('lot_number_id')
                ->references('code')
                ->on('lot_numbers')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bakunas', function (Blueprint $table) {
            $table->dropForeign(['lot_number_id']);
        });
    }
}
