<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    public function show()
    {

        // return "This is the Register page ";
        return view('auth_custom.register'); // Bootstrap 5
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // Assign visitor role to the new user by default
        $visitorRole = Role::where('name', 'visitor')->first();
        if ($visitorRole) {
            $user->assignRole('visitor');
        }

        // Log the user in after registration
        Auth::login($user);

        return redirect()->route('home');
    }


}
