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
            $table->string('transfer_route_start')->nullable(true);
            $table->string('transfer_route_end')->nullable(true);
            $table->datetime('datetransfer_start')->nullable(true);
            $table->datetime('datetransfer_end')->nullable(true);
            $table->string('transfer_type')->nullable(true);
            $table->string('transfer_transport_start')->nullable(true);
            $table->string('transfer_transport_end')->nullable(true);

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
        Schema::dropIfExists('transfers');
    }
}
