@extends('layout')

@section('content')
    <h1>Управление лифтами</h1>
    <elevators :floors-count="{{ config('app.floors_count') }}"
               :elevators-count="{{ config('app.elevators_count') }}"
               :elevators-speed="{{ config('app.elevators_speed') }}"></elevators>
@endsection
