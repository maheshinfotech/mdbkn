<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToBookingTale extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->unsignedBigInteger('hospital_id')->nullable();
            $table->foreign('hospital_id')->references('id')->on('hospitals')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('ward_id')->nullable();
            $table->foreign('ward_id')->references('id')->on('wards')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('patient_type',['cancer','non-cancer'])->nullable();
            $table->boolean('is_admitted')->nullable();
            $table->enum('gender',['male','female','other'])->nullable();
            \DB::statement("ALTER TABLE `bookings` CHANGE `ward_type` `ward_type` ENUM('ct','rt','cancer','report','other') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  NULL;");
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
