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
        Schema::create('bought_packages', function (Blueprint $table) {

            $table->id();
            $table->string('name');
            $table->integer('price');
            $table->integer('number_of_sessions');

            // $table->integer('packege_id');

            // $table->integer('user_id');

            // $table->integer('gym_id');

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
        Schema::dropIfExists('bought_package');
    }
};
