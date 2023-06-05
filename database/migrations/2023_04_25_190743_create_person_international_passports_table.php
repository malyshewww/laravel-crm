<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonInternationalPassportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_international_passports', function (Blueprint $table) {
            $table->id();

            $table->integer('person_international_passport_series')->nullable(true);
            $table->integer('person_international_passport_number')->nullable(true);
            $table->date('person_international_passport_date')->nullable(true);
            $table->date('person_international_passport_period')->nullable(true);
            $table->text('person_international_passport_issued')->nullable(true);

            $table->foreignId('person_id')->onDelete()->constrained('persons');

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
        Schema::dropIfExists('person_international_passports');
    }
}
