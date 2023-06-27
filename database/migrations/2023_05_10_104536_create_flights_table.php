<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('flight_route')->nullable(true);
            $table->string('flight_start')->nullable(true);
            $table->string('flight_end')->nullable(true);
            $table->string('flight_aviacompany')->nullable(true);
            $table->string('flight_class')->nullable(true);
            $table->string('flight_number')->nullable(true);
            $table->datetime('dateflight_start')->nullable(true);
            $table->datetime('dateflight_end')->nullable(true);

            $table->unsignedBigInteger('claim_id');
            $table->foreign('claim_id')->on('claims')->references('id')->onDelete('cascade');

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
        Schema::dropIfExists('flights');
    }
}
