<?php

namespace App\Http\Controllers;

use App\Models\Elevator;
use App\Models\Order;
use Illuminate\Http\JsonResponse;

class ElevatorsStateController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $elevators = Elevator::all();
        $orders = Order::pending()->get();

        return response()->json(
            [
                'elevators' => $elevators,
                'orders' => $orders,
            ]
        );
    }
}
