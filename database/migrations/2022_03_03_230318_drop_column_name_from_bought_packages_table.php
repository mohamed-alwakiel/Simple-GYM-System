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
        
            if (Schema::hasColumn('bought_packages', 'name')){
                Schema::table('bought_packages', function (Blueprint $table) {
    
                    $table->dropColumn('name');
                });
            }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bought_packages', function (Blueprint $table) {
            //
        });
    }
};
