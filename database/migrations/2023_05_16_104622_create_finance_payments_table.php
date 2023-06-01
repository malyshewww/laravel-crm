<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_payments', function (Blueprint $table) {
            $table->id();
            $table->string('currency')->nullable(true);
            $table->decimal('tourist_course', 11, 2)->unsigned()->nullable(true);
            $table->decimal('tour_price', 11, 2)->unsigned()->nullable(true);
            $table->decimal('comission_price', 11, 2)->unsigned()->nullable(true);

            $table->foreignId('claim_id')->onDelete('cascade')->constrained('claims');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('finance_payments');
    }
}
