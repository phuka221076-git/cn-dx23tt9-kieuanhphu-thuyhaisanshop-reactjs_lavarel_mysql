import React, { useState, useEffect } from 'react';
import api from '../../api/axios'; // Phú kiểm tra kỹ đường dẫn trỏ đến file cấu hình axios của dự án nhé
import { getAdminToken, isAuthenticated } from '../../utils/auth'; // Phú kiểm tra kỹ đường dẫn trỏ đến file auth nhé

function AdminDashboard() {
    const [analytics, setAnalytics] = useState(null);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    const [filter, setFilter] = useState('all'); // Các trạng thái: all, today, week, month, year

    const isAdmin = isAuthenticated('admin');
    const token = getAdminToken();

    useEffect(() => {
        const fetchAnalytics = async () => {
            if (!token) {
                setLoading(false);
                return;
            }
            try {
                const res = await api.get('/admin/analytics', {
                    params: { filter: filter }, 
                    headers: { 
                        Authorization: `Bearer ${token}`,
                        Accept: 'application/json'
                    }
                });
                setAnalytics(res.data);
                setError(null);
            } catch (err) {
                console.error("Lỗi lấy dữ liệu thống kê:", err);
                setError(err.response?.data?.message || "Không thể tải dữ liệu báo cáo hệ thống.");
            } finally {
                setLoading(false);
            }
        };

        if (isAdmin) {
            fetchAnalytics();
        } else {
            setLoading(false);
        }
    }, [token, isAdmin, filter]);

    // Trình chặn bảo mật giao diện nếu không phải Admin
    if (!isAdmin) {
        return (
            <div className="max-w-4xl mx-auto mt-20 p-10 bg-red-50 rounded-[40px] text-center border border-red-100 font-sans">
                <h2 className="text-2xl font-black text-red-900 uppercase">Truy cập bị từ chối!</h2>
                <p className="text-red-700 mt-2 font-medium">Khu vực này chỉ dành riêng cho tài khoản quản trị viên.</p>
            </div>
        );
    }

    return (
        <div className="max-w-6xl mx-auto mt-8 p-6 font-sans antialiased">
            
            {/* Tiêu đề trang */}
            <div className="mb-8">
                <h2 className="text-4xl font-black text-blue-900 uppercase italic tracking-tighter border-b-4 border-yellow-400 inline-block pb-1">
                    An tâm quản trị
                </h2>
                <p className="text-xs text-gray-400 font-bold uppercase tracking-widest mt-2">
                    Hệ thống báo cáo chung & doanh thu cửa hàng
                </p>
            </div>

            {/* Thông báo lỗi nếu gọi API thất bại */}
            {error && (
                <div className="bg-red-50 text-red-600 p-4 rounded-2xl mb-6 font-bold text-sm border border-red-100 shadow-sm">
                    ⚠️ {error}
                </div>
            )}

            {/* Thanh công cụ chọn mốc thời gian */}
            <div className="bg-white p-4 rounded-[24px] shadow-sm border border-gray-100 mb-8 flex items-center justify-between flex-wrap gap-4">
                <div className="flex items-center gap-2">
                    <span className="text-sm font-bold text-gray-500">Phạm vi dữ liệu:</span>
                    <span className="bg-blue-50 text-blue-900 text-[11px] px-3 py-1 rounded-full font-black uppercase tracking-wider">
                        {filter === 'all' && 'Tất cả thời gian'}
                        {filter === 'today' && 'Trong ngày hôm nay'}
                        {filter === 'week' && 'Trong tuần này'}
                        {filter === 'month' && 'Trong tháng này'}
                        {filter === 'year' && 'Trong năm nay'}
                    </span>
                </div>
                
                {/* Các nút bấm lọc nhanh */}
                <div className="flex items-center gap-1.5 bg-gray-50 p-1.5 rounded-2xl">
                    {[
                        { id: 'all', label: 'Tất cả' },
                        { id: 'today', label: 'Ngày' },
                        { id: 'week', label: 'Tuần' },
                        { id: 'month', label: 'Tháng' },
                        { id: 'year', label: 'Năm' }
                    ].map((item) => (
                        <button
                            key={item.id}
                            onClick={() => {
                                setLoading(true); // Bật trạng thái tải lại để đồng bộ số liệu mượt hơn
                                setFilter(item.id);
                            }}
                            className={`px-4 py-2 rounded-xl text-xs font-black uppercase tracking-wider transition-all duration-200 ${
                                filter === item.id 
                                    ? 'bg-blue-900 text-white shadow-md shadow-blue-900/20' 
                                    : 'text-gray-600 hover:bg-gray-200/60 hover:text-gray-900'
                            }`}
                        >
                            {item.label}
                        </button>
                    ))}
                </div>
            </div>

            {/* Hiển thị khi đang xử lý tải dữ liệu */}
            {loading ? (
                <div className="flex flex-col items-center justify-center py-20">
                    <div className="w-10 h-10 border-4 border-blue-900 border-t-transparent rounded-full animate-spin mb-4"></div>
                    <p className="text-sm font-bold text-blue-900 tracking-wide animate-pulse">Đang kết xuất số liệu báo cáo...</p>
                </div>
            ) : (
                <>
                    {/* Khối hiển thị số liệu doanh thu tổng quan */}
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                        <div className="bg-white p-8 rounded-[35px] shadow-sm border border-gray-100 flex flex-col justify-between relative overflow-hidden group hover:shadow-md transition-shadow">
                            <div className="absolute top-0 right-0 p-6 opacity-10 text-6xl select-none">💰</div>
                            <div>
                                <span className="text-xs font-black text-gray-400 uppercase tracking-widest block">
                                    Doanh thu thực nhận
                                </span>
                                <h3 className="text-4xl font-black text-green-600 mt-4 tracking-tight">
                                    {Number(analytics?.total_revenue || 0).toLocaleString()} <span className="text-xl ml-0.5 font-bold">đ</span>
                                </h3>
                            </div>
                            <p className="text-[10px] text-gray-400 font-bold italic mt-6 border-t border-gray-50 pt-3">
                                * Chỉ tính trên các đơn hàng đã xác nhận giao thành công
                            </p>
                        </div>
                    </div>

                    {/* Bảng kết quả Top sản phẩm thủy hải sản bán chạy */}
                    <div className="bg-white p-6 rounded-[35px] shadow-sm border border-gray-100">
                        <div className="mb-6">
                            <h3 className="text-lg font-black text-blue-900 uppercase tracking-tight flex items-center gap-2">
                                🏆 Top 5 sản phẩm bán chạy hàng đầu
                            </h3>
                            <p className="text-xs text-gray-400 font-medium mt-0.5">Xếp hạng dựa trên khối lượng và số lượng đặt hàng</p>
                        </div>

                        <div className="overflow-x-auto">
                            <table className="w-full text-left border-collapse">
                                <thead>
                                    <tr className="border-b border-gray-100 text-[11px] text-gray-400 uppercase font-black tracking-wider">
                                        <th className="pb-3 pl-2">Tên sản phẩm hải sản</th>
                                        <th className="pb-3 text-center">Sản lượng đã bán</th>
                                        <th className="pb-3 text-right pr-2">Tổng doanh thu thu về</th>
                                    </tr>
                                </thead>
                                <tbody className="divide-y divide-gray-100 text-sm font-bold text-gray-700">
                                    {analytics?.top_products && analytics.top_products.length > 0 ? (
                                        analytics.top_products.map((prod, index) => (
                                            <tr key={prod.id} className="hover:bg-gray-50/40 transition-colors">
                                                <td className="py-4 pl-2 text-blue-900 font-black flex items-center gap-2">
                                                    <span className="text-xs w-5 h-5 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center font-bold">
                                                        {index + 1}
                                                    </span>
                                                    <span>{prod.name}</span>
                                                </td>
                                                <td className="py-4 text-center text-blue-600 font-black">
                                                    {prod.total_sold} <span className="text-xs font-bold text-gray-400">lượt</span>
                                                </td>
                                                <td className="py-4 text-right text-red-500 font-black pr-2">
                                                    {Number(prod.product_revenue || 0).toLocaleString()}đ
                                                </td>
                                            </tr>
                                        ))
                                    ) : (
                                        <tr>
                                            <td colSpan="3" className="py-12 text-center text-gray-400 italic font-medium">
                                                Chưa ghi nhận dữ liệu bán hàng trong khoảng thời gian này.
                                            </td>
                                        </tr>
                                    )}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </>
            )}
        </div>
    );
}

export default AdminDashboard;