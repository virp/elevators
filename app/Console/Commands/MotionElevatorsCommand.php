<?php

namespace App\Console\Commands;

use App\Models\Elevator;
use App\Models\Order;
use Illuminate\Console\Command;

class MotionElevatorsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elevators:motion';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Move all elevators';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $speed = config('app.elevators_speed');

        while(true) {
            Elevator::inMotion()->get()->each->move();

            sleep($speed);

            $this->checkFirstFloor();
        }
    }

    private function checkFirstFloor(): void
    {
        if (!Elevator::inMotion()->exists() && !Elevator::onFloor(1)->exists()) {
            Order::makeTo(1);
        }
    }
}
