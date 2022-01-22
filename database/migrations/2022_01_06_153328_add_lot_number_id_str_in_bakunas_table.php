<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLotNumberIdStrInBakunasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bakunas', function (Blueprint $table) {
            $table->string('lot_number_id')
                ->nullable()
                ->after('manufacturer_name');
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
            $table->dropColumn('lot_number_id');
        });
    }
}
