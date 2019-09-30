<?php

namespace App\Http\Controllers;

use App\Models\Iteration;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IterationsController extends Controller
{
    public function __invoke(Request $request): View
    {
        $iterations = Iteration::query();

        if ($elevator = $request->input('elevator')) {
            $iterations = $iterations->where('elevator_id', $elevator);
        }

        $iterations = $iterations->paginate(50);

        return view(
            'iterations',
            [
                'iterations' => $iterations,
                'filter' => $elevator ?? null,
            ]
        );
    }
}
