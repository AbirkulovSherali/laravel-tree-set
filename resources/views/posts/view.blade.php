@extends('layouts/main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12" style="margin-bottom: 20px">
                <h2>{{ $post['title'] }}</h2>
                <div id="view" postId="{{ $post['id'] }}">
                    {{ $post['text'] }}
                </div>
            </div>
            <div class="col-sm-6">
                <h3>Add a comment</h3>
            </div>
            <div class="col-sm-6">
                <h3>Comments</h3>
            </div>
            <div class="col-sm-6">
                @if(!Auth::check())
                    <div class="alert alert-primary" role="alert">
                        <h5>If you want to leave a comment you have to be logged in or registered )</h5>
                    </div>
                @else
                    <form action="/post/{{ $post['id'] }}" method="post">
                        <div class="form-group">
                            <textarea class="form-control {{ $errors->has('text') ? 'is-invalid' : '' }}" name="text" rows="10">{{ old('text') }}</textarea>
                            @if($errors->has('text'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('text') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Comment</button>
                        </div>
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="post_id" value="{{ $post['id'] }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                @endif
            </div>
            <div class="col-sm-6">
                @if(count($comments) > 0)
                    {{ commentRender($comments, Auth::check()) }}
                @else
                    <div class="alert alert-primary" role="alert">
                        <h5>There're no comments yet ;-(</h5>
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection
