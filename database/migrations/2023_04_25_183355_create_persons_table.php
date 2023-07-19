<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->string('person_surname')->nullable(false);
            $table->string('person_name')->nullable(false);
            $table->string('person_patronymic')->nullable(true);

            $table->string('person_gender')->nullable(false);
            $table->string('person_surname_lat')->nullable(true);
            $table->string('person_name_lat')->nullable(true);
            $table->string('person_nationality')->nullable(false);
            $table->string('person_birthday')->nullable(false);
            $table->text('person_address')->nullable(true);
            $table->string('person_phone')->nullable(true);
            $table->string('person_email')->nullable(true);

            $table->integer('person_passport_series')->nullable(true);
            $table->integer('person_passport_number')->nullable(true);
            $table->string('person_passport_date')->nullable(true);
            $table->text('person_passport_issued')->nullable(true);
            $table->string('person_passport_code')->nullable(true);
            $table->string('person_passport_address')->nullable(true);

            $table->integer('person_certificate_series')->nullable(true);
            $table->integer('person_certificate_number')->nullable(true);
            $table->date('person_certificate_date')->nullable(true);
            $table->text('person_certificate_issued')->nullable(true);

            $table->integer('person_international_passport_series')->nullable(true);
            $table->integer('person_international_passport_number')->nullable(true);
            $table->date('person_international_passport_date')->nullable(true);
            $table->date('person_international_passport_period')->nullable(true);
            $table->text('person_international_passport_issued')->nullable(true);

            $table->unsignedBigInteger('claim_id');
            $table->foreign('claim_id')->references('id')->on('claims')->onDelete('cascade');

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
        Schema::dropIfExists('persons');
    }
}
