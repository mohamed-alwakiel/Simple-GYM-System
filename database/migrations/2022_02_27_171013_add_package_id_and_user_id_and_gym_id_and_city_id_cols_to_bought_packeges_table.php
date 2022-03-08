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
        Schema::table('bought_packages', function (Blueprint $table) {
            $table->foreignId('package_id')->references('id')->on('training_packages');

            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->foreignId('gym_id')->references('id')->on('gyms')->onDelete('cascade');

            $table->foreignId('city_id')->references('id')->on('cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bought_packeges', function (Blueprint $table) {
            //
        });
    }
};
