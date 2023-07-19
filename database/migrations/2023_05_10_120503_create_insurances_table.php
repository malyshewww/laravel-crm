<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsurancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurances', function (Blueprint $table) {
            $table->id();

            $table->string('type');
            $table->string('insurance_name')->nullable(true);
            $table->string('insurance_company')->nullable(true);
            $table->string('insurance_type')->nullable(true);
            $table->string('insurance_type_other')->nullable(true);
            $table->date('dateinsurance_start')->nullable(true);
            $table->date('dateinsurance_end')->nullable(true);
            $table->string('insurance_sum')->nullable(true);

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
        Schema::dropIfExists('insurances');
    }
}
