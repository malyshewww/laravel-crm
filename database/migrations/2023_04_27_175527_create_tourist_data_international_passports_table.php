<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTouristDataInternationalPassportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tourist_data_international_passports', function (Blueprint $table) {
            $table->id();

            $table->integer('tourist_international_passport_series')->nullable(true);
            $table->integer('tourist_international_passport_number')->nullable(true);
            $table->date('tourist_international_passport_date')->nullable(true);
            $table->date('tourist_international_passport_period')->nullable(true);
            $table->text('tourist_international_passport_issued')->nullable(true);

            $table->foreignId('tourist_id')->onDelete()->constrained('tourists');

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
        Schema::dropIfExists('tourist_data_international_passports');
    }
}
