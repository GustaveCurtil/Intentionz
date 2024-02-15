<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request, $slug = null){
        
        $inputs = $request->validate([
            'name' => 'required', 
            'password' => 'required',
            'password-check' => 'required'
        ]);

        $user = User::where('name', $inputs['name'])->first();

        if ($user) {
            dd("De gebruikersnaam '" . $inputs['name'] . "' is al in gebruik");
        }

        if ($inputs['password'] === $inputs['password-check']) {
            $inputs['password'] = bcrypt($inputs['password']);
            $user = User::create($inputs);
            auth()->login($user);
        } else {
            dd("De wachtwoorden komen niet overeen...");
        }
        
        return redirect('/' . $slug);
    }

    public function login(Request $request, $slug = null) {
        $inputs = $request->validate([
            'name' => 'required', 
            'password' => 'required'
        ]);

        $user = User::where('name', $inputs['name'])->first();

        if (!$user) {
            dd("'" . $inputs['name'] . "' zit niet in de database bro");
        }

        if (auth()->attempt(['name' => $inputs['name'], 'password' => $inputs['password']])) {
            $request->session()->regenerate();
        }

        return redirect('/' . $slug);
    }

    public function logout() {
        $user = Auth::user(); // om te vermijden dat het na vanzelf afmelden door timeout, we een error krijgen bij afmelden
        if ($user) {

            auth()->logout();
        }
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

