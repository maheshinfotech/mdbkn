<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('room_id')->nullable();
            $table->string('guest_name')->nullable();
            $table->string('guest_father_name')->nullable();
            $table->string('guest_cast')->nullable();
            $table->string('guest_address')->nullable();
            $table->string('patient_name')->nullable();
            $table->string('patient_ward_no')->nullable();
            $table->string('patient_bed_no')->nullable();
            $table->string('advance_payment')->nullable();
            $table->dateTime('check_in_time')->nullable();
            $table->dateTime('check_out_time')->nullable();
            $table->string('estimated_total_days')->nullable();
            $table->integer('age')->nullable();
            $table->string('city')->nullable();
            $table->string('docter_name')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('id_number')->nullable();
            $table->string('tehsil')->nullable();
            $table->string('relation_patient')->nullable();
            $table->enum('ward_type',['ct','rt'])->nullable();
            $table->string('payable_rent')->nullable();
            $table->string('base_rent')->nullable();
            $table->string('paid_rent')->nullable();
            $table->text('extra_remark')->nullable();
            $table->string('is_parking_provided')->nullable();
            $table->time('base_check_in_time')->nullable();
            $table->time('base_check_out_time')->nullable();
            $table->string('base_grace_period')->nullable();
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade')->onUpdate('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('bookings');
    }
}
