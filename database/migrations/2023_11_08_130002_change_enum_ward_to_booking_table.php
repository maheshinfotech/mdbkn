<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeEnumWardToBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            \DB::statement("ALTER TABLE `bookings` CHANGE `ward_type` `ward_type` ENUM('ct','rt', 'o ward', 'cancer','report','other') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  NULL;");
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
