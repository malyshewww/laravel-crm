<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancePrepaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_prepayments', function (Blueprint $table) {
            $table->id();
            $table->float('percent', 6, 2)->unsigned()->nullable(true);
            $table->tinyInteger('days')->unsigned()->nullable(true);

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
        Schema::dropIfExists('finance_prepayments');
    }
}
