<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExcursionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('excursions', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('excursion_name')->nullable(true);
            $table->string('excursion_description')->nullable(true);
            $table->date('excursion_date_start')->nullable(true);
            $table->date('excursion_date_end')->nullable(true);

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
        Schema::dropIfExists('excursions');
    }
}
