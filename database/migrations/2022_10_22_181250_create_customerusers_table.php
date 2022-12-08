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
        Schema::create('customerusers', function (Blueprint $table) {
            $table->id();
            $table->string('username', 100)->unique();
            $table->string('birthdate', 100);
            $table->string('password', 100);
            $table->string('email', 100);
            $table->string('mobile_number', 100);
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
        Schema::dropIfExists('customerusers');
    }
};
