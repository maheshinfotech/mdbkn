<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->integer('floor_number')->nullable();
            $table->integer('room_number')->nullable();
            $table->boolean('is_booked')->nullable();
            $table->text('extra_remark')->nullable();
            $table->date('booked_date')->nullable();
            $table->string('guest_capacity')->nullable();
            $table->foreign('category_id')->references('id')->on('room_categories')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('rooms');
    }
}
