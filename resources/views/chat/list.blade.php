@extends('layouts/main')
@section('content')
    <div class="container">
        <ul class="users">
            @foreach($users as $user)
                <li><a href="/chat/chat-with/{{ $user->id }}">{{ $user->name }}</a></li>
            @endforeach
        </ul>
    </div>
@endsection
