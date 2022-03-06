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
        Schema::table('coach_sessions', function (Blueprint $table) {
            $table->foreignId('training_session_id')->references('id')->on('training_sessions')->onDelete('cascade');
            $table->foreignId('coach_id')->references('id')->on('coaches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coaches_sessions', function (Blueprint $table) {
            //
        });
    }
};