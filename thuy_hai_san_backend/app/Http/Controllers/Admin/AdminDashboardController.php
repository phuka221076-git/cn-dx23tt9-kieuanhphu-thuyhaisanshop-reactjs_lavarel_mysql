<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Import thư viện xử lý thời gian

class AdminDashboardController extends Controller 
{
    public function getAnalytics(Request $request)
    {
        // Khởi tạo query mặc định cho đơn hàng đã hoàn thành
        $orderQuery = Order::where('status', 'completed');
        $itemQuery = OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->where('orders.status', 'completed');

        // Lấy tham số lọc thời gian từ Frontend (mặc định nếu không gửi là 'all')
        $filter = $request->query('filter', 'all');
        $now = Carbon::now();

        // Xử lý mốc thời gian bằng Carbon
        if ($filter === 'today') {
            // Lọc trong ngày hôm nay
            $orderQuery->whereDate('orders.created_at', Carbon::today());
            $itemQuery->whereDate('orders.created_at', Carbon::today());
        } elseif ($filter === 'week') {
            // Lọc trong tuần này (từ đầu tuần đến hiện tại)
            $orderQuery->whereBetween('orders.created_at', [$now->startOfWeek()->toDateTimeString(), Carbon::now()]);
            $itemQuery->whereBetween('orders.created_at', [$now->startOfWeek()->toDateTimeString(), Carbon::now()]);
        } elseif ($filter === 'month') {
            // Lọc trong tháng này
            $orderQuery->whereMonth('orders.created_at', $now->month)
                       ->whereYear('orders.created_at', $now->year);
            $itemQuery->whereMonth('orders.created_at', $now->month)
                      ->whereYear('orders.created_at', $now->year);
        } elseif ($filter === 'year') {
            // Lọc trong năm nay
            $orderQuery->whereYear('orders.created_at', $now->year);
            $itemQuery->whereYear('orders.created_at', $now->year);
        }

        // 1. Tính tổng doanh thu theo mốc thời gian đã lọc
        $totalRevenue = $orderQuery->sum('total_price');

        // 2. Tính top sản phẩm bán chạy theo mốc thời gian đã lọc
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
            'top_products' => $topProducts
        ]);
    }
}