@extends('layouts/main')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-5">
                @if(Session::has('flashMessage'))
                    <div class="alert alert-danger flashMessage" role="alert">
                        <h5 style="margin: 0">{{ Session::get('flashMessage') }}</h5>
                    </div>
                @endif
                <h3>Login</h3>
                <form action="/login" method="post">
                    <div class="form-group">
                        <label for="email"><b>Email:</b></label>
                        <input id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" value="{{ old('email') }}">
                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="password"><b>Password:</b></label>
                        <input id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" value="{{ old('password') }}">
                        @if($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="remember_me" class="form-check-label" style="padding-left: 0">
                            Remember me
                            <input class='btn' id="remember_me" type="checkbox" name="remember_me">
                        </label>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
            </div>
        </div>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection
