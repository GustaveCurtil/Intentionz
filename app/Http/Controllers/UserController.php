<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request, $slug = null){
        //If you enter via a slugged link!
        $inputs = $request->validate([
            'name' => 'required', 
            'password' => 'required',
            'password-check' => 'required'
        ]);


        if ($inputs['password'] === $inputs['password-check']) {
            $inputs['password'] = bcrypt($inputs['password']);
            $user = User::create($inputs);
            auth()->login($user);
        }

        return redirect('/' . $slug);
    }

    public function login(Request $request) {
        $inputs = $request->validate([
            'name' => 'required', 
            'password' => 'required'
        ]);
        if (auth()->attempt(['name' => $inputs['name'], 'password' => $inputs['password']])) {
            $request->session()->regenerate();
        }
        return redirect('/');
    }

    public function logout() {
        auth()->logout();
        return redirect('/');
    }

    public function deleteAccount() {
        $user = Auth::user();

        if ($user) {
            $user->delete();
            Auth::logout();
        }
        return redirect('/');
    }


}

