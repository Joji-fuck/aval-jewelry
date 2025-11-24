<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function index(){
        $title = 'Профиль';
        $profile = auth()->user();
        return view('user.index', compact('title','profile'));
    }
    public function indexUpdate(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|min:2',
            'surname' => 'required|string|min:2',
            'patronymic' => 'nullable|string|min:2',
            'email' => 'nullable|string|email|max:255|unique:users,email,' . auth()->id(),
            'phone' => 'nullable|string|min:11',
        ]);
        auth()->user()->update($validated);
        return back()->with('success', 'Профиль обновлен');
    }
    public function address(){
        $title = 'Профиль';
        $profile = auth()->user();
        return view('user.address', compact('title','profile'));
    }
    public function addressUpdate(Request $request){
        $validated = $request->validate([
            'country' => 'nullable|string|min:2',
            'city' => 'nullable|string|min:2',
            'street' => 'nullable|string|min:2',
            'house_number' => 'nullable|string',
            'zip_code' => 'nullable|integer|min:6'
        ]);
        auth()->user()->update($validated);
        return back()->with('success', 'Профиль обновлен');
    }
    public function passwordReset(){
        $title = 'Профиль';
        $profile = auth()->user();
        return view('user.password', compact('title','profile'));
    }
    public function passwordResetUpdate(Request $request){
        $validated = $request->validate([
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6'
        ]);
        auth()->user()->update([
            'password' => Hash::make($validated['password'])
        ]);
        return back()->with('success', 'Пароль успешно изменен');
    }
    public function history(){
        $title = 'Профиль';
        $profile = auth()->user();
        return view('user.history', compact('title','profile'));
    }
}
