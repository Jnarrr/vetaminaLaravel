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
            $table->string('username', 20)->unique();
            $table->string('password', 191);
            $table->string('registration_number', 50);
            $table->string('owner_name', 50);
            $table->string('clinic_name', 50);
            $table->string('phone_number', 20);
            $table->string('address', 100);
            $table->string('email', 100)->unique();
            $table->string('permit', 191);
            $table->string('verified')->default('false')->change();
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
