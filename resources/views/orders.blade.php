@extends('layout')

@section('content')
    <div class="d-flex justify-content-between">
        @if ($filter)
            <h1>Вызовы лифта #{{ $filter }}</h1>
        @else
            <h1>Вызовы лифтов</h1>
        @endif
        <div class="form-inline">
            <div class="input-group">
                <select name="elevator" id="elevator" class="custom-select" data-url="{{ route('orders') }}">
                    <option selected disabled>&mdash; Лифт &mdash;</option>
                    @foreach(range(1, config('app.elevators_count')) as $elevator)
                        <option value="{{ $elevator }}" {{ $elevator == $filter ? 'selected' : '' }}>
                            {{ $elevator }}
                        </option>
                    @endforeach
                </select>
                @if($filter)
                    <div class="input-group-append">
                        <a href="{{ route('orders') }}" class="btn btn-outline-secondary">
                            &times;
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th class="text-center">Этаж</th>
            <th class="text-right">Время вызова</th>
            @unless($filter)
                <th class="text-center">Лифт</th>
            @endunless
            <th class="text-right">Время подачи лифта</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td class="text-center">{{ $order->floor }}</td>
                <td class="text-right">{{ $order->ordered_at->format('d.m.Y H:i:s') }}</td>
                @unless($filter)
                    <td class="text-center">{{ $order->elevator_id }}</td>
                @endunless
                <td class="text-right">{{ $order->arrived_at->format('d.m.Y H:i:s') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $orders->appends(['elevator' => $filter])->links() }}
    </div>
@endsection
