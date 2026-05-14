<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminDashboardController extends Controller 
{
    public function getAnalytics(Request $request)
    {
        // ✅ BƯỚC 1: KIỂM TRA QUYỀN ADMIN (CHỐNG LỖI TRUY CẬP BỊ TỪ CHỐI)
        // Sử dụng auth('sanctum')->user() để lấy thông tin từ admin_token
        $user = auth('sanctum')->user();

        if (!$user || $user->role !== 'admin') {
            return response()->json([
                'message' => 'Truy cập bị từ chối! Khu vực này chỉ dành riêng cho Quản trị viên.'
            ], 403);
        }

        // Khởi tạo query mặc định cho đơn hàng đã hoàn thành
        $orderQuery = Order::where('status', 'completed');
        $itemQuery = OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->where('orders.status', 'completed');

        // Lấy tham số lọc thời gian
        $filter = $request->query('filter', 'all');
        $now = Carbon::now();

        // ✅ BƯỚC 2: XỬ LÝ MỐC THỜI GIAN CHÍNH XÁC
        if ($filter === 'today') {
            $orderQuery->whereDate('orders.created_at', Carbon::today());
            $itemQuery->whereDate('orders.created_at', Carbon::today());
        } elseif ($filter === 'week') {
            // Fix: Dùng clone() để tránh việc startOfWeek() làm thay đổi biến $now cho các logic sau
            $startOfWeek = (clone $now)->startOfWeek()->toDateTimeString();
            $orderQuery->whereBetween('orders.created_at', [$startOfWeek, Carbon::now()]);
            $itemQuery->whereBetween('orders.created_at', [$startOfWeek, Carbon::now()]);
        } elseif ($filter === 'month') {
            $orderQuery->whereMonth('orders.created_at', $now->month)
                       ->whereYear('orders.created_at', $now->year);
            $itemQuery->whereMonth('orders.created_at', $now->month)
                      ->whereYear('orders.created_at', $now->year);
        } elseif ($filter === 'year') {
            $orderQuery->whereYear('orders.created_at', $now->year);
            $itemQuery->whereYear('orders.created_at', $now->year);
        }

        // 1. Tính tổng doanh thu
        $totalRevenue = $orderQuery->sum('total_price');

        // 2. Tính top sản phẩm bán chạy
        $topProducts = $itemQuery->select(
                'products.id',
                'products.name',
                DB::raw('SUM(order_items.quantity) as total_sold'),
                DB::raw('SUM(order_items.quantity * order_items.unit_price) as product_revenue')
            )
            ->groupBy('products.id', 'products.name')
            ->orderBy('total_sold', 'desc')
            ->take(5)
            ->get();

        return response()->json([
            'filter_applied' => $filter,
            'total_revenue' => $totalRevenue,
            'top_products' => $topProducts,
            'admin_name' => $user->name // Trả về tên để hiển thị "Chào Phú" trên báo cáo
        ]);
    }
}