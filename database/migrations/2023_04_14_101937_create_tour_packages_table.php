<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(true);
            $table->date('date_start')->nullable(true);
            $table->date('date_end')->nullable(true);
            $table->unsignedBigInteger('city_id')->nullable(true);
            $table->unsignedBigInteger('country_id')->nullable(true);

            $table->foreignId('claim_id')->constrained('claims')->onDelete('cascade');

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
        Schema::dropIfExists('tour_packages');
    }
}
