<?php

namespace App\Http\Controllers;

use App\Models\Stat;
use Illuminate\View\View;

class StatsController extends Controller
{
    public function __invoke(): View
    {
        $stats = Stat::all();

        return view('stats', ['stats' => $stats]);
    }
}
