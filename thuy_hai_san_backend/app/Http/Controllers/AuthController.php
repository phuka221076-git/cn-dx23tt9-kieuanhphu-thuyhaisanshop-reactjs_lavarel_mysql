<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone' => 'required',
            'address' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => 'user'
        ]);

        return response()->json(['message' => 'Đăng ký thành công!', 'user' => $user], 201);
    }

    public function login(Request $request) {
        

        // 1. Validate dữ liệu đầu vào
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Tìm người dùng theo email trước để kiểm tra trạng thái
        $user = \App\Models\User::where('email', $request->email)->first();

        // 3. KIỂM TRA KHÓA TRƯỚC (Đây là chỗ Bạn cần)
        if ($user && $user->is_active == 0) {
            return response()->json([
                'message' => 'Tài khoản của bạn đã bị khóa. Vui lòng liên hệ quản trị viên!'
            ], 403); 
        }

        // 4. KIỂM TRA MẬT KHẨU SAU
        // Chỉ dùng email và password để attempt thôi, không đưa is_active vào đây
        if (!\Illuminate\Support\Facades\Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Sai Email hoặc Mật khẩu rồi Bạn ơi!'
            ], 401);
        }

        // 5. Đăng nhập thành công
        $user = \Illuminate\Support\Facades\Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'user' => $user
        ]);
    }
}