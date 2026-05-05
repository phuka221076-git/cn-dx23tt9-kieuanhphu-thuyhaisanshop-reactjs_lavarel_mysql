import React from 'react';
import { Link } from 'react-router-dom'; // Đảm bảo đã import Link

function ProductCard({ product, addToCart }) {
  const isOutOfStock = product.stock <= 0;

  const renderTypeBadge = (type) => {
    if (isOutOfStock) {
        return <span className="bg-red-600 text-white text-[10px] px-2 py-1 rounded-full font-bold uppercase shadow-sm">Tạm hết hàng</span>;
    }
    switch (type) {
      case 'fresh': return <span className="bg-green-100 text-green-700 text-[10px] px-2 py-1 rounded-full font-bold uppercase">Tươi sống</span>;
      case 'frozen': return <span className="bg-blue-100 text-blue-700 text-[10px] px-2 py-1 rounded-full font-bold uppercase">Đông lạnh</span>;
      case 'dried': return <span className="bg-orange-100 text-orange-700 text-[10px] px-2 py-1 rounded-full font-bold uppercase">Đồ khô</span>;
      default: return <span className="bg-gray-100 text-gray-700 text-[10px] px-2 py-1 rounded-full font-bold uppercase">Thủy hải sản</span>;
    }
  };

  return (
    <div className={`bg-white rounded-3xl overflow-hidden shadow-sm transition-all duration-300 group border border-gray-100 ${isOutOfStock ? 'opacity-75' : 'hover:shadow-xl'}`}>
      
      {/* 1. Bọc Link quanh Hình ảnh để click xem chi tiết */}
      <Link to={`/product/${product.id}`}>
        <div className="relative overflow-hidden h-52 cursor-pointer">
          <img 
              src={`http://127.0.0.1:8000/storage/${product.image}`} 
              onError={(e) => {
                  e.target.src = "https://placehold.co/600x400?text=Hai+San";
              }}
              alt={product.name}
              className={`w-full h-full object-cover transition-transform duration-500 ${isOutOfStock ? 'grayscale border-b-2 border-red-100' : 'group-hover:scale-110'}`}
          />
          <div className="absolute top-3 left-3">
            {renderTypeBadge(product.type)}
          </div>
        </div>
      </Link>

      <div className="p-5">
        <p className="text-[10px] font-bold text-blue-500 uppercase tracking-widest mb-1">
          {product.category?.name || 'Thủy hải sản'}
        </p>

        {/* 2. Bọc Link quanh Tên sản phẩm */}
        <Link to={`/product/${product.id}`}>
          <h3 className={`font-black text-lg mb-2 truncate uppercase italic cursor-pointer hover:text-blue-600 transition-colors ${isOutOfStock ? 'text-gray-400' : 'text-gray-900'}`}>
            {product.name}
          </h3>
        </Link>
        {product.size && (
            <p className="text-[11px] text-orange-600 font-bold bg-orange-50 w-fit px-2 py-0.5 rounded-md mb-2">
                Quy cách: {product.size} / {product.unit}
            </p>
        )}
        <div className="flex items-center justify-between mt-4">
          <div className="flex flex-col">
            <span className={`text-xl font-black ${isOutOfStock ? 'text-gray-400 line-through text-sm' : 'text-red-600'}`}>
              {new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(product.price)}
            </span>
            {!isOutOfStock && <span className="text-[10px] text-gray-400 font-medium">Kho còn: {product.stock} {product.unit}</span>}
          </div>

          <button 
            onClick={() => !isOutOfStock && addToCart(product)}
            disabled={isOutOfStock}
            className={`p-3 rounded-2xl transition-all shadow-lg shadow-blue-100 ${
                isOutOfStock 
                ? 'bg-gray-200 text-gray-400 cursor-not-allowed shadow-none' 
                : 'bg-blue-600 hover:bg-blue-700 text-white active:scale-90 shadow-blue-100'
            }`}
          >
            {isOutOfStock ? (
                <span className="text-[10px] font-black uppercase">Hết</span>
            ) : (
                <svg xmlns="http://www.w3.org/2000/svg" className="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 4v16m8-8H4" />
                </svg>
            )}
          </button>
        </div>
      </div>
    </div>
  );
}

export default ProductCard;