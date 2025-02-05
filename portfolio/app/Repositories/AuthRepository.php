<?php

namespace App\Repositories;

use App\Repositories\Support\AbstractRepository;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthRepository extends AbstractRepository
{
    public function model()
    {
        return User::class;
    }

    public function login(array $credentials)
    {
        try {
            if (!Auth::attempt($credentials)) {
                return [
                    'success' => false,
                    'message' => 'Email hoặc mật khẩu không chính xác'
                ];
            }

            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return [
                'success' => true,
                'user' => $user,
                'token' => $token
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Đăng nhập thất bại: ' . $e->getMessage()
            ];
        }
    }

    public function register(array $data)
    {
        try {
            $data['password'] = Hash::make($data['password']);
            $user = $this->create($data);

            return [
                'success' => true,
                'user' => $user
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Đăng ký thất bại: ' . $e->getMessage()
            ];
        }
    }

    public function logout()
    {
        try {
            Auth::user()->tokens()->delete();
            Auth::logout();

            return [
                'success' => true,
                'message' => 'Đăng xuất thành công'
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Đăng xuất thất bại: ' . $e->getMessage()
            ];
        }
    }
}
