<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\UserController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// --- 1. PUBLIC ROUTES ---
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
// Route này dùng cho khách xem danh mục ở trang chủ
Route::get('/categories-list', [CategoryController::class, 'index']); 

Route::post('/orders', [OrderController::class, 'store']); 


// --- 2. PROTECTED ROUTES (Yêu cầu Token) ---
Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::put('/products/{id}', [ProductController::class, 'update']);

    // Quản lý đơn hàng
    Route::get('my-orders', [OrderController::class, 'myOrders']);
    Route::get('/orders', [OrderController::class, 'index']);
    Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus']);

    // Quản lý Users
    Route::apiResource('users', UserController::class);
    Route::patch('/users/{id}/status', [UserController::class, 'toggleStatus']);

    // --- SỬA LỖI TẠI ĐÂY ---
    // Xóa .except(['index']) để trang Admin có thể lấy danh sách danh mục
    Route::apiResource('categories', CategoryController::class);
    
    // Quản lý sản phẩm (Trừ index/show đã để ở Public)
    Route::apiResource('products', ProductController::class)->except(['index', 'show']);
});