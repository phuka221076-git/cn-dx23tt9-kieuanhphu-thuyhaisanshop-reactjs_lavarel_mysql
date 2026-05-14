import React, { useState, useEffect } from 'react';
import api from '../../api/axios'; 
import { getAdminToken, isAuthenticated } from '../../utils/auth'; 

function AdminDashboard() {
    const [analytics, setAnalytics] = useState(null);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    const [filter, setFilter] = useState('all');

    // ✅ FIX 1: Lấy dữ liệu trực tiếp để tránh cache từ hàm auth
    const token = getAdminToken() || localStorage.getItem('admin_token');
    
    // Kiểm tra role admin (bọc trong useMemo hoặc check trực tiếp để đảm bảo tính thời gian thực)
    const adminInfo = JSON.parse(localStorage.getItem('admin_info') || '{}');
    const isAdmin = isAuthenticated('admin') || adminInfo.role === 'admin';

    useEffect(() => {
        const fetchAnalytics = async () => {
            // Nếu không có token, không gọi API để tránh lỗi 401/403
            if (!token || !isAdmin) {
                setLoading(false);
                return;
            }

            try {
                // ✅ FIX 2: Ép kiểu filter về string và đảm bảo header luôn mới nhất
                const res = await api.get('/admin/analytics', {
                    params: { filter: String(filter) }, 
                    headers: { 
                        Authorization: `Bearer ${token}`,
                        Accept: 'application/json'
                    }
                });
                
                if (res.data) {
                    setAnalytics(res.data);
                    setError(null);
                }
            } catch (err) {
                console.error("Lỗi API Dashboard:", err);
                // ✅ FIX 3: Bắt lỗi 403 cụ thể từ Backend để thông báo cho Phú
                if (err.response?.status === 403) {
                    setError("Quyền Admin không hợp lệ. Vui lòng đăng nhập lại tài khoản Quản trị.");
                } else {
                    setError(err.response?.data?.message || "Không thể kết nối đến máy chủ.");
                }
            } finally {
                setLoading(false);
            }
        };

        fetchAnalytics();
    }, [token, isAdmin, filter]);

    // Trình chặn bảo mật giao diện
    if (!isAdmin || !token) {
        return (
            <div className="max-w-4xl mx-auto mt-20 p-10 bg-red-50 rounded-[40px] text-center border-2 border-red-100 shadow-2xl font-sans">
                <div className="text-6xl mb-4">🚫</div>
                <h2 className="text-3xl font-black text-red-900 uppercase italic">Truy cập bị từ chối!</h2>
                <p className="text-red-700 mt-2 font-bold text-lg">
                    Tài khoản của Bạn (hoặc quản trị viên) chưa được xác thực quyền Admin.
                </p>
                <button 
                    onClick={() => window.location.href = '/login'}
                    className="mt-6 px-8 py-3 bg-red-600 text-white rounded-full font-bold uppercase hover:bg-red-700 transition-all"
                >
                    Đăng nhập lại Admin
                </button>
            </div>
        );
    }

    return (
        <div className="max-w-6xl mx-auto mt-8 p-6 font-sans antialiased text-slate-900">
            {/* Header Section */}
            <div className="mb-10 flex justify-between items-end">
                <div>
                    <h2 className="text-5xl font-black text-blue-950 uppercase italic tracking-tighter leading-none">
                        BÁO CÁO <span className="text-yellow-500">THỦY HẢI SẢN</span>
                    </h2>
                    <p className="text-sm text-slate-400 font-bold uppercase tracking-[0.2em] mt-3 flex items-center gap-2">
                        <span className="w-2 h-2 bg-green-500 rounded-full animate-ping"></span>
                        Dữ liệu thời gian thực cho Admin
                    </p>
                </div>
                <div className="text-right hidden md:block">
                    <p className="text-xs font-black text-slate-300 uppercase">Người vận hành</p>
                    <p className="text-lg font-black text-blue-900 italic">Admin GS&VHHT</p>
                </div>
            </div>

            {error && (
                <div className="bg-orange-100 border-l-8 border-orange-500 text-orange-700 p-5 rounded-2xl mb-8 font-black flex items-center gap-3">
                    <span>⚠️</span> {error}
                </div>
            )}

            {/* Filter Bar */}
            <div className="bg-slate-900 p-2 rounded-[30px] shadow-2xl mb-10 flex items-center justify-between">
                <div className="flex items-center gap-1">
                    {[
                        { id: 'all', label: 'Tổng hợp' },
                        { id: 'today', label: 'Hôm nay' },
                        { id: 'week', label: 'Tuần này' },
                        { id: 'month', label: 'Tháng này' },
                        { id: 'year', label: 'Năm nay' }
                    ].map((item) => (
                        <button
                            key={item.id}
                            onClick={() => {
                                setLoading(true);
                                setFilter(item.id);
                            }}
                            className={`px-6 py-3 rounded-[24px] text-xs font-black uppercase tracking-widest transition-all ${
                                filter === item.id 
                                    ? 'bg-yellow-400 text-slate-900 shadow-inner' 
                                    : 'text-slate-400 hover:text-white hover:bg-slate-800'
                            }`}
                        >
                            {item.label}
                        </button>
                    ))}
                </div>
            </div>

            {loading ? (
                <div className="flex flex-col items-center justify-center py-32 bg-slate-50 rounded-[50px] border-4 border-dashed border-slate-200">
                    <div className="w-16 h-16 border-8 border-blue-900 border-t-yellow-400 rounded-full animate-spin mb-6"></div>
                    <p className="text-xl font-black text-blue-900 uppercase italic tracking-tighter">Đang tính toán doanh thu...</p>
                </div>
            ) : (
                <div className="animate-in fade-in slide-in-from-bottom-4 duration-700">
                    {/* Revenue Card */}
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                        <div className="md:col-span-2 bg-gradient-to-br from-blue-900 to-blue-800 p-10 rounded-[50px] shadow-2xl relative overflow-hidden text-white">
                            <div className="absolute -right-10 -bottom-10 text-[200px] opacity-10">💵</div>
                            <h4 className="text-sm font-black uppercase tracking-widest text-blue-200 opacity-70">Tổng doanh thu kết xuất</h4>
                            <div className="text-6xl md:text-7xl font-black mt-4 flex items-baseline gap-2">
                                {Number(analytics?.total_revenue || 0).toLocaleString()}
                                <span className="text-2xl text-yellow-400 uppercase italic">VNĐ</span>
                            </div>
                            <p className="mt-8 text-xs font-bold text-blue-200 border-t border-blue-700/50 pt-4 italic">
                                * Thống kê dựa trên mốc: {filter.toUpperCase()}
                            </p>
                        </div>
                        
                        <div className="bg-white p-10 rounded-[50px] border-4 border-blue-900 flex flex-col justify-center items-center text-center">
                            <span className="text-5xl mb-2">📦</span>
                            <h4 className="text-xs font-black uppercase text-slate-400">Trạng thái kho</h4>
                            <p className="text-2xl font-black text-blue-900 mt-2">Đang ổn định</p>
                        </div>
                    </div>

                    {/* Top Products Table */}
                    <div className="bg-white rounded-[50px] shadow-xl border border-slate-100 overflow-hidden">
                        <div className="bg-slate-50 px-10 py-8 border-b border-slate-100 flex justify-between items-center">
                            <h3 className="text-2xl font-black text-blue-950 uppercase italic tracking-tighter">
                                🔥 Top 5 "Chiến thần" doanh số
                            </h3>
                        </div>
                        <div className="p-4 overflow-x-auto">
                            <table className="w-full">
                                <thead>
                                    <tr className="text-left text-[11px] font-black text-slate-400 uppercase tracking-[0.2em]">
                                        <th className="px-6 py-4">Xếp hạng</th>
                                        <th className="px-6 py-4">Sản phẩm hải sản</th>
                                        <th className="px-6 py-4 text-center">Đã bán</th>
                                        <th className="px-6 py-4 text-right">Doanh thu</th>
                                    </tr>
                                </thead>
                                <tbody className="divide-y divide-slate-50">
                                    {analytics?.top_products?.length > 0 ? (
                                        analytics.top_products.map((prod, index) => (
                                            <tr key={prod.id} className="hover:bg-blue-50/50 transition-all group">
                                                <td className="px-6 py-6">
                                                    <span className={`w-10 h-10 rounded-2xl flex items-center justify-center font-black text-lg ${
                                                        index === 0 ? 'bg-yellow-400 text-slate-900' : 'bg-slate-100 text-slate-400'
                                                    }`}>
                                                        0{index + 1}
                                                    </span>
                                                </td>
                                                <td className="px-6 py-6">
                                                    <p className="font-black text-blue-950 text-lg group-hover:text-blue-600 transition-colors uppercase tracking-tight">
                                                        {prod.name}
                                                    </p>
                                                </td>
                                                <td className="px-6 py-6 text-center">
                                                    <span className="bg-blue-100 text-blue-800 px-4 py-1.5 rounded-full font-black text-sm">
                                                        {prod.total_sold} đơn
                                                    </span>
                                                </td>
                                                <td className="px-6 py-6 text-right font-black text-xl text-red-500">
                                                    {Number(prod.product_revenue || 0).toLocaleString()}<span className="text-xs ml-1">đ</span>
                                                </td>
                                            </tr>
                                        ))
                                    ) : (
                                        <tr>
                                            <td colSpan="4" className="py-20 text-center text-slate-300 font-bold italic">
                                                Chưa có dữ liệu giao dịch cho kỳ này.
                                            </td>
                                        </tr>
                                    )}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            )}
        </div>
    );
}

export default AdminDashboard;