@extends('layouts/main')
@section('content')
    <div class="container">
        <h3>Chat with {{ $user->name }}</h3>
        <chat
            to-user-name="{{ $user->name }}"
            to-user-id="{{ $user->id }}">
        </chat>
    </div>
@endsection
