@extends('layout')

@section('content')
    <h1>Статистика вызовов на этаж</h1>
    <table class="table">
        <thead>
        <tr>
            <th></th>
            <th colspan="{{ config('app.elevators_count') }}" class="text-center">Лифты</th>
        </tr>
        <tr>
            <th>Этажи</th>
            @foreach(range(1, config('app.elevators_count')) as $elevator)
                <th class="text-center">{{ $elevator }}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach(range(1, config('app.floors_count')) as $floor)
            <tr>
                <td>{{ $floor }}</td>
                @foreach(range(1, config('app.elevators_count')) as $elevator)
                    <td class="text-center">
                        {{ optional($stats->where('floor', $floor)->where('elevator_id', $elevator)->first())->visits ?? 0 }}
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
