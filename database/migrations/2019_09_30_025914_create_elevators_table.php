<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElevatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * @throws Exception
     */
    public function up(): void
    {
        Schema::create('elevators', static function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->tinyInteger('floor')->unsigned();
            $table->tinyInteger('move_to')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('elevators');
    }
}
