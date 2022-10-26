<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinics', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('password');
            $table->string('registration_number');
            $table->string('owner_name');
            $table->string('clinic_name');
            $table->string('phone_number');
            $table->string('address');
            $table->string('email')->unique();
            $table->string('permit');
            $table->boolean('verified')->default('0')->change();
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
        Schema::dropIfExists('clinics');
    }
};