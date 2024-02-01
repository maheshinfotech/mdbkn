<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateforeignkeysToBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['hospital_id']);
            $table->dropForeign(['ward_id']);
            $table->foreign('hospital_id')->references('id')->on('hospitals')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('ward_id')->references('id')->on('wards')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            //
        });
    }
}
