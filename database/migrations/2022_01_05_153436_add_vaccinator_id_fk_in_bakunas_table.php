<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVaccinatorIdFkInBakunasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bakunas', function (Blueprint $table) {
            $table->foreignId('vaccinator_id')
                ->nullable()
                ->after('vaccination_date')
                ->constrained()
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
            $table->dropForeign(['vaccinator_id']);
            $table->dropColumn('vaccinator_id');
        });
    }
}
