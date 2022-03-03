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
             $table->renameColumn('session_id', 'training_session_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coach_sessions', function (Blueprint $table) {
            $table->renameColumn('training_session_id', 'session_id');
        });
    }
};
