<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Services\StockService;

class OrderController extends Controller
{
    protected $stockService;

    public function __construct(StockService $stockService)
    {
        $this->stockService = $stockService;
    }

    /**
     * Danh sách đơn hàng dành cho trang Quản lý (Admin)
     */
    public function index(Request $request)
    {
        if (!auth('sanctum')->check()) {
            return response()->json(['message' => 'Vui lòng đăng nhập'], 401);
        }

        $user = auth('sanctum')->user();
        $query = Order::with(['user', 'items.product']);

        // Phân quyền: Admin xem tất cả, User chỉ xem đơn của mình
        if ($user->role !== 'admin') {
            $query->where('user_id', $user->id);
        }

        // Bộ lọc tìm kiếm
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('id', 'like', "%$search%")
                  ->orWhere('customer_name', 'like', "%$search%")
                  ->orWhere('customer_phone', 'like', "%$search%");
            });
        }

        // Lọc theo trạng thái
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(10);
        return response()->json($orders);
    }

    /**
     * Xử lý đặt hàng (Cho cả User và Khách vãng lai)
     */
    public function store(Request $request)
    {
        $request->validate([
            'total_price'        => 'required|numeric',
            'shipping_adr'       => 'required|string',
            'customer_name'      => 'required|string',
            'customer_phone'     => 'required|string',
            'items'              => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity'   => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric',
        ]);

        return DB::transaction(function () use ($request) {
            // Kiểm tra đăng nhập (không bắt buộc)
            $user = auth('sanctum')->user();
            
            // Nếu không có user đăng nhập, dùng ID 999999999 cho khách vãng lai
            $userId = $user ? $user->id : 999999999;

            $order = Order::create([
                'user_id'        => $userId,
                'customer_name'  => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'Delivery_hours' => $request->Delivery_hours,
                'shipping_adr'   => $request->shipping_adr,
                'note'           => $request->note,
                'total_price'    => $request->total_price,
                'status'         => 'pending',
            ]);

            foreach ($request->items as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity'   => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                ]);
            }

            return response()->json([
                'message' => 'Đặt hàng thành công!',
                'order'   => $order->load(['user', 'items.product'])
            ], 201);
        });
    }

    /**
     * Cập nhật trạng thái đơn hàng và xử lý kho (Admin)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipping,completed,cancelled'
        ]);

        return DB::transaction(function () use ($request, $id) {
            $order = Order::with('items.product')->findOrFail($id);
            $newStatus = strtolower($request->status);

            if ($order->status === $newStatus) {
                return response()->json(['message' => 'Trạng thái không đổi'], 200);
            }

            // Hoàn kho nếu hủy đơn sau khi đã trừ kho
            if ($newStatus === 'cancelled' && in_array($order->status, ['processing', 'shipping', 'completed'])) {
                $this->stockService->restoreStock($order);
            }

            // Trừ kho khi chuyển sang trạng thái xử lý/giao hàng
            if (in_array($newStatus, ['processing', 'shipping']) && $order->status === 'pending') {
                foreach ($order->items as $item) {
                    if ($item->product->stock < $item->quantity) {
                        throw new \Exception("Sản phẩm '{$item->product->name}' không đủ hàng!");
                    }
                    $item->product->decrement('stock', $item->quantity);
                }
            }

            $order->status = $newStatus;
            $order->save();

            return response()->json(['message' => 'Cập nhật thành công!', 'status' => $order->status]);
        });
    }

    /**
     * Xem chi tiết đơn hàng
     */
    public function show($id)
    {
        $order = Order::with(['user', 'items.product'])->findOrFail($id);
        $user = auth('sanctum')->user();
        
        // Kiểm tra quyền: Admin hoặc chủ nhân đơn hàng mới được xem
        if (!$user || ($user->role !== 'admin' && $order->user_id !== $user->id)) {
            return response()->json(['message' => 'Không có quyền xem'], 403);
        }

        return response()->json($order);
    }

    /**
     * Lấy lịch sử mua hàng cá nhân (Dùng cho cả Phú và Hằng)
     */
    public function getUserOrders()
    {
        $user = auth('sanctum')->user();

        if (!$user) {
            return response()->json(['message' => 'Vui lòng đăng nhập'], 401);
        }

        $orders = Order::where('user_id', $user->id)
                    ->with(['items.product'])
                    ->orderBy('created_at', 'desc')
                    ->get();

        return response()->json($orders, 200);
    }
}