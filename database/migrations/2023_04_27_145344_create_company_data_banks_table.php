<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyDataBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_data_banks', function (Blueprint $table) {
            $table->id();

            $table->string('company_bank')->nullable(true);
            $table->string('company_bik')->nullable(true);
            $table->string('company_rs')->nullable(true);
            $table->string('company_ks')->nullable(true);

            $table->foreignId('company_id')->onDelete()->constrained('companies');

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
        Schema::dropIfExists('company_data_banks');
    }
}
