<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuelSurchangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuel_surchanges', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('fuelsurchange_name')->nullable(true);
            $table->date('fuelsurchange_date_start')->nullable(true);
            $table->date('fuelsurchange_date_end')->nullable(true);

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
        Schema::dropIfExists('fuel_surchanges');
    }
}
