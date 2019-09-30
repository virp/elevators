@extends('layout')

@section('content')
    <div class="d-flex justify-content-between">
        @if($filter)
            <h1>Итерации движения лифта #{{ $filter }}</h1>
        @else
            <h1>Итерации движения лифтов</h1>
        @endif
        <div class="form-inline">
            <div class="input-group">
                <select name="elevator" id="elevator" class="custom-select" data-url="{{ route('iterations') }}">
                    <option selected disabled>&mdash; Лифт &mdash;</option>
                    @foreach(range(1, config('app.elevators_count')) as $elevator)
                        <option value="{{ $elevator }}" {{ $elevator == $filter ? 'selected' : '' }}>
                            {{ $elevator }}
                        </option>
                    @endforeach
                </select>
                @if($filter)
                    <div class="input-group-append">
                        <a href="{{ route('iterations') }}" class="btn btn-outline-secondary">
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
            @unless($filter)
                <th>Лифт</th>
            @endunless
            <th>Итерация</th>
            <th class="w-100">Движения</th>
        </tr>
        </thead>
        <tbody>
        @foreach($iterations as $iteration)
            <tr>
                @unless($filter)
                    <td>{{ $iteration->elevator_id }}</td>
                @endunless
                <td>{{ $iteration->iteration }}</td>
                <td>{{ $iteration->floors }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $iterations->appends(['elevator' => $filter])->links() }}
    </div>
@endsection
