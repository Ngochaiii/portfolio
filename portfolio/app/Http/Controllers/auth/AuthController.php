<?php

namespace App\Http\Controllers\auth;

use App\Repositories\AuthRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function showLoginForm()
    {
        return view('source.admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $result = $this->authRepository->login($credentials);

        if ($result['success']) {
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors([
            'email' => $result['message'],
        ]);
    }

    public function logout()
    {
        $this->authRepository->logout();
        return redirect('/login');
    }
}
