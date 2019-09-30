<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('orders', static function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->tinyInteger('floor')->unsigned();
            $table->timestamp('ordered_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->tinyInteger('elevator_id')->unsigned()->nullable();
            $table->timestamp('arrived_at')->nullable();
            $table->integer('iteration')->unsigned()->nullable();

            $table->foreign('elevator_id')
                ->references('id')
                ->on('elevators')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
}
