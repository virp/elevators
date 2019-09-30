<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrdersController extends Controller
{
    public function index(Request $request): View
    {
        $orders = Order::completed()->orderByDesc('ordered_at');

        if ($elevator = $request->input('elevator')) {
            $orders = $orders->where('elevator_id', $elevator);
        }

        $orders = $orders->paginate(50);

        return view(
            'orders',
            [
                'orders' => $orders,
                'filter' => $elevator ?? null,
            ]
        );
    }

    public function store(Request $request): JsonResponse
    {
        $this->validate(
            $request,
            [
                'floor' => 'required|min:1|max:'.config('app.floors_count'),
            ]
        );

        Order::makeTo($request->input('floor'));

        return response()->json(['status' => 'OK']);
    }
}
