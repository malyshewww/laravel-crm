<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_fullname')->nullable(true);
            $table->string('company_shortname')->nullable(true);
            $table->string('company_kpp')->nullable(true);
            $table->string('company_inn')->nullable(true);
            $table->string('company_ogrn')->nullable(true);
            $table->string('company_bank')->nullable(true);
            $table->string('company_bik')->nullable(true);
            $table->string('company_rs')->nullable(true);
            $table->string('company_ks')->nullable(true);
            $table->string('company_address')->nullable(true);
            $table->string('company_actual_address')->nullable(true);
            $table->string('company_director')->nullable(true);
            $table->string('company_phone')->nullable(true);
            $table->string('company_email')->nullable(true);

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
        Schema::dropIfExists('companies');
    }
}
