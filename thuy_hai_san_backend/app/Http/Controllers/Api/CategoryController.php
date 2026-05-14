<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Lấy danh sách phân loại (Có hỗ trợ tìm kiếm)
     */
    public function index(Request $request) 
    {
        $search = $request->query('search');

        $categories = Category::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })
        ->orderBy('id', 'desc')
        ->get();

        return response()->json($categories);
    }

    /**
     * Trả về danh sách rút gọn cho ô chọn (Select) trong Form Product
     */
    public function getList()
    {
        // Bạn lưu ý: Giữ nguyên cái này để trang AdminProduct vẫn lấy được list ID và Name
        $categories = Category::select('id', 'name')->orderBy('name', 'asc')->get();
        return response()->json($categories);
    }

    /**
     * Thêm loại hàng mới
     */
    public function store(Request $request) 
    {
        // 1. Thêm validate cho description (nullable nghĩa là để trống cũng được)
        $request->validate([
            'name' => 'required|unique:categories,name',
            'description' => 'nullable|string' 
        ]);

        // 2. Thêm description vào hàm create
        $category = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description // LƯU MÔ TẢ TẠI ĐÂY
        ]);

        return response()->json($category, 201);
    }

    /**
     * Cập nhật loại hàng
     */
    public function update(Request $request, $id) 
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:categories,name,' . $id,
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean' // Thêm validate cho trạng thái
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'is_active' => $request->is_active // QUAN TRỌNG: Phải có dòng này thì DB mới đổi
        ]);

        return response()->json($category);
    }

    /**
     * Xóa loại hàng
     */
    public function destroy($id) 
    {
        Category::destroy($id);
        return response()->json(['message' => 'Đã xóa loại hàng thành công']);
    }
}