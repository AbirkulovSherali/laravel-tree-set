@extends('layouts/main')
@section('content')
    <div class="container">
        <div class="col-md-6">
            <h1>The category and its children</h1>
            <ul class="root">
                {{ HTMListTree($categories) }}
            </ul>
        </div>
    </div>
@endsection
