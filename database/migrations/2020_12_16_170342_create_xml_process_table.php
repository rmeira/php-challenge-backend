<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXmlProcessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xml_process', function (Blueprint $table) {
            $table->id();
            $table->string('file');
            $table->enum('table', ['people', 'shiporders']);
            $table->boolean('processed')->default(false);
            $table->boolean('errors')->default(false);
            $table->timestamp('processed_at')->nullable();
            $table->text('details')->nullable();
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
        Schema::dropIfExists('xml_process');
    }
}
