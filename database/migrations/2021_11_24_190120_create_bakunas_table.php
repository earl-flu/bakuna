<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBakunasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bakunas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vaccinee_id')
                ->constrained()
                ->onUpdate('cascade');
            $table->string('category')->nullable();
            $table->string('philhealth_num')->nullable();
            $table->string('contact')->nullable();
            $table->string('guardian_pedia')->nullable();
            $table->boolean('is_comorbidity')->dafault(0);
            $table->string('comorbidity')->nullable();
            $table->date('vaccination_date')->nullable();
            $table->string('vaccinator_name');
            $table->string('vaccine_shot'); //first dose, second dose, booster shot
            $table->string('manufacturer_name'); //e.g. AZ, J&J, Sinovac, etc..
            $table->string('lot_number');
            $table->string('batch_number');
            // $table->dateTime('vaccination_date');
            $table->string('bakuna_center_cbcr_id');
            $table->boolean('deferred')->default(0);
            $table->string('deferral_reason')->nullable();
            $table->boolean('adverse_event')->default(0);
            $table->text('adverse_event_condition')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('bakunas');
    }
}
