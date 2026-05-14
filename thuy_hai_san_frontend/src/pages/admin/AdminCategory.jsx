import React, { useState, useEffect } from 'react';
import axios from "../../api/axios"; // Sử dụng biến cấu hình axios chung của dự án
import { getAdminToken } from '../../utils/auth'; 

function AdminCategory({ searchTerm = "" }) {
    const [categories, setCategories] = useState([]);
    const [loading, setLoading] = useState(true);
    const [showModal, setShowModal] = useState(false);
    const [isEditing, setIsEditing] = useState(false);
    const [currentId, setCurrentId] = useState(null);
    
    const [formData, setFormData] = useState({
        name: '',
        description: '',
        is_active: 1
    });

    useEffect(() => {
        fetchCategories();
    }, []);

    const fetchCategories = async () => {
        try {
            const res = await axios.get('/categories-list');
            setCategories(res.data);
            setLoading(false);
        } catch (error) {
            console.error("Lỗi lấy danh mục:", error);
            setLoading(false);
        }
    };

    const handleChange = (e) => {
        const { name, value, type, checked } = e.target;
        setFormData(prev => ({
            ...prev,
            [name]: type === 'checkbox' ? (checked ? 1 : 0) : value
        }));
    };

    // ✅ ĐÃ FIX: Tích hợp Token hợp lệ vào headers của cả yêu cầu POST và PUT
    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            const token = getAdminToken(); // Lấy token để xác thực quyền Admin

            const config = {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            };

            if (isEditing) {
                // Gửi request cập nhật danh mục kèm Token bảo mật
                await axios.put(`/admin/categories/${currentId}`, formData, config);

                is_active: status ? 1 : 0 // Gửi trạng thái mới
            } else {
                // Gửi request thêm mới danh mục kèm Token bảo mật
                await axios.post('/admin/categories', formData, config);
            }
            
            setShowModal(false);
            fetchCategories();
            alert("Thao tác dữ liệu thành công!");
        } catch (error) {
            console.error("Lỗi xử lý dữ liệu:", error.response);
            if (error.response?.status === 401) {
                alert("Phiên đăng nhập Admin đã hết hạn! Vui lòng đăng nhập lại.");
            } else {
                alert(error.response?.data?.message || "Lỗi xử lý dữ liệu hệ thống");
            }
        }
    };

    const openAddModal = () => {
        setIsEditing(false);
        setFormData({ name: '', description: '', is_active: 1 });
        setShowModal(true);
    };

    const openEditModal = (category) => {
        setIsEditing(true);
        setCurrentId(category.id);
        setFormData({
            name: category.name,
            description: category.description || '',
            is_active: category.is_active
        });
        setShowModal(true);
    };

    // ✅ ĐÃ FIX: Bổ sung Token bảo mật cho thao tác XÓA danh mục hải sản
    const handleDelete = async (id) => {
        if (window.confirm("Xác nhận xóa danh mục này?")) {
            try {
                const token = getAdminToken();
                await axios.delete(`/admin/categories/${id}`, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });
                fetchCategories();
                alert("Xóa danh mục thành công!");
            } catch (error) {
                console.error("Lỗi xóa danh mục:", error.response);
                if (error.response?.status === 401) {
                    alert("Bạn không có quyền thực hiện thao tác này!");
                } else {
                    alert("Không thể xóa danh mục đang có sản phẩm liên kết");
                }
            }
        }
    };

    const filteredCategories = categories.filter(c => 
        c.name.toLowerCase().includes(searchTerm.toLowerCase())
    );

    return (
        <div className="max-w-7xl mx-auto p-6 bg-gray-50 min-h-screen">
            <div className="flex justify-between items-center mb-8">
                <div>
                    <h2 className="text-3xl font-black text-blue-900 uppercase italic">Quản lý danh mục</h2>
                    <p className="text-gray-400 text-[10px] font-bold uppercase tracking-widest italic">Hệ thống đồ án - TVU</p>
                </div>
                <button 
                    onClick={openAddModal}
                    className="bg-blue-900 text-white px-8 py-3 rounded-2xl font-black hover:bg-yellow-500 hover:text-blue-900 transition-all shadow-lg active:scale-95"
                >
                    + THÊM DANH MỤC
                </button>
            </div>

            <div className="bg-white rounded-[2.5rem] shadow-sm overflow-hidden border border-gray-100">
                <table className="w-full text-left">
                    <thead className="bg-blue-50/50 border-b border-gray-100">
                        <tr className="text-[10px] uppercase tracking-widest font-black text-blue-900/40">
                            <th className="p-5">STT</th>
                            <th className="p-5">Tên danh mục</th>
                            <th className="p-5">Mô tả</th>
                            <th className="p-5">Trạng thái</th>
                            <th className="p-5 text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody className="divide-y divide-gray-50">
                        {loading ? (
                            <tr>
                                <td colSpan="5" className="text-center py-10 font-bold text-gray-400">Đang tải danh sách danh mục...</td>
                            </tr>
                        ) : filteredCategories.length > 0 ? (
                            filteredCategories.map((item, index) => (
                                <tr key={item.id} className="hover:bg-blue-50/20 transition-all">
                                    <td className="p-5 font-bold text-gray-400">{index + 1}</td>
                                    <td className="p-5 font-black text-blue-900 uppercase">{item.name}</td>
                                    <td className="p-5 text-gray-500 text-sm italic">{item.description || 'Chưa có mô tả'}</td>
                                    <td className="p-5">
                                        <span className={`text-[9px] font-black uppercase ${item.is_active ? 'text-green-500' : 'text-gray-300'}`}>
                                            ● {item.is_active ? 'Hiển thị' : 'Đã ẩn'}
                                        </span>
                                    </td>
                                    <td className="p-5">
                                        <div className="flex justify-center gap-2">
                                            <button onClick={() => openEditModal(item)} className="p-2 hover:bg-blue-900 hover:text-white rounded-lg transition-all text-gray-300">📝</button>
                                            <button onClick={() => handleDelete(item.id)} className="p-2 hover:bg-red-600 hover:text-white rounded-lg transition-all text-gray-300">🗑️</button>
                                        </div>
                                    </td>
                                </tr>
                            ))
                        ) : (
                            <tr>
                                <td colSpan="5" className="text-center py-10 text-gray-400 italic">Không tìm thấy danh mục nào phù hợp.</td>
                            </tr>
                        )}
                    </tbody>
                </table>
            </div>

            {showModal && (
                <div className="fixed inset-0 bg-blue-900/40 backdrop-blur-md flex items-center justify-center z-[100] p-4">
                    <div className="bg-white w-full max-w-lg rounded-[2.5rem] shadow-2xl overflow-hidden animate-in zoom-in duration-200">
                        <div className="p-6 bg-blue-900 text-white flex justify-between items-center">
                            <h3 className="font-black uppercase italic tracking-widest">
                                {isEditing ? '🚀 Cập nhật danh mục' : '🌊 Thêm danh mục mới'}
                            </h3>
                            <button onClick={() => setShowModal(false)} className="text-2xl hover:text-yellow-400 transition-colors">&times;</button>
                        </div>
                        
                        <form onSubmit={handleSubmit} className="p-8 space-y-6">
                            <div>
                                <label className="text-[10px] font-black text-gray-400 uppercase ml-2 mb-1 block">Tên danh mục *</label>
                                <input 
                                    name="name" 
                                    value={formData.name} 
                                    onChange={handleChange} 
                                    required 
                                    className="w-full px-5 py-3 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-900 outline-none font-bold" 
                                />
                            </div>

                            <div>
                                <label className="text-[10px] font-black text-gray-400 uppercase ml-2 mb-1 block">Mô tả ngắn</label>
                                <textarea 
                                    name="description" 
                                    value={formData.description} 
                                    onChange={handleChange} 
                                    rows="3" 
                                    className="w-full px-5 py-3 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-900 outline-none font-bold" 
                                />
                            </div>

                            <div className="flex items-center justify-between p-4 bg-blue-50/50 rounded-2xl border border-blue-100">
                                <span className="text-[10px] font-black text-blue-900 uppercase">Trạng thái hoạt động</span>
                                <label className="relative inline-flex items-center cursor-pointer">
                                    <input 
                                        type="checkbox" 
                                        name="is_active" 
                                        checked={formData.is_active === 1} 
                                        onChange={handleChange} 
                                        className="sr-only peer" 
                                    />
                                    <div className="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-900"></div>
                                </label>
                            </div>

                            <button type="submit" className="w-full bg-blue-900 text-white py-4 rounded-2xl font-black uppercase tracking-widest hover:bg-yellow-400 hover:text-blue-900 transition-all shadow-xl active:scale-95">
                                {isEditing ? 'LƯU THAY ĐỔI' : 'TẠO DANH MỤC'}
                            </button>
                        </form>
                    </div>
                </div>
            )}
        </div>
    );
}

export default AdminCategory;