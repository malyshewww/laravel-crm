<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTouristDataPassportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tourist_data_passports', function (Blueprint $table) {
            $table->id();
            $table->integer('tourist_passport_series')->nullable(true);
            $table->integer('tourist_passport_number')->nullable(true);
            $table->string('tourist_passport_date')->nullable(true);
            $table->text('tourist_passport_issued')->nullable(true);
            $table->string('tourist_passport_code')->nullable(true);
            $table->string('tourist_passport_address')->nullable(true);

            $table->foreignId('tourist_id')->constrained('tourists')->onDelete('cascade');

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
        Schema::dropIfExists('tourist_data_passports');
    }
}
