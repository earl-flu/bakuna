<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['name', 'email_verified_at']);
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->boolean('is_super_admin')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name');
            $table->timestamp('email_verified_at')->nullable();
            $table->dropColumn([
                'first_name', 'middle_name',
                'last_name', 'is_super_admin',
            ]);
        });
    }
}
