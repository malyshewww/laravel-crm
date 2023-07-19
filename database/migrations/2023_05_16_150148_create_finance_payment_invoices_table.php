<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancePaymentInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_payment_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('calculate')->nullable(true);
            $table->decimal('sum', 11, 2)->unsigned()->nullable(true);
            $table->string('currency')->nullable(true);
            $table->datetime('date_invoices')->nullable(true);

            $table->unsignedBigInteger('claim_id');
            $table->foreign('claim_id')->on('claims')->references('id')->onDelete('cascade');
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
        Schema::dropIfExists('finance_payment_invoices');
    }
}
