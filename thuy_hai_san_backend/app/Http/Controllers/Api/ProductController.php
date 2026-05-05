<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Lấy danh sách sản phẩm cho Admin (Kèm quan hệ category)
     */
    public function index()
    {
        $products = Product::with('category')->orderBy('id', 'desc')->get();
        return response()->json($products);
    }

    /**
     * Thêm mới sản phẩm
     */
    public function store(Request $request)
    {
        // 1. Validation: Đảm bảo dữ liệu gửi lên đúng kiểu
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Dữ liệu không hợp lệ', 'errors' => $validator->errors()], 422);
        }

        try {
            $data = $request->all();

            // Tạo slug tự động
            $data['slug'] = Str::slug($request->name) . '-' . time();

            // Xử lý upload ảnh
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('products', 'public');
                $data['image'] = $imagePath;
            }

            // Ép kiểu chuẩn xác cho database
            $data['is_active'] = filter_var($request->is_active, FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
            $data['price'] = (float) $request->price;
            $data['stock'] = (int) $request->stock;

            $product = Product::create($data);

            return response()->json([
                'message' => 'Thêm sản phẩm mới thành công rồi nhe Bạn!',
                'product' => $product
            ], 201);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Lỗi khi thêm: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Lấy chi tiết 1 sản phẩm
     */
    public function show($id)
    {
        $product = Product::with('category')->find($id);
        if (!$product) {
            return response()->json(['message' => 'Không tìm thấy sản phẩm'], 404);
        }
        return response()->json($product);
    }

    /**
     * Cập nhật sản phẩm
     */
    public function update(Request $request, $id)
    {
        try {
            $product = Product::find($id);
            if (!$product) {
                return response()->json(['message' => 'Sản phẩm không tồn tại'], 404);
            }

            $data = $request->all();

            // Cập nhật slug nếu đổi tên
            if ($request->has('name')) {
                $data['slug'] = Str::slug($request->name) . '-' . time();
            }

            // Xử lý ảnh mới (Chỉ thực hiện nếu có file gửi lên)
            if ($request->hasFile('image')) {
                // Xóa ảnh cũ
                if ($product->image && Storage::disk('public')->exists($product->image)) {
                    Storage::disk('public')->delete($product->image);
                }
                $imagePath = $request->file('image')->store('products', 'public');
                $data['image'] = $imagePath;
            }

            // Xử lý logic is_active (nhận từ FormData của React có thể là string '0' hoặc '1')
            if ($request->has('is_active')) {
                $data['is_active'] = filter_var($request->is_active, FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
            }

            $product->update($data);

            return response()->json([
                'message' => 'Cập nhật thành công rồi nhe Bạn!',
                'product' => $product->load('category') // Load lại category để React hiển thị luôn
            ]);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Lỗi cập nhật: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Xóa sản phẩm
     */
    public function destroy($id)
    {
        try {
            $product = Product::find($id);
            if (!$product) {
                return response()->json(['message' => 'Không tìm thấy sản phẩm'], 404);
            }

            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $product->delete();
            return response()->json(['message' => 'Đã xóa sản phẩm khỏi hệ thống!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Lỗi khi xóa: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Lấy sản phẩm đang bán (Dành cho trang chủ khách hàng)
     */
    public function getActiveProducts() {
        $products = Product::with('category')->where('is_active', 1)->orderBy('id', 'desc')->get(); 
        return response()->json($products);
    }
}