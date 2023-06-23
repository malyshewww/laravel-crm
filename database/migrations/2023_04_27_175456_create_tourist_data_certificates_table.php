<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTouristDataCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tourist_data_certificates', function (Blueprint $table) {
            $table->id();
            $table->integer('tourist_certificate_series')->nullable(true);
            $table->integer('tourist_certificate_number')->nullable(true);
            $table->date('tourist_certificate_date')->nullable(true);
            $table->text('tourist_certificate_issued')->nullable(true);

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
        Schema::dropIfExists('tourist_data_certificates');
    }
}
