<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeColumnsNullableInParkingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parkings', function (Blueprint $table) {
            //
            $table->string('userphone')->nullable()->change();
            $table->string('vehicle_number')->nullable()->change();
            $table->text('remark')->nullable()->change();
            $table->dateTime('parking_start')->nullable()->change();
            $table->string('username')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('parkings', function (Blueprint $table) {
            //
            $table->string('userphone')->nullable(false)->change();
            $table->string('vehicle_number')->nullable(false)->change();
            $table->text('remark')->nullable(false)->change();
            $table->dateTime('parking_start')->nullable(false)->change();
            $table->string('username')->nullable(false)->change();

        });
    }
}
