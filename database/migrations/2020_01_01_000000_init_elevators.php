<?php

use App\Models\Elevator;
use App\Models\Order;
use Illuminate\Database\Migrations\Migration;

class InitElevators extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * @throws Exception
     */
    public function up(): void
    {
        $floorsCount = config('app.floors_count');
        for ($i = 0, $elevatorsCount = config('app.elevators_count'); $i < $elevatorsCount; $i++) {
            $floor = random_int(1, $floorsCount);
            Elevator::create(['floor' => $floor]);
            Order::makeTo($floor);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        //
    }
}
