@extends('layouts/main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Add post</h2>
                <form class="createPost" action="/posts" method="post">
                    <div class="form-group">
                        <label for="title"><b>Title:</b></label>
                        <input id="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" value="{{ old('title') }}">
                        @if($errors->has('title'))
                            <div class="invalid-feedback">
                                {{ $errors->first('title') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="text"><b>Text:</b></label>
                        <textarea id="text" class="form-control {{ $errors->has('text') ? 'is-invalid' : '' }}" name="body" rows="10">{{ old('body') }}</textarea>
                        @if($errors->has('body'))
                            <div class="invalid-feedback">
                                {{ $errors->first('body') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Add post</button>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
            </div>
            <div class="col-md-6">
                <h2>Posts</h2>
                <ul id="posts">
                    @foreach($posts as $post)
                        <li><a href="/post/{{ $post['id'] }}">{{ $post['title'] }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
