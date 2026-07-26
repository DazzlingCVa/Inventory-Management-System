<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Show Login Page
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Check Login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)
                    ->where('status', 'Active')
                    ->first();

        if (!$user) {

            return back()->with('error', 'Invalid Email');

        }

        if (!Hash::check($request->password, $user->password)) {

            return back()->with('error', 'Invalid Password');

        }

        session([
            'user_id' => $user->id,
            'name'    => $user->name,
            'role'    => $user->role,
        ]);

        return redirect()->route('admin.dashboard');
    }

    /**
     * Logout
     */
    public function logout()
    {
        session()->flush();

        return redirect()->route('login');
    }
}