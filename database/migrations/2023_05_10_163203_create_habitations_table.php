<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHabitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habitations', function (Blueprint $table) {
            $table->id();

            $table->string('type');
            $table->string('habitation_name')->nullable(true);
            $table->string('habitation_resort')->nullable(true);
            $table->string('habitation_hotel')->nullable(true);
            $table->string('habitation_hotel_address')->nullable(true);
            $table->string('habitation_type_number')->nullable(true);
            $table->string('habitation_type_placement')->nullable(true);
            $table->string('habitation_type_food')->nullable(true);
            $table->datetime('datehabitation_start')->nullable(true);
            $table->datetime('datehabitation_end')->nullable(true);

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
        Schema::dropIfExists('habitations');
    }
}
