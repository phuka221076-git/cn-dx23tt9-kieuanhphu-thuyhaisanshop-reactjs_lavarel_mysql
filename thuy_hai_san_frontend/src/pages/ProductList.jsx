import { useState, useEffect } from 'react';
import ProductCard from '../components/ProductCard';

function ProductList({ searchTerm, addToCart }) {
  const [products, setProducts] = useState([]);
  const [loading, setLoading] = useState(true);

  // --- HÀM CHUYỂN ĐỔI TIẾNG VIỆT CÓ DẤU THÀNH KHÔNG DẤU ---
  const removeAccents = (str) => {
    if (!str) return "";
    return str
      .normalize('NFD')
      .replace(/[\u0300-\u036f]/g, '')
      .replace(/đ/g, 'd')
      .replace(/Đ/g, 'D');
  };

  // --- LẤY DỮ LIỆU TỪ BACKEND LARAVEL ---
  useEffect(() => {
    fetch('http://127.0.0.1:8000/api/products')
      .then(res => {
        if (!res.ok) throw new Error("Không thể kết nối đến API");
        return res.json();
      })
      .then(data => {
        setProducts(data);
        setLoading(false);
      })
      .catch(err => {
        console.error("Lỗi fetch dữ liệu:", err);
        setLoading(false);
      });
  }, []);

  // --- LOGIC LỌC SẢN PHẨM (TRẠNG THÁI & TÌM KIẾM) ---
  const filteredProducts = products.filter(product => {
    // 1. KIỂM TRA TRẠNG THÁI: Chỉ hiển thị nếu is_active bằng 1
    const isActive = Number(product.is_active) === 1;
    if (!isActive) return false; 

    // 2. CHUẨN HÓA TÌM KIẾM
    const searchLow = removeAccents(searchTerm.toLowerCase());
    const productNameLow = removeAccents(product.name?.toLowerCase() || "");
    const categoryNameLow = removeAccents(product.category?.name?.toLowerCase() || "");
    const productTypeLow = removeAccents(product.type?.toLowerCase() || "");

    // 3. KẾT QUẢ: Khớp từ khóa tìm kiếm
    return (
      productNameLow.includes(searchLow) || 
      categoryNameLow.includes(searchLow) ||
      productTypeLow.includes(searchLow)
    );
  });

  if (loading) {
    return (
      <div className="flex flex-col items-center justify-center py-24">
        <div className="animate-spin rounded-full h-12 w-12 border-b-4 border-blue-600 mb-4"></div>
        <p className="text-blue-600 font-bold italic">Đang cập nhật Thủy hải sản tươi sống từ Trà Vinh...</p>
      </div>
    );
  }

  return (
    <div className="container mx-auto px-4 py-10 animate-fade-in">
      <div className="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
          <h2 className="text-3xl font-black text-blue-900 uppercase italic leading-none">
            {searchTerm ? `Kết quả cho: "${searchTerm}"` : "Thực đơn thủy hải sản"}
          </h2>
          <div className="w-24 h-1.5 bg-blue-600 mt-3 rounded-full"></div>
        </div>
        <span className="text-sm font-bold text-gray-500 bg-gray-100 px-4 py-1.5 rounded-full border border-gray-200">
          Đang hiển thị: {filteredProducts.length} sản phẩm
        </span>
      </div>

      {filteredProducts.length > 0 ? (
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
          {filteredProducts.map(product => (
            <ProductCard 
              key={product.id} 
              product={product} 
              addToCart={addToCart} 
            />
          ))}
        </div>
      ) : (
        <div className="text-center py-24 bg-gray-50 rounded-[3rem] border-2 border-dashed border-gray-200">
          <div className="text-7xl mb-6">🐙</div>
          <h3 className="text-xl font-bold text-gray-700">Không tìm thấy sản phẩm khả dụng!</h3>
          <p className="text-gray-500 mt-2">Sản phẩm có thể đã hết hàng hoặc đang bị ẩn.</p>
          <button 
            onClick={() => window.location.reload()}
            className="mt-8 px-8 py-3 bg-blue-600 text-white rounded-full font-bold shadow-lg shadow-blue-200 hover:bg-blue-700 transition-all active:scale-95"
          >
            Làm mới danh sách
          </button>
        </div>
      )}
    </div>
  );
}

export default ProductList;