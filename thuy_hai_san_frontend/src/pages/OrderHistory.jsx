import React, { useState, useEffect } from 'react';
import api from '../api/axios'; 

function OrderHistory() {
    const [orders, setOrders] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    
    // 🔍 CƠ CHẾ TỰ ĐỘNG QUÉT TOKEN (Dành cho cả Admin và User)
    const token = localStorage.getItem('admin_token') || 
                  localStorage.getItem('user_token') || 
                  localStorage.getItem('token');
    
    const loggedIn = !!token;

    useEffect(() => {
        const fetchOrders = async () => {
            if (!token) {
                setLoading(false);
                return;
            }

            try {
                setLoading(true);
                setError(null);

                // Gửi token tìm được lên Backend
                const res = await api.get('/my-orders', {
                    headers: { 
                        Authorization: `Bearer ${token}`,
                        Accept: 'application/json'
                    }
                });
                
                const responseData = res.data.data ? res.data.data : res.data;
                setOrders(Array.isArray(responseData) ? responseData : []);
                
            } catch (err) {
                console.error("Lỗi xác thực:", err);
                if (err.response?.status === 401) {
                    setError("Phiên đăng nhập đã hết hạn. Vui lòng đăng nhập lại.");
                } else {
                    setError(err.response?.data?.message || "Không thể tải danh sách đơn hàng.");
                }
            } finally {
                setLoading(false);
            }
        };

        fetchOrders();
    }, [token]);

    // Giao diện khi chưa đăng nhập
    if (!loggedIn) {
        return (
            <div className="max-w-4xl mx-auto mt-20 p-10 bg-red-50 rounded-[40px] text-center shadow-inner">
                <h2 className="text-2xl font-black text-red-900 uppercase">Yêu cầu xác thực!</h2>
                <p className="text-red-700 mt-2">Vui lòng đăng nhập để xem lịch sử mua hàng của bạn.</p>
            </div>
        );
    }

    if (loading) return <div className="text-center mt-20 font-bold animate-pulse text-blue-900 italic">Đang tải dữ liệu đơn hàng...</div>;

    return (
        <div className="max-w-4xl mx-auto mt-10 p-6 font-sans">
            <h2 className="text-4xl font-black text-blue-900 mb-10 uppercase italic tracking-tighter border-b-4 border-yellow-400 inline-block">
                Lịch sử mua hàng
            </h2>

            {error && <div className="bg-red-50 text-red-600 p-4 rounded-xl mb-6 font-medium border border-red-100">⚠️ {error}</div>}

            {orders.length === 0 ? (
                <div className="bg-gray-50 p-16 rounded-[40px] text-center border-2 border-dashed border-gray-200">
                    <p className="text-2xl text-gray-400 font-medium italic">
                        Bạn chưa có đơn hàng nào. <br/>
                        <span className="text-blue-900 not-italic font-black text-sm uppercase mt-4 block">Hãy đặt mua hải sản tươi ngay hôm nay! 🦀</span>
                    </p>
                </div>
            ) : (
                <div className="grid gap-8">
                    {orders.map((order) => (
                        <div key={order.id} className="bg-white p-6 rounded-[35px] shadow-md border border-gray-100 flex flex-col relative transition-hover duration-300 hover:shadow-lg">
                            <div className="flex justify-between items-start border-b border-gray-50 pb-4 mb-4">
                                <div>
                                    <span className="text-[10px] font-black bg-blue-900 text-white px-3 py-1 rounded-full uppercase">
                                        Đơn hàng: #{order.id}
                                    </span>
                                    <p className="text-[10px] text-gray-400 font-bold italic mt-2">
                                        Ngày đặt: {new Date(order.created_at).toLocaleString('vi-VN')}
                                    </p>
                                </div>
                                <span className={`px-4 py-1.5 rounded-xl text-[10px] font-black uppercase border ${
                                    order.status === 'pending' ? 'bg-yellow-50 text-yellow-600 border-yellow-200' : 
                                    order.status === 'completed' ? 'bg-green-50 text-green-600 border-green-200' : 'bg-blue-50 text-blue-600 border-blue-200'
                                }`}>
                                    {order.status === 'pending' ? '⏳ Đang chờ' : `🚚 ${order.status.toUpperCase()}`}
                                </span>
                            </div>

                            <div className="space-y-3 mb-6">
                                {order.items?.map((item) => (
                                    <div key={item.id} className="flex items-center gap-4 bg-gray-50/50 p-3 rounded-2xl border border-gray-100">
                                        <div className="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center text-xl">🐟</div>
                                        <div className="flex-1">
                                            <p className="text-sm font-bold text-blue-900 leading-tight">
                                                {item.product?.name || "Sản phẩm không khả dụng"}
                                            </p>
                                            <p className="text-[11px] text-gray-500 font-medium">
                                                Số lượng: <span className="text-blue-600 font-black">{item.quantity}</span>
                                            </p>
                                        </div>
                                        <div className="text-right">
                                            <p className="text-xs font-black text-gray-700">
                                                {Number(item.unit_price).toLocaleString()}đ
                                            </p>
                                        </div>
                                    </div>
                                ))}
                            </div>

                            <div className="flex justify-between items-end mt-auto pt-4 border-t border-dashed border-gray-200">
                                <div className="max-w-[60%]">
                                    <p className="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Địa chỉ nhận</p>
                                    <p className="text-xs font-semibold italic text-gray-600 line-clamp-1">📍 {order.shipping_adr}</p>
                                </div>
                                <div className="text-right">
                                    <p className="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Thành tiền</p>
                                    <p className="text-2xl font-black text-red-500">
                                        {Number(order.total_price).toLocaleString()}<span className="text-xs ml-0.5">đ</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    ))}
                </div>
            )}
        </div>
    );
}

export default OrderHistory;