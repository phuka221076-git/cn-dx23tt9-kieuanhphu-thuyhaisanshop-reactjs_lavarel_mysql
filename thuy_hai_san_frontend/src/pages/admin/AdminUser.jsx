import React, { useState, useEffect, useCallback } from 'react';
import { useLocation } from 'react-router-dom'; 
import axios from "../../api/axios";
import { getAdminToken } from '../../utils/auth'; // Đảm bảo đường dẫn helper này khớp với cấu trúc thư mục của bạn

function AdminUser() {
    const [users, setUsers] = useState([]);
    const [showModal, setShowModal] = useState(false);
    const [isEditing, setIsEditing] = useState(false);
    const [currentId, setCurrentId] = useState(null);

    const location = useLocation();
    const queryParams = new URLSearchParams(location.search);
    const searchTerm = queryParams.get('search') || '';

    const initialForm = { name: '', email: '', password: '', phone: '', address: '', role: 'user', is_active: 1 };
    const [formData, setFormData] = useState(initialForm);

    // ✅ ĐÃ FIX: Đính kèm Header Authorization cho yêu cầu lấy danh sách người dùng
    const fetchUsers = useCallback(async () => {
        try {
            const token = getAdminToken();
            const res = await axios.get(`/admin/users`, {
                params: { search: searchTerm },
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });
            const userData = res.data?.data || res.data;
            setUsers(Array.isArray(userData) ? userData : []);
        } catch (error) {
            console.error("Lỗi TVU API:", error);
            setUsers([]);
        }
    }, [searchTerm]);

    useEffect(() => {
        fetchUsers();
    }, [fetchUsers]); 

    // ✅ ĐÃ FIX: Đính kèm Header Authorization cho yêu cầu thêm mới và cập nhật thông tin
    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            const token = getAdminToken();
            const payload = { ...formData, is_active: formData.is_active ? 1 : 0 };
            
            const config = {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            };

            if (isEditing) {
                await axios.put(`/admin/users/${currentId}`, payload, config);
            } else {
                await axios.post('/admin/users', payload, config);
            }
            setShowModal(false);
            fetchUsers();
            alert("Hệ thống TVU: Thao tác thành công!");
        } catch (error) {
            alert(error.response?.data?.message || "Lỗi xử lý dữ liệu");
        }
    };

    const openEdit = (user) => {
        setIsEditing(true);
        setCurrentId(user.id);
        setFormData({ ...user, password: '', is_active: Number(user.is_active) });
        setShowModal(true);
    };

    // ✅ ĐÃ FIX: Đính kèm Header Authorization cho yêu cầu xóa nhân sự
    const handleDelete = async (id) => {
        if(window.confirm("Xác nhận xóa nhân sự này khỏi hệ thống?")) {
            try {
                const token = getAdminToken();
                await axios.delete(`/admin/users/${id}`, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });
                fetchUsers();
            } catch (error) {
                alert("Không thể xóa nhân sự này.");
            }
        }
    };

    return (
        <div className="max-w-7xl mx-auto p-6 bg-gray-50 min-h-screen">
            {/* Header */}
            <div className="flex justify-between items-center mb-10 bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100">
                <div className="flex items-center gap-4">
                    <div className="bg-blue-900 p-3 rounded-2xl shadow-lg">
                        <span className="text-2xl text-white">👤</span>
                    </div>
                    <div>
                        <h2 className="text-xl font-black text-blue-900 uppercase italic leading-none">Quản lý Nhân sự</h2>
                        <p className="text-[9px] font-bold text-gray-400 uppercase tracking-widest">Khoa KT&CN - ĐH Trà Vinh</p>
                    </div>
                </div>

                <button 
                    onClick={() => { setIsEditing(false); setFormData(initialForm); setShowModal(true); }}
                    className="bg-blue-900 text-white px-8 py-3 rounded-2xl font-black text-sm hover:bg-yellow-500 hover:text-blue-900 transition-all uppercase shadow-md"
                >
                    + Thêm tài khoản
                </button>
            </div>

            {/* Table */}
            <div className="bg-white rounded-[2.5rem] shadow-sm overflow-hidden border border-gray-100">
                <table className="w-full text-left">
                    <thead className="bg-blue-50/50 border-b border-gray-100 text-[10px] uppercase font-black text-blue-900/40">
                        <tr>
                            <th className="p-6">Thành viên</th>
                            <th className="p-6">Liên hệ</th>
                            <th className="p-6">Quyền</th>
                            <th className="p-6 text-center">Trạng thái</th>
                            <th className="p-6 text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody className="divide-y divide-gray-50">
                        {users.length > 0 ? users.map((user) => (
                            <tr key={user.id} className="hover:bg-blue-50/10 transition-all">
                                <td className="p-6">
                                    <div className="font-black text-blue-900 uppercase tracking-tight">{user.name}</div>
                                    <div className="text-[9px] text-gray-400 font-bold italic">ID: #{user.id}</div>
                                </td>
                                <td className="p-6">
                                    <div className="text-xs font-bold text-gray-600">{user.email}</div>
                                    <div className="text-[10px] text-gray-400 font-bold">{user.phone || 'Chưa cập nhật'}</div>
                                </td>
                                <td className="p-6">
                                    <span className={`px-3 py-1 rounded-full text-[9px] font-black uppercase ${user.role === 'admin' ? 'bg-red-100 text-red-600' : 'bg-blue-100 text-blue-600'}`}>
                                        {user.role}
                                    </span>
                                </td>
                                <td className="p-6 text-center">
                                    <span className={`inline-block w-2.5 h-2.5 rounded-full ${user.is_active ? 'bg-green-500 shadow-[0_0_8px_rgba(34,197,94,0.5)]' : 'bg-red-500'}`}></span>
                                </td>
                                <td className="p-6 text-center">
                                    <div className="flex justify-center gap-3">
                                        <button onClick={() => openEdit(user)} className="hover:scale-125 transition-transform text-lg" title="Sửa">📝</button>
                                        <button onClick={() => handleDelete(user.id)} className="hover:scale-125 transition-transform text-lg" title="Xóa">🗑️</button>
                                    </div>
                                </td>
                            </tr>
                        )) : (
                            <tr>
                                <td colSpan="5" className="p-10 text-center font-bold text-gray-400 italic">Không tìm thấy nhân sự nào...</td>
                            </tr>
                        )}
                    </tbody>
                </table>
            </div>

            {/* Modal */}
            {showModal && (
                <div className="fixed inset-0 bg-blue-900/60 backdrop-blur-sm flex items-center justify-center z-[100] p-4">
                    <div className="bg-white w-full max-w-xl rounded-[2.5rem] shadow-2xl p-8 transform transition-all">
                        <div className="flex justify-between items-center mb-6">
                            <h3 className="font-black uppercase italic text-blue-900 flex items-center gap-2">
                                {isEditing ? '⚡ Cập nhật' : '✨ Tạo mới'} Tài khoản
                            </h3>
                            <button onClick={() => setShowModal(false)} className="text-3xl leading-none text-gray-400 hover:text-red-500 transition-colors">&times;</button>
                        </div>
                        <form onSubmit={handleSubmit} className="grid grid-cols-2 gap-5">
                            <div className="col-span-1">
                                <label className="text-[9px] font-black text-gray-400 uppercase ml-1">Họ tên</label>
                                <input value={formData.name} onChange={e => setFormData({...formData, name: e.target.value})} className="w-full p-3.5 bg-gray-50 rounded-xl font-bold text-blue-900 focus:ring-2 focus:ring-blue-900 outline-none transition-all" required />
                            </div>
                            <div className="col-span-1">
                                <label className="text-[9px] font-black text-gray-400 uppercase ml-1">SĐT</label>
                                <input value={formData.phone} onChange={e => setFormData({...formData, phone: e.target.value})} className="w-full p-3.5 bg-gray-50 rounded-xl font-bold text-blue-900 focus:ring-2 focus:ring-blue-900 outline-none transition-all" />
                            </div>
                            <div className="col-span-2">
                                <label className="text-[9px] font-black text-gray-400 uppercase ml-1">Email</label>
                                <input type="email" value={formData.email} onChange={e => setFormData({...formData, email: e.target.value})} className="w-full p-3.5 bg-gray-50 rounded-xl font-bold text-blue-900 focus:ring-2 focus:ring-blue-900 outline-none transition-all" required />
                            </div>
                            <div className="col-span-1">
                                <label className="text-[9px] font-black text-gray-400 uppercase ml-1">Mật khẩu</label>
                                <input type="password" value={formData.password} onChange={e => setFormData({...formData, password: e.target.value})} className="w-full p-3.5 bg-gray-50 rounded-xl font-bold text-blue-900 focus:ring-2 focus:ring-blue-900 outline-none transition-all" placeholder={isEditing ? 'Để trống nếu không đổi' : 'Tối thiểu 6 ký tự'} required={!isEditing} />
                            </div>
                            <div className="col-span-1">
                                <label className="text-[9px] font-black text-gray-400 uppercase ml-1">Quyền hạn</label>
                                <select value={formData.role} onChange={e => setFormData({...formData, role: e.target.value})} className="w-full p-3.5 bg-gray-50 rounded-xl font-bold text-blue-900 focus:ring-2 focus:ring-blue-900 outline-none transition-all">
                                    <option value="user">Người dùng (User)</option>
                                    <option value="admin">Quản trị viên (Admin)</option>
                                </select>
                            </div>
                            <div className="col-span-2 flex items-center gap-3 p-4 bg-blue-50/50 rounded-2xl border border-blue-100">
                                <input type="checkbox" id="active_chk" checked={Boolean(formData.is_active)} onChange={e => setFormData({...formData, is_active: e.target.checked ? 1 : 0})} className="w-5 h-5 accent-blue-900 cursor-pointer" />
                                <label htmlFor="active_chk" className="text-[11px] font-black text-blue-900 uppercase cursor-pointer select-none">Kích hoạt tài khoản này</label>
                            </div>
                            <button className="col-span-2 bg-blue-900 text-white py-4 rounded-2xl font-black uppercase hover:bg-yellow-400 hover:text-blue-900 transition-all shadow-lg active:scale-[0.98]">
                                {isEditing ? 'Cập nhật ngay' : 'Tạo tài khoản mới'}
                            </button>
                        </form>
                    </div>
                </div>
            )}
        </div>
    );
}

export default AdminUser;