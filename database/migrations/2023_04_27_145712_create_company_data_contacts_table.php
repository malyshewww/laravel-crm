<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyDataContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_data_contacts', function (Blueprint $table) {
            $table->id();

            $table->string('company_address')->nullable(true);
            $table->string('company_actual_address')->nullable(true);
            $table->string('company_director')->nullable(true);
            $table->string('company_phone')->nullable(true);
            $table->string('company_email')->nullable(true);

            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->on('companies')->references('id')->onDelete('cascade');

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
        Schema::dropIfExists('company_data_contacts');
    }
}
