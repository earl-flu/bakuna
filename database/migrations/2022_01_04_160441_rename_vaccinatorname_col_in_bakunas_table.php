<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameVaccinatornameColInBakunasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bakunas', function (Blueprint $table) {
            $table->renameColumn('vaccinator_name', 'vaccinator_id');
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
            $table->renameColumn('vaccinator_id', 'vaccinator_name');
        });
    }
}
