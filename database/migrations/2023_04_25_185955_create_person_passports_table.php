<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonPassportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_passports', function (Blueprint $table) {
            $table->id();
            $table->integer('person_passport_series')->nullable(true);
            $table->integer('person_passport_number')->nullable(true);
            $table->string('person_passport_date')->nullable(true);
            $table->text('person_passport_issued')->nullable(true);
            $table->string('person_passport_code')->nullable(true);
            $table->string('person_passport_address')->nullable(true);

            $table->foreignId('person_id')->nullable()->constrained('persons')->onDelete('cascade');

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
        Schema::dropIfExists('person_passports');
    }
}
