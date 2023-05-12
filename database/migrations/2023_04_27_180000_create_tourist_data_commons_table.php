<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTouristDataCommonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tourist_data_commons', function (Blueprint $table) {
            $table->id();

            $table->string('tourist_gender')->nullable(false);
            $table->string('tourist_surname_lat')->nullable(true);
            $table->string('tourist_name_lat')->nullable(true);
            $table->string('tourist_nationality')->nullable(false);
            $table->string('tourist_birthday')->nullable(false);
            $table->string('tourist_address')->nullable(true);
            $table->string('tourist_phone')->nullable(true);
            $table->string('tourist_email')->nullable(true);
            $table->string('visa_info')->nullable(false);
            $table->string('visa_city')->nullable(true);

            $table->foreignId('tourist_id')->onDelete()->constrained('tourists');

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
        Schema::dropIfExists('tourist_data_commons');
    }
}
