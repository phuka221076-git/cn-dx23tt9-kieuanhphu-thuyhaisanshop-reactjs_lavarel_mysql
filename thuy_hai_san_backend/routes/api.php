<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Admin\AdminDashboardController;

/*
|--------------------------------------------------------------------------
| API Routes - Hệ thống Thủy Hải Sản
|--------------------------------------------------------------------------
*/

// --- 1. PUBLIC ROUTES (Dành cho mọi đối tượng) ---
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::get('/categories-list', [CategoryController::class, 'index']); 

// ✅ Khách vãng lai và User đều có thể đặt hàng qua đây (ID 999999999)
Route::post('/orders', [OrderController::class, 'store']); 


// --- 2. PROTECTED ROUTES (Yêu cầu phải có Token) ---
Route::middleware('auth:sanctum')->group(function () {
    
    // Lấy thông tin tài khoản đang đăng nhập
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // --- DÀNH RIÊNG CHO USER/CUSTOMER ---
    Route::get('/my-orders', [OrderController::class, 'getUserOrders']);

    
    // --- 3. ADMIN ROUTES (CHỈ ADMIN MỚI ĐƯỢC VÀO) ---
    // Phú nên đảm bảo Controller đã check $user->role === 'admin' 
    // hoặc sử dụng Middleware tùy chỉnh.
    Route::prefix('admin')->group(function () {
        
        
        // 1. Quản lý Sản phẩm (Ưu tiên POST update lên đầu để xử lý ảnh)
        //Route::post('products/{id}', [ProductController::class, 'update']); // Bỏ dấu / ở đầu products
        
        Route::match(['get', 'post', 'put'], 'products/{id}', [ProductController::class, 'update']);
        Route::apiResource('products', ProductController::class)->except(['index', 'show', 'update']);
        
        // 2. Thống kê & Báo cáo
        Route::get('analytics', [AdminDashboardController::class, 'getAnalytics']);
        
        // 3. Quản lý đơn hàng
        Route::get('orders', [OrderController::class, 'index']);
        Route::patch('orders/{id}/status', [OrderController::class, 'updateStatus']);
        
        // 4. Quản lý Users
        Route::apiResource('users', UserController::class);
        Route::patch('users/{id}/status', [UserController::class, 'toggleStatus']);

        // 5. Quản lý Danh mục
        Route::apiResource('categories', CategoryController::class);
    
    });

});