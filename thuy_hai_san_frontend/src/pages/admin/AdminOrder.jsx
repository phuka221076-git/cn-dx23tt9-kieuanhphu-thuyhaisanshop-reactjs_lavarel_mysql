import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { useLocation, useNavigate } from 'react-router-dom';

function AdminOrder() {
    const [orders, setOrders] = useState([]); 
    const [pagination, setPagination] = useState({}); 
    const [loading, setLoading] = useState(true);
    const token = localStorage.getItem('admin_token');
    const location = useLocation();
    const navigate = useNavigate();

    // Lấy các tham số từ URL
    const queryParams = new URLSearchParams(location.search);
    const currentStatus = queryParams.get('status') || "";
    const currentSearch = queryParams.get('search') || "";
    const currentPage = queryParams.get('page') || 1;

    useEffect(() => {
        fetchOrders(currentSearch, currentPage, currentStatus);
    }, [location.search]); 

    const fetchOrders = async (keyword = "", page = 1, status = "") => {
        try {
            setLoading(true);
            // Thêm tham số status vào API call
            const res = await axios.get(`http://127.0.0.1:8000/api/orders?search=${keyword}&page=${page}&status=${status}`, {
                headers: { 
                    Authorization: `Bearer ${token}`,
                    Accept: 'application/json'
                }
            });
            setOrders(res.data.data || []);
            setPagination(res.data); 
        } catch (error) {
            console.error("Lỗi fetch đơn hàng:", error);
        } finally {
            setLoading(false);
        }
    };

    // Hàm xử lý khi thay đổi bộ lọc trạng thái
    const handleFilterStatus = (status) => {
        const params = new URLSearchParams(location.search);
        if (status) {
            params.set('status', status);
        } else {
            params.delete('status');
        }
        params.set('page', 1); // Reset về trang 1 khi lọc
        navigate(`?${params.toString()}`);
    };

    const handlePageChange = (url) => {
        if (!url) return;
        const urlParams = new URLSearchParams(new URL(url).search);
        const page = urlParams.get('page');
        const searchParams = new URLSearchParams(location.search);
        searchParams.set('page', page);
        navigate(`?${searchParams.toString()}`);
        window.scrollTo(0, 0); 
    };

    const handleStatusChange = async (orderId, newStatus) => {
        if (!window.confirm(`Xác nhận đổi trạng thái đơn #${orderId}?`)) return;
        try {
            await axios.patch(`http://127.0.0.1:8000/api/orders/${orderId}/status`, 
                { status: newStatus },
                { headers: { Authorization: `Bearer ${token}` } }
            );
            fetchOrders(currentSearch, currentPage, currentStatus); 
        } catch (error) {
            alert("Lỗi cập nhật!");
        }
    };

    const getStatusClasses = (status) => {
        switch (status) {
            case 'pending': return 'bg-amber-100 text-amber-700 border-amber-200';
            case 'processing': return 'bg-blue-100 text-blue-700 border-blue-200';
            case 'shipping': return 'bg-purple-100 text-purple-700 border-purple-200';
            case 'completed': return 'bg-emerald-100 text-emerald-700 border-emerald-200';
            case 'cancelled': return 'bg-rose-100 text-rose-700 border-rose-200';
            default: return 'bg-gray-100 text-gray-700 border-gray-200';
        }
    };

    if (loading) return <div className="p-10 text-center font-bold text-blue-900">Đang tải dữ liệu hệ thống...</div>;

    return (
        <div className="p-8 bg-gray-50 min-h-screen">
            <div className="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                <h2 className="text-3xl font-black text-blue-900 uppercase italic">Quản Lý Đơn Hàng</h2>
                
                {/* BỘ LỌC TRẠNG THÁI */}
                <div className="flex items-center gap-3 bg-white p-2 rounded-2xl shadow-sm border border-gray-100">
                    <span className="text-xs font-bold text-gray-500 uppercase ml-2">Lọc theo:</span>
                    <select 
                        value={currentStatus}
                        onChange={(e) => handleFilterStatus(e.target.value)}
                        className="bg-gray-50 border-none text-blue-900 text-xs font-black rounded-xl p-2 outline-none cursor-pointer hover:bg-blue-50 transition-all"
                    >
                        <option value="">Tất cả đơn hàng</option>
                        <option value="pending">Chờ duyệt</option>
                        <option value="processing">Đang chuẩn bị</option>
                        <option value="shipping">Đang giao</option>
                        <option value="completed">Hoàn thành</option>
                        <option value="cancelled">Đã hủy</option>
                    </select>
                </div>
            </div>
            
            <div className="bg-white rounded-[30px] shadow-xl overflow-hidden border border-gray-100">
                <table className="w-full text-left border-collapse">
                    <thead>
                        <tr className="bg-blue-900 text-white uppercase text-[12px]">
                            <th className="p-4 text-center">Đơn hàng</th>
                            <th className="p-4">Thông tin khách hàng</th>
                            <th className="p-4">Sản phẩm</th>
                            <th className="p-4 text-center">Thanh toán</th>
                            <th className="p-4 text-center">Trạng Thái</th>
                            <th className="p-4 text-center">Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        {orders.length > 0 ? (
                            orders.map((order) => {
                                const isGuest = order.user_id === 999999999 || !order.user;
                                const customerName = isGuest ? (order.customer_name || "Khách vãng lai") : order.user?.name;
                                const customerPhone = isGuest ? (order.customer_phone || "Không có SĐT") : (order.user?.phone || order.customer_phone);

                                return (
                                    <tr key={order.id} className="border-b border-gray-50 hover:bg-blue-50 transition-colors">
                                        <td className="p-4 text-center">
                                            <div className="font-bold text-blue-900">#{order.id}</div>
                                            <div className="text-[9px] text-gray-400 font-bold uppercase">
                                                {new Date(order.created_at).toLocaleDateString('vi-VN')}
                                            </div>
                                        </td>
                                        
                                        <td className="p-4 text-xs">
                                            <div className="flex items-center gap-2">
                                                <span className="font-black text-gray-800 uppercase">{customerName}</span>
                                                {isGuest && (
                                                    <span className="bg-orange-100 text-orange-600 text-[8px] px-1.5 py-0.5 rounded font-bold">GUEST</span>
                                                )}
                                            </div>
                                            <div className="text-green-600 font-black mt-1">
                                                📞 {customerPhone}
                                            </div>
                                            <div className="text-gray-500 italic mt-1 leading-tight max-w-[200px]">
                                                📍 {order.shipping_adr}
                                            </div>
                                        </td>
                                        
                                        <td className="p-4">
                                            <div className="space-y-1">
                                                {order.items?.map((item, idx) => (
                                                    <div key={idx} className="text-[10px] bg-white p-1 rounded border border-gray-100 flex justify-between shadow-sm">
                                                        <span className="font-bold text-gray-700">
                                                            {item.product?.name || "SP đã xóa"} 
                                                            <span className="text-blue-500 ml-1">x{item.quantity}</span>
                                                        </span>
                                                    </div>
                                                ))}
                                            </div>
                                        </td>

                                        <td className="p-4 text-center">
                                            <div className="font-black text-red-500 text-sm">
                                                {Number(order.total_price).toLocaleString()}đ
                                            </div>
                                        </td>
                                        
                                        <td className="p-4 text-center">
                                            <span className={`inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold border uppercase tracking-wider ${getStatusClasses(order.status)}`}>
                                                <span className={`w-1.5 h-1.5 rounded-full mr-1.5 ${
                                                    order.status === 'completed' ? 'bg-emerald-500' : 
                                                    order.status === 'cancelled' ? 'bg-rose-500' : 
                                                    order.status === 'pending' ? 'bg-amber-500' : 'bg-current'
                                                }`}></span>
                                                {order.status === 'pending' ? 'Chờ duyệt' : 
                                                 order.status === 'processing' ? 'Chuẩn bị' : 
                                                 order.status === 'shipping' ? 'Đang giao' : 
                                                 order.status === 'completed' ? 'Hoàn thành' : 'Đã hủy'}
                                            </span>
                                        </td>

                                        <td className="p-4 text-center">
                                            <select 
                                                value={order.status}
                                                onChange={(e) => handleStatusChange(order.id, e.target.value)}
                                                className="bg-white border border-gray-300 text-gray-700 text-[11px] font-semibold rounded-lg block w-full p-1.5 cursor-pointer hover:bg-gray-50 outline-none"
                                            >
                                                <option value="pending">Chờ duyệt</option>
                                                <option value="processing">Đang chuẩn bị</option>
                                                <option value="shipping">Đang giao</option>
                                                <option value="completed">Hoàn thành</option>
                                                <option value="cancelled">Hủy đơn</option>
                                            </select>
                                        </td>
                                    </tr>
                                );
                            })
                        ) : (
                            <tr><td colSpan="6" className="p-10 text-center text-gray-400 font-medium italic">Không tìm thấy đơn hàng phù hợp.</td></tr>
                        )}
                    </tbody>
                </table>

                {/* PHÂN TRANG */}
                {pagination.links && pagination.links.length > 3 && (
                    <div className="flex justify-center items-center gap-2 p-6 bg-white border-t border-gray-100">
                        {pagination.links.map((link, index) => (
                            <button
                                key={index}
                                disabled={!link.url || link.active}
                                onClick={() => handlePageChange(link.url)}
                                className={`
                                    px-3 py-1.5 rounded-xl text-[11px] font-black transition-all duration-300
                                    ${link.active 
                                        ? 'bg-blue-900 text-white shadow-lg scale-110' 
                                        : 'bg-gray-50 text-gray-400 hover:bg-blue-100 hover:text-blue-900 border border-gray-200'
                                    }
                                    ${!link.url ? 'opacity-30 cursor-not-allowed' : 'cursor-pointer'}
                                `}
                                dangerouslySetInnerHTML={{ __html: link.label }}
                            />
                        ))}
                    </div>
                )}
            </div>
        </div>
    );
}

export default AdminOrder;