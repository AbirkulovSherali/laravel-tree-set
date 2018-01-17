<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct(){
        $this->middleware('throttle')->only('login');
        $this->middleware('IfLoggedIn')->except('logout');
    }

    public function login(Request $request){
        View::share('link', 'login');

        if($request->isMethod('post')){
            $remember = $request->has('remember_me') ? true : false;
            $this->validate($request, [
                'email' => 'required|min:6',
                'password' => 'required'
            ], [
                'required' => 'Это поле должно быть заполнено!',
                'email.min' => 'Это поле должно содержать не менее 6 символов!'
            ]);

            if(Auth::attempt([
                'email' => $request->email,
                'password' => $request->password,
            ], $remember)){
                return redirect('/');
            } else {
                $request->session()->flash('flashMessage', 'Incorrect email address or password!');
                return redirect('/login')->withInput(
                    $request->except('password')
                );
            }
        }

        return view('user/login');
    }

    public function registration(Request $request){
        View::share('link', 'register');

        if($request->isMethod('post')){
            $this->validate($request, [
                'name' => 'required|min:2',
                'email' => 'required|unique:users',
                'password' => 'required|confirmed',
                'password_confirmation' => 'required'
            ], [
                'required' => 'Это поле должно быть заполнено!',
                'name.min' => 'Имя должно состоять не менее чем из 2-х символов!',
                'email.unique' => 'Такой адрес электронной почты уже существует!',
                'password.confirmed' => 'Пароли не совпадают!'
            ]);

            $lastInsertId = User::insertGetId([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);

            Auth::loginUsingId($lastInsertId);

            return redirect('/');
        };

        return view('user/register');
    }

    public function logout(){
        Auth::logout();
        return back();
    }

}
