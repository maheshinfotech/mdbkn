<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlipnoToCanteensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('canteens', function (Blueprint $table) {
            $table->string('slipno')->nullable(); // Assuming 'slipno' is a string and can be nullable
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('canteens', function (Blueprint $table) {
            $table->dropColumn('slipno');
        });
    }
}
