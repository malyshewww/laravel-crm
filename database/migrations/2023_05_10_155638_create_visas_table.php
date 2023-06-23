<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visas', function (Blueprint $table) {
            $table->id();

            $table->string('type');
            $table->string('visa_name')->nullable(true);
            $table->string('visa_country')->nullable(true);
            $table->date('datevisa_start')->nullable(true);
            $table->date('datevisa_end')->nullable(true);

            $table->foreignId('claim_id')->onDelete('cascade')->constrained('claims');
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
        Schema::dropIfExists('visas');
    }
}
