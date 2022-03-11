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
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->BigInteger('gym_id')->unsigned()->nullable();
            $table->foreign('gym_id')->references('id')->on('gyms')->onDelete('set null');

            $table->BigInteger('city_id')->unsigned()->nullable();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null');

            $table->BigInteger('package_id')->unsigned()->nullable();
            $table->foreign('package_id')->references('id')->on('training_packages')->onDelete('set null');;
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
