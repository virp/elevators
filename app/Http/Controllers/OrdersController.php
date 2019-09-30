<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $this->validate($request, [
            'floor' => 'required|min:1|max:'.config('app.floors_count')
        ]);

        Order::makeTo($request->input('floor'));

        return response()->json(['status' => 'OK']);
    }
}
