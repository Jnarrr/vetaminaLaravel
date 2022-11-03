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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('user_id', 50);
            $table->string('pet_name', 50);
            $table->string('pet_type', 20);
            $table->string('pet_sex', 10);
            $table->string('pet_breed', 20);
            $table->string('pet_birthdate', 20);
            $table->string('pet_weight', 20);
            $table->string('pet_description', 200);
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
        Schema::dropIfExists('pets');
    }
};
