import React, { useEffect, useState } from 'react';
import { useParams, useNavigate } from 'react-router-dom'; // Thêm useNavigate
import axios from 'axios';

function ProductDetail({ addToCart }) {
    const { id } = useParams();
    const navigate = useNavigate(); // Khởi tạo điều hướng
    const [product, setProduct] = useState(null);

    useEffect(() => {
        axios.get(`http://127.0.0.1:8000/api/products/${id}`)
            .then(res => setProduct(res.data))
            .catch(err => console.log(err));
    }, [id]);

    // Hàm xử lý khi nhấn nút Thanh toán ngay
    const handleBuyNow = () => {
        // 1. Kiểm tra xem người dùng đã đăng nhập chưa (có Token không)
        const token = localStorage.getItem('token');

        if (!token) {
            alert("Bạn ơi, vui lòng đăng nhập để tiến hành đặt hàng nhé!");
            navigate('/login'); // Chuyển hướng sang trang đăng nhập
            return;
        }

        // 2. Nếu đã đăng nhập: Thêm sản phẩm vào giỏ và đi tới trang thanh toán
        addToCart(product);
        navigate('/checkout'); 
    };

    if (!product) return <div className="text-center mt-20">Đang tải thông tin Thủy hải sản...</div>;

    const isOutOfStock = product.stock <= 0;

    return (
        <div className="max-w-6xl mx-auto p-10 grid grid-cols-1 md:grid-cols-2 gap-10">
            {/* Ảnh sản phẩm */}
            <img 
                src={`http://127.0.0.1:8000/storage/${product.image}`} 
                onError={(e) => e.target.src = "https://placehold.co/600x400?text=Hai+San"}
                className={`rounded-3xl shadow-lg w-full h-[400px] object-cover ${isOutOfStock ? 'grayscale' : ''}`}
                alt={product.name}
            />

            {/* Thông tin chi tiết */}
            <div className="space-y-6">
                <button 
                    onClick={() => navigate(-1)} 
                    className="text-blue-600 font-bold hover:underline mb-4"
                >
                    ← Quay lại danh sách
                </button>

                <h1 className="text-4xl font-black text-blue-900 uppercase italic">{product.name}</h1>
                <p className="text-2xl text-red-600 font-bold">
                    {new Intl.NumberFormat('vi-VN').format(product.price)}đ / {product.unit}
                </p>
                
                <div className="bg-blue-50 p-4 rounded-2xl border border-blue-100">
                    <p className="text-gray-700">
                        <strong>Tình trạng:</strong> {isOutOfStock ? 'Tạm hết hàng' : `Còn ${product.stock} ${product.unit}`}
                    </p>
                    <p className="text-gray-700"><strong>Loại Thủy hải sản:</strong> {product.type}</p>
                </div>

                <div className="text-gray-600 leading-relaxed">
                    <h3 className="font-bold text-blue-900 mb-2 uppercase">Mô tả sản phẩm:</h3>
                    <p>{product.description || "Thủy hải sản tươi sống đánh bắt trong ngày, đảm bảo chất lượng tươi ngon nhất khi đến tay khách hàng."}</p>
                </div>

                {/* Nút bấm đã được cập nhật logic handleBuyNow */}
                <button 
                    disabled={isOutOfStock}
                    onClick={handleBuyNow} 
                    className={`w-full py-4 rounded-2xl font-black uppercase shadow-xl transition-all active:scale-95 ${
                        isOutOfStock 
                        ? 'bg-gray-300 cursor-not-allowed text-gray-500' 
                        : 'bg-blue-900 text-white hover:bg-yellow-400 hover:text-blue-900'
                    }`}
                >
                    {isOutOfStock ? 'Sản phẩm tạm hết hàng' : 'Mua ngay và Thanh toán'}
                </button>
            </div>
        </div>
    );
}

export default ProductDetail;