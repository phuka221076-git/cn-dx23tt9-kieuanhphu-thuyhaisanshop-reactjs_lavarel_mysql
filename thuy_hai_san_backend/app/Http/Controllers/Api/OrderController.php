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

   public function index(Request $request)
    {
        /* if (!auth('sanctum')->check()) {
            return response()->json(['message' => 'Vui lòng đăng nhập'], 401);
        }

        $user = auth('sanctum')->user();
        
        // BƯỚC 1: Chỉ khởi tạo, TUYỆT ĐỐI không dùng get() ở đây
        $query = Order::with(['user', 'items.product']);

        // BƯỚC 2: Thêm các điều kiện lọc (Cứ thoải mái, vì nó vẫn đang là Builder)
        if ($user->role !== 'admin') {
            $query->where('user_id', $user->id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('id', 'like', "%$search%")
                ->orWhere('customer_name', 'like', "%$search%")
                ->orWhere('customer_phone', 'like', "%$search%");
            });
        }
        // --- ĐÂY LÀ PHẦN THIẾU ---
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // BƯỚC 3: Cuối cùng mới thực thi để lấy dữ liệu (Dùng paginate để React nhận được dữ liệu phân trang)
        $orders = $query->orderBy('created_at', 'desc')->paginate(10);

        return response()->json($orders); */

        // 1. Kiểm tra đăng nhập qua Sanctum
        if (!auth('sanctum')->check()) {
            return response()->json(['message' => 'Vui lòng đăng nhập'], 401);
        }

        $user = auth('sanctum')->user();
        
        // 2. Khởi tạo Query với đầy đủ quan hệ (Fix lỗi thiếu sản phẩm khi xem lịch sử)
        $query = Order::with(['user', 'items.product']);

        // 3. Phân quyền: Nếu không phải admin thì chỉ lấy đơn của chính mình
        if ($user->role !== 'admin') {
            $query->where('user_id', $user->id);
        }

        // 4. Lọc theo trạng thái (Fix lỗi lọc không hoạt động)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // 5. Tìm kiếm theo từ khóa
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('id', 'like', "%$search%")
                ->orWhere('customer_name', 'like', "%$search%")
                ->orWhere('customer_phone', 'like', "%$search%");
            });
        }

        // 6. Thực thi và phân trang (Sắp xếp mới nhất lên đầu)
        $orders = $query->orderBy('created_at', 'desc')->paginate(10);

        return response()->json($orders);
    }

    public function store(Request $request)
    {
        $request->validate([
            'total_price'        => 'required|numeric',
            'shipping_adr'       => 'required|string',
            'items'              => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity'   => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric',
        ]);

        return DB::transaction(function () use ($request) {
            $isLoggedIn = auth('sanctum')->check();
            $userId = $isLoggedIn ? auth('sanctum')->id() : 999999999;

            $order = Order::create([
                'user_id' => $userId,
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'Delivery_hours' => $request->Delivery_hours,
                'shipping_adr' => $request->shipping_adr,
                'note' => $request->note,
                'total_price' => $request->total_price,
                'status' => 'pending',
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

            // Xử lý kho hàng khi hủy hoặc chuyển trạng thái
            if ($newStatus === 'cancelled' && in_array($order->status, ['processing', 'shipping', 'completed'])) {
                $this->stockService->restoreStock($order);
            }

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

    public function show($id)
    {
        $order = Order::with(['user', 'items.product'])->findOrFail($id);
        $user = auth('sanctum')->user();
        
        if ($user->role !== 'admin' && $order->user_id !== $user->id) {
            return response()->json(['message' => 'Không có quyền xem'], 403);
        }

        return response()->json($order);
    }

    public function myOrders()
    {
        try {
            // Lấy user đang đăng nhập từ token
            $user = Auth::user();

            // Kiểm tra xem user có tồn tại không (phòng hờ)
            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }

            // Lấy danh sách đơn hàng kèm theo các sản phẩm bên trong (eager loading)
            // Lưu ý: Đảm bảo bảng orders có cột user_id
            $orders = Order::where('user_id', auth()->id())
                   ->with(['items.product'])
                   ->orderBy('created_at', 'desc')
                   ->get();

            return response()->json($orders);
            
        } catch (\Exception $e) {
            // Trả về thông báo lỗi chi tiết để debug thay vì lỗi 500 chung chung
            return response()->json([
                'error' => 'Lỗi hệ thống: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getAdminOrders()
    {
        // Lấy tất cả đơn hàng, kèm thông tin User nếu có
        $orders = Order::with('user')->orderBy('created_at', 'desc')->get();

        $data = $orders->map(function($order) {
            // Kiểm tra nếu là Guest (ID đặc biệt) hoặc không có liên kết User
            if ($order->user_id == 999999999 || !$order->user) {
                return [
                    'id' => $order->id,
                    'display_name' => $order->customer_name ?? 'Khách vãng lai',
                    'display_phone' => $order->customer_phone,
                    'display_address' => $order->shipping_adr,
                    'total' => $order->total_price,
                    'status' => $order->status,
                    'type' => 'Guest',
                    'created_at' => $order->created_at
                ];
            }

            // Nếu là Thành viên (User đã đăng nhập)
            return [
                'id' => $order->id,
                'display_name' => $order->user->name, // Lấy tên từ bảng users
                'display_phone' => $order->user->phone ?? $order->customer_phone,
                'display_address' => $order->shipping_adr,
                'total' => $order->total_price,
                'status' => $order->status,
                'type' => 'Member',
                'created_at' => $order->created_at
            ];
        });

        return response()->json($data);
    }
}