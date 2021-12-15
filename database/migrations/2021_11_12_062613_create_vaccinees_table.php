<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVaccineesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaccinees', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('govt_id_number')->nullable();
            $table->boolean('pwd')->default(0);
            $table->boolean('indigenous_member')->default(0);
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('suffix')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('region');
            $table->string('province');
            $table->string('municipality');
            $table->string('barangay');
            $table->string('sex');
            $table->date('birthdate');
            $table->date('schedule')->nullable();
            $table->string('registration_type'); //walk in or online
            //create new table for deferral - vaccinee might be defer for multiple times
            // $table->boolean('deferral')->nullable();
            // $table->text('deferral_reason')->nullable();

            //create new table for this 'bakuna' table
            // $table->date('vaccination_date')->nullable();
            // $table->string('vaccine_name')->nullable();
            // $table->string('batch_number')->nullable();
            // $table->string('lot_number')->nullable();
            // $table->string('bakuna_center_cbcr_id')->nullable();
            // $table->string('vaccinator_name')->nullable();
            // $table->string('vaccine_shot')->nullable();
            // $table->boolean('adverse_event')->nullable();
            // $table->text('adverse_event_condition')->nullable();

            $table->string('occupation')->nullable();

            //attendace/pre registration is not important - will do this later
            // $table->boolean('in_attendance')->default(0);
            //set this automatically when the in_attendance is set to true(attendance = true)
            // $table->dateTime('attended_at')->nullable();

            //attendance remarks sana
            // $table->text('remarks')->nullable();
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
        Schema::dropIfExists('vaccinees');
    }
}
