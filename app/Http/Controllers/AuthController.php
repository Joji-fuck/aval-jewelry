<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function loginIndex(){
        $title = 'Вход';
        return view('auth.login', compact('title'));
    }
    public function loginStore(Request $request){
        $validatedData = $request->validate([
            'identity' => 'required|string',
            'password' => 'required|string',
        ]); //Валидация

        $credentials = [
            'password' => $validatedData['password']
        ]; //кидаем в инфу пароль

        $isEmail = filter_var($validatedData['identity'], FILTER_VALIDATE_EMAIL); //Это пиздец (проверка что нам подсунули)
        if ($isEmail) {
            $credentials['email'] = $validatedData['identity']; //мыло если мыло
        } else {
            $credentials['login'] = $validatedData['identity']; //логин если логин
        }
        //Аутентификация + проверочка на запоминание
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return to_route('home');
        }
        //ну ни палучилось, ну и ладна, похуй
        throw ValidationException::withMessages([
            'identity' => 'Что-то пошло не так...',
        ]);
    }

    public function registerIndex(){
        $title = 'Регистрация';
        return view('auth.register', compact('title'));
    }
    public function registerStore(Request $request){
        $validatedData = $request->validate([
            'surname' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'login' => 'required|string|unique:users',
            'password' => 'required|string|confirmed',
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);
        $user = User::create($validatedData);
        Auth::login($user);
        return to_route('home');
    }

    public function logout(){
        Auth::logout();
        return to_route('login.index');
    }
}
