import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import axios from './api/axios';

function Checkout({ user, cartItems, setCartItems }) {
    const navigate = useNavigate();
    
    // State quản lý thông tin
    const [customerName, setCustomerName] = useState("");
    const [customerPhone, setCustomerPhone] = useState("");
    const [address, setAddress] = useState("");
    const [deliveryHours, setDeliveryHours] = useState(""); // Cột Delivery_hours
    const [note, setNote] = useState(""); // Cột note
    const [isCustomAddress, setIsCustomAddress] = useState(false);
    const [loading, setLoading] = useState(false);

    const token = localStorage.getItem('user_token') || localStorage.getItem('admin_token');
    const isGuest = !token || !user || Object.keys(user).length === 0;

    useEffect(() => {
        if (!isGuest && user) {
            if (!isCustomAddress) setAddress(user.address || "");
            setCustomerName(user.name || "");
            setCustomerPhone(user.phone || "");
        } else {
            setIsCustomAddress(true);
        }
    }, [user, isCustomAddress, isGuest]);

    useEffect(() => {
        if (cartItems.length === 0) {
            alert("Giỏ hàng của bạn đang trống!");
            navigate('/');
        }
    }, [cartItems, navigate]);

    const total = cartItems.reduce((sum, item) => sum + (item.price * (item.qty || 1)), 0);

    const handleAddressOption = (type) => {
        if (type === 'default') {
            setIsCustomAddress(false);
            setAddress(user?.address || "");
        } else {
            setIsCustomAddress(true);
            setAddress(""); 
        }
    };

    const handleOrder = async (e) => {
        e.preventDefault();
        if (!address || !customerName || !customerPhone) {
            alert("Vui lòng nhập đầy đủ thông tin giao hàng!");
            return;
        }

        setLoading(true);
        try {
            // CẬP NHẬT PAYLOAD KHỚP VỚI DATABASE
            const payload = { 
                total_price: total, 
                shipping_adr: address,
                customer_name: customerName, // Gửi tên dù là guest hay user
                customer_phone: customerPhone, // Gửi SĐT dù là guest hay user
                Delivery_hours: deliveryHours, // Cột mới
                note: note, // Cột số ít 'note'
                user_id: isGuest ? 999999999 : (user.id || null), // Gán ID mặc định cho khách vãng lai
                items: cartItems.map(item => ({
                    product_id: item.id,
                    quantity: item.qty || 1,
                    unit_price: item.price 
                }))
            };

            const config = token ? { headers: { Authorization: `Bearer ${token}` } } : {};
            await axios.post('/orders', payload, config);
            
            alert("Đặt hàng thành công! Cảm ơn bạn đã ủng hộ Thủy hải sản sạch.");
            setCartItems([]); 
            localStorage.removeItem('cart');
            navigate('/');
        } catch (err) {
            alert("Lỗi: " + (err.response?.data?.message || "Không thể đặt hàng"));
        } finally {
            setLoading(false);
        }
    };

    if (cartItems.length === 0) return null;

    return (
        <div className="max-w-6xl mx-auto mt-10 p-10 bg-white rounded-[40px] shadow-2xl border font-sans mb-20">
            <h2 className="text-3xl font-black text-blue-900 mb-10 uppercase italic border-l-8 border-yellow-400 pl-4">
                Xác Nhận Đơn Hàng {isGuest && <span className="text-red-500 text-sm font-normal">(Khách vãng lai)</span>}
            </h2>

            <form onSubmit={handleOrder} className="grid grid-cols-1 lg:grid-cols-2 gap-12">
                
                <div className="space-y-6">
                    <h3 className="text-lg font-black text-blue-900 uppercase flex items-center gap-2">
                        <span>👤</span> Thông tin liên hệ
                    </h3>
                    
                    <div className="grid grid-cols-2 gap-4">
                        <input 
                            type="text" placeholder="Họ và tên"
                            className="p-4 border-2 border-gray-100 rounded-2xl outline-none focus:border-blue-900 shadow-sm"
                            value={customerName} onChange={(e) => setCustomerName(e.target.value)} required
                        />
                        <input 
                            type="text" placeholder="Số điện thoại"
                            className="p-4 border-2 border-gray-100 rounded-2xl outline-none focus:border-blue-900 shadow-sm"
                            value={customerPhone} onChange={(e) => setCustomerPhone(e.target.value)} required
                        />
                    </div>

                    <h3 className="text-lg font-black text-blue-900 uppercase flex items-center gap-2 pt-4">
                        <span>📍</span> Địa chỉ nhận hàng
                    </h3>

                    {!isGuest ? (
                        <div className="space-y-4">
                            <div className="flex p-1 bg-gray-100 rounded-2xl">
                                <button type="button" onClick={() => handleAddressOption('default')}
                                    className={`flex-1 py-3 rounded-xl text-sm font-black transition-all ${!isCustomAddress ? 'bg-blue-900 text-white shadow-lg' : 'text-gray-500'}`}>
                                    ĐỊA CHỈ ĐĂNG KÝ
                                </button>
                                <button type="button" onClick={() => handleAddressOption('custom')}
                                    className={`flex-1 py-3 rounded-xl text-sm font-black transition-all ${isCustomAddress ? 'bg-blue-900 text-white shadow-lg' : 'text-gray-500'}`}>
                                    ĐỊA CHỈ MỚI
                                </button>
                            </div>

                            {!isCustomAddress ? (
                                <div className="p-6 bg-blue-50 border-2 border-dashed border-blue-200 rounded-[25px]">
                                    <p className="text-xs font-bold text-blue-400 uppercase">Giao đến địa chỉ mặc định:</p>
                                    <p className="text-blue-900 font-bold mt-1 text-lg">{user?.address || "Chưa cập nhật địa chỉ"}</p>
                                </div>
                            ) : (
                                <textarea 
                                    className="w-full p-5 border-2 border-blue-100 rounded-[25px] outline-none focus:border-blue-900 h-32"
                                    placeholder="Nhập địa chỉ mới..." value={address}
                                    onChange={(e) => setAddress(e.target.value)} required 
                                />
                            )}
                        </div>
                    ) : (
                        <div className="space-y-2">
                            <textarea 
                                className="w-full p-5 border-2 border-red-100 rounded-[25px] outline-none focus:border-blue-900 h-32 shadow-sm"
                                placeholder="Vui lòng nhập địa chỉ nhận hàng..." 
                                value={address} onChange={(e) => setAddress(e.target.value)} required 
                            />
                        </div>
                    )}

                    {/* CẬP NHẬT: THÊM GIỜ GIAO HÀNG VÀ GHI CHÚ */}
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4">
                        <div className="space-y-2">
                            <h3 className="text-sm font-black text-blue-900 uppercase">🕒 Giờ nhận hàng</h3>
                            <input 
                                type="text" className="w-full p-4 border-2 border-gray-100 rounded-2xl outline-none focus:border-blue-900 shadow-sm"
                                placeholder="Ví dụ: 17h chiều nay" value={deliveryHours} onChange={(e) => setDeliveryHours(e.target.value)}
                            />
                        </div>
                        <div className="space-y-2">
                            <h3 className="text-sm font-black text-blue-900 uppercase">📝 Ghi chú</h3>
                            <input 
                                type="text" className="w-full p-4 border-2 border-gray-100 rounded-2xl outline-none focus:border-blue-900 shadow-sm"
                                placeholder="Ghi chú thêm..." value={note} onChange={(e) => setNote(e.target.value)}
                            />
                        </div>
                    </div>
                </div>

                <div className="bg-gray-50 p-8 rounded-[40px] border relative">
                    <h3 className="text-lg font-black text-blue-900 uppercase mb-6">Tóm tắt đơn hàng</h3>
                    <div className="space-y-4 mb-6 max-h-[300px] overflow-y-auto pr-2">
                        {cartItems.map((item, index) => (
                            <div key={index} className="flex justify-between items-center bg-white p-4 rounded-2xl shadow-sm border border-gray-100">
                                <div className="flex gap-3 items-center">
                                    <div className="w-12 h-12 bg-blue-100 rounded-lg overflow-hidden border">
                                        <img src={`http://127.0.0.1:8000/storage/${item.image}`} alt="" className="w-full h-full object-cover" />
                                    </div>
                                    <div>
                                        <p className="font-bold text-blue-900 text-sm truncate w-40">{item.name}</p>
                                        <p className="text-xs text-gray-400 font-medium italic">SL: {item.qty || 1} {item.unit}</p>
                                    </div>
                                </div>
                                <p className="font-black text-blue-900">{(item.price * (item.qty || 1)).toLocaleString()}đ</p>
                            </div>
                        ))}
                    </div>

                    <div className="flex justify-between items-center border-t-2 border-dashed border-gray-200 pt-6 mt-6">
                        <span className="text-xl font-black text-blue-900 uppercase italic">Tổng cộng</span>
                        <span className="text-3xl font-black text-red-600">{total.toLocaleString()}đ</span>
                    </div>

                    <button 
                        type="submit" disabled={loading}
                        className={`w-full mt-8 py-5 rounded-[25px] font-black uppercase text-white shadow-xl transition-all active:scale-95 ${
                            loading ? 'bg-gray-400' : 'bg-blue-900 hover:bg-yellow-400 hover:text-blue-900'
                        }`}
                    >
                        {loading ? 'Đang xử lý...' : 'Xác nhận đặt hàng ngay'}
                    </button>
                </div>
            </form>
        </div>
    );
}

export default Checkout;