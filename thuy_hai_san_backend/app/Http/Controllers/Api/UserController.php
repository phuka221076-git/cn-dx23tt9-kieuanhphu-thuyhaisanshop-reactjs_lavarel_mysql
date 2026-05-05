<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Lấy danh sách + Tìm kiếm Name/Email/Phone theo yêu cầu
    public function index(Request $request) {
        $search = $request->query('search');

        $users = User::when($search, function ($query, $search) {
            return $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        })
        ->orderBy('id', 'desc')
        ->get();

        return response()->json($users);
    }

    // Thêm mới tài khoản
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => $request->role,
            'is_active' => $request->is_active ?? 1
        ]);

        return response()->json($user, 201);
    }

    // Cập nhật thông tin chi tiết (Bao gồm Enable/Disable)
    public function update(Request $request, $id) {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'role' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 422);
        }

        $data = $request->only(['name', 'email', 'phone', 'address', 'role']);
        
        // Ép kiểu is_active về integer cho DB tinyint
        $data['is_active'] = filter_var($request->is_active, FILTER_VALIDATE_BOOLEAN) ? 1 : 0;

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return response()->json(['message' => 'Thành công', 'user' => $user]);
    }

    // Xóa tài khoản
    public function destroy($id) {
        User::findOrFail($id)->delete();
        return response()->json(['message' => 'Đã xóa']);
    }
}