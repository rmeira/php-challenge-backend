<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiporderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shiporder_items', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('shiporder_id');
            $table->foreign('shiporder_id')
                ->references('id')
                ->on('shiporders')
                ->onDelete('cascade');

            $table->string('title');
            $table->string('note')->nullable();
            $table->integer('quantity')->default(0);
            $table->float('price')->default(0);

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
        Schema::dropIfExists('shiporder_items');
    }
}
