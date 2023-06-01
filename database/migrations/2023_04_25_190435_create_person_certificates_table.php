<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_certificates', function (Blueprint $table) {
            $table->id();
            $table->integer('person_certificate_series')->nullable(true);
            $table->integer('person_certificate_number')->nullable(true);
            $table->date('person_certificate_date')->nullable(true);
            $table->text('person_certificate_issued')->nullable(true);

            $table->unsignedBigInteger('person_id');
            $table->foreign('person_id')->on('persons')->references('id')->onDelete('cascade');

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
        Schema::dropIfExists('person_certificates');
    }
}
