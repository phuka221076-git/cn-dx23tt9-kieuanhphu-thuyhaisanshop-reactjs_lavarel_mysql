import React, { useState, useEffect } from 'react';
import api from '../api/axios';
import { getAdminToken } from '../utils/auth';

function AdminOrderManager() {
    const [orders, setOrders] = useState([]);
    const [loading, setLoading] = useState(true);
    const token = getAdminToken();

    useEffect(() => {
        const fetchAllOrders = async () => {
            try {
                const res = await api.get('/admin/orders', {
                    headers: { Authorization: `Bearer ${token}` }
                });
                setOrders(res.data);
            } catch (err) {
                alert("Lỗi tải danh sách đơn hàng toàn hệ thống");
            } finally {
                setLoading(false);
            }
        };
        fetchAllOrders();
    }, [token]);

    if (loading) return <div className="p-10 text-center font-bold">Đang tải dữ liệu hệ thống...</div>;

    return (
        <div className="p-8 bg-gray-100 min-h-screen">
            <h1 className="text-3xl font-black text-blue-900 mb-8">📦 QUẢN LÝ ĐƠN HÀNG TOÀN HỆ THỐNG</h1>
            
            <div className="overflow-x-auto bg-white rounded-3xl shadow-xl">
                <table className="w-full text-left border-collapse">
                    <thead className="bg-blue-900 text-white">
                        <tr>
                            <th className="p-4">Mã Đơn</th>
                            <th className="p-4">Khách Hàng</th>
                            <th className="p-4">SĐT</th>
                            <th className="p-4">Tổng Tiền</th>
                            <th className="p-4">Trạng Thái</th>
                            <th className="p-4">Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        {orders.map(order => (
                            <tr key={order.id} className="border-b hover:bg-blue-50 transition">
                                <td className="p-4 font-bold text-blue-800">#{order.id}</td>
                                <td className="p-4">{order.customer_name || order.user?.name}</td>
                                <td className="p-4">{order.customer_phone}</td>
                                <td className="p-4 font-black text-red-500">{Number(order.total_price).toLocaleString()}đ</td>
                                <td className="p-4">
                                    <span className="px-3 py-1 rounded-full text-xs font-bold uppercase bg-yellow-100 text-yellow-700">
                                        {order.status}
                                    </span>
                                </td>
                                <td className="p-4">
                                    <button className="bg-blue-600 text-white px-4 py-1 rounded-lg text-sm hover:bg-blue-700">
                                        Chi tiết / Xử lý
                                    </button>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </div>
        </div>
    );
}

export default AdminOrderManager;