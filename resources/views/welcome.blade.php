@extends('layouts/main')
@section('content')
    <div class="container">
        <div class="jumbotron text-center">
            <h1 class="date">{{ gmdate('d.m.Y H:i:s', time() + 3 * 3600) }}</h1>
            <h1 class="display-3">Laravel Home Page</h1>
            <br class="my-4">
            <img src="{{ asset('img/LaravelLogo.png') }}" style="width: 50%">
        </div>
    </div>
@endsection
