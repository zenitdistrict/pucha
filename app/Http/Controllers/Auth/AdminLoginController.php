<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{

    public function __construct() {
        $this->middleware('guest:admin');
    }

    public function showLoginForm() {
        return view('auth.admin_login');
    }

    public function login(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::guard('admin')->attempt($credentials, $request->remember)){
            return redirect()->intended(route('admin.dashboard'));
        };

        return redirect()->back()->withInput($request)->only('email', 'remember');
    }
}
