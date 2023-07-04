<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonDataCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_data_certificates', function (Blueprint $table) {
            $table->id();
            $table->integer('person_certificate_series')->nullable(true);
            $table->integer('person_certificate_number')->nullable(true);
            $table->date('person_certificate_date')->nullable(true);
            $table->text('person_certificate_issued')->nullable(true);

            $table->foreignId('person_id')->constrained('persons')->onDelete('cascade');

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
        Schema::dropIfExists('person_data_certificates');
    }
}
