<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonCommonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_commons', function (Blueprint $table) {
            $table->id();
            $table->string('person_gender')->nullable(false);
            $table->string('person_surname_lat')->nullable(true);
            $table->string('person_name_lat')->nullable(true);
            $table->string('person_nationality')->nullable(false);
            $table->string('person_birthday')->nullable(false);
            $table->text('person_address')->nullable(true);
            $table->string('person_phone')->nullable(true);
            $table->string('person_email')->nullable(true);

            $table->foreignId('person_id')->onDelete()->constrained('persons');

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
        Schema::dropIfExists('person_commons');
    }
}
