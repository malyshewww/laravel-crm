<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();

            $table->string('type');
            $table->string('transfer_route')->nullable(true);
            $table->datetime('datetransfer_start')->nullable(true);
            $table->datetime('datetransfer_end')->nullable(true);
            $table->string('transfer_type')->nullable(true);
            $table->string('transfer_transport')->nullable(true);

            $table->unsignedBigInteger('claim_id');
            $table->foreign('claim_id')->on('claims')->references('id')->onDelete('cascade');
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
        Schema::dropIfExists('transfers');
    }
}
