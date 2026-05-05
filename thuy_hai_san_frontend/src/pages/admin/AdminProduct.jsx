import React, { useState, useEffect } from 'react';
import axios from "../../api/axios";
import { getAdminToken } from '../../utils/auth'; // Đảm bảo đường dẫn này đúng với dự án của bạn

const createSlug = (str) => {
    if (!str) return "";
    return str.toLowerCase()
        .normalize("NFD").replace(/[\u0300-\u036f]/g, "")
        .replace(/[đĐ]/g, "d")
        .replace(/([^0-9a-z-\s])/g, "")
        .replace(/(\s+)/g, "-")
        .replace(/-+/g, "-")
        .replace(/^-+|-+$/g, "");
};

const removeAccents = (str) => {
    if (!str) return "";
    return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "").replace(/đ/g, "d").replace(/Đ/g, "D");
};

function AdminProduct({ searchTerm = "" }) {
    const [products, setProducts] = useState([]);
    const [categories, setCategories] = useState([]);
    const [loading, setLoading] = useState(true);
    const [showModal, setShowModal] = useState(false);
    const [isEditing, setIsEditing] = useState(false);
    const [currentId, setCurrentId] = useState(null);
    
    const [formData, setFormData] = useState({
        name: '', price: '', size: '', stock: 0, unit: 'kg',
        type: 'fresh', description: '', category_id: '', is_active: 1, image: null
    });

    useEffect(() => {
        fetchProducts();
        fetchCategories();
    }, []);

    const fetchProducts = async () => {
        try {
            const res = await axios.get('/products');
            setProducts(Array.isArray(res.data) ? res.data : []);
            setLoading(false);
        } catch (error) { setLoading(false); }
    };

    const fetchCategories = async () => {
        try {
            const res = await axios.get('/categories-list');
            setCategories(res.data);
            if (res.data.length > 0 && !formData.category_id) {
                setFormData(prev => ({ ...prev, category_id: res.data[0].id }));
            }
        } catch (error) { console.error("Lỗi lấy danh mục:", error); }
    };

    const handleDelete = async (id) => {
        if (window.confirm("Xác nhận xóa sản phẩm này?")) {
            try {
                const token = getAdminToken();
                await axios.delete(`/products/${id}`, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });
                fetchProducts();
                alert("Đã xóa!");
            } catch (error) { 
                console.error("Lỗi xóa sản phẩm:", error.response);
                alert("Lỗi xóa sản phẩm hoặc phiên đăng nhập hết hạn"); 
            }
        }
    };

    const handleChange = (e) => {
        const { name, value, files, type, checked } = e.target;
        setFormData(prev => ({
            ...prev,
            [name]: type === 'file' ? files[0] : (type === 'checkbox' ? (checked ? 1 : 0) : value)
        }));
    };

    const openAddModal = () => {
        setIsEditing(false);
        setFormData({
            name: '', price: '', size: '', stock: 0, unit: 'kg',
            type: 'fresh', description: '', category_id: categories[0]?.id || '', is_active: 1, image: null
        });
        setShowModal(true);
    };

    const openEditModal = (product) => {
        setIsEditing(true);
        setCurrentId(product.id);
        setFormData({
            name: product.name || '',
            price: product.price || '',
            size: product.size || '',
            stock: product.stock || 0,
            unit: product.unit || 'kg',
            type: product.type || 'fresh',
            description: product.description || '',
            category_id: product.category_id || '',
            is_active: product.is_active,
            image: null
        });
        setShowModal(true);
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        const token = getAdminToken();
        const data = new FormData();
        
        data.append('name', formData.name);
        data.append('slug', createSlug(formData.name));
        data.append('price', parseFloat(formData.price) || 0);
        data.append('stock', parseInt(formData.stock) || 0);
        data.append('category_id', formData.category_id);
        data.append('unit', formData.unit || 'kg');
        data.append('size', formData.size || '');
        data.append('type', formData.type);
        data.append('description', formData.description || '');
        data.append('is_active', formData.is_active);
        
        if (formData.image) data.append('image', formData.image);
        if (isEditing) data.append('_method', 'PUT');

        try {
            await axios.post(isEditing ? `/products/${currentId}` : '/products', data, {
                headers: { 
                    'Content-Type': 'multipart/form-data',
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });
            setShowModal(false);
            fetchProducts();
            alert("Thành công!");
        } catch (error) {
            console.error("Lỗi gửi dữ liệu:", error.response);
            if (error.response?.status === 401) {
                alert("Phiên đăng nhập hết hạn, vui lòng đăng nhập lại hệ thống quản trị!");
            } else {
                alert(error.response?.data?.message || "Lỗi dữ liệu đầu vào");
            }
        }
    };

    const filteredProducts = products.filter(p => 
        removeAccents(p.name.toLowerCase()).includes(removeAccents(searchTerm.toLowerCase()))
    );

    return (
        <div className="max-w-7xl mx-auto p-6 bg-gray-50 min-h-screen">
            <div className="flex justify-between items-center mb-8">
                <div>
                    <h2 className="text-3xl font-black text-blue-900 uppercase italic">Quản lý kho hàng</h2>
                    <p className="text-gray-400 text-[10px] font-bold uppercase tracking-widest italic">Hệ thống đồ án - TVU</p>
                </div>
                <button onClick={openAddModal} className="bg-blue-900 text-white px-8 py-3 rounded-2xl font-black hover:bg-yellow-500 hover:text-blue-900 transition-all shadow-lg active:scale-95">
                    + THÊM MỚI
                </button>
            </div>

            <div className="bg-white rounded-[2.5rem] shadow-sm overflow-hidden border border-gray-100">
                <table className="w-full text-left">
                    <thead className="bg-blue-50/50 border-b border-gray-100">
                        <tr className="text-[10px] uppercase tracking-widest font-black text-blue-900/40">
                            <th className="p-5">Sản phẩm</th>
                            <th className="p-5">Giá / Đơn vị</th>
                            <th className="p-5">Kích cỡ</th>
                            <th className="p-5">Số tồn</th>
                            <th className="p-5">Trạng thái</th>
                            <th className="p-5 text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody className="divide-y divide-gray-50">
                        {filteredProducts.map((item) => (
                            <tr key={item.id} className="hover:bg-blue-50/20 transition-all">
                                <td className="p-5">
                                    <div className="flex items-center gap-4">
                                        <div className="w-12 h-12 bg-gray-100 rounded-xl overflow-hidden shadow-sm border border-white">
                                            {item.image && (
                                                <img src={`http://127.0.0.1:8000/storage/${item.image}`} className="w-full h-full object-cover" alt={item.name} />
                                            )}
                                        </div>
                                        <div>
                                            <p className="font-bold text-blue-900">{item.name}</p>
                                            <p className="text-[9px] text-gray-400 font-bold uppercase">{item.category?.name}</p>
                                        </div>
                                    </div>
                                </td>
                                <td className="p-5 font-black text-red-600">
                                    {Number(item.price).toLocaleString()}đ <span className="text-gray-400 font-normal text-[9px]">/{item.unit}</span>
                                </td>
                                <td className="p-5">
                                    <span className="px-3 py-1 bg-gray-100 rounded-full text-[10px] font-black text-gray-600 uppercase">
                                        {item.size || 'N/A'}
                                    </span>
                                </td>
                                <td className="p-5 font-black text-blue-900">
                                    {item.stock} <span className="text-[9px] text-gray-400 uppercase">{item.unit}</span>
                                </td>
                                <td className="p-5">
                                    <span className={`text-[9px] font-black uppercase ${item.is_active ? 'text-green-500' : 'text-gray-300'}`}>
                                        ● {item.is_active ? 'Đang hiện' : 'Đang ẩn'}
                                    </span>
                                </td>
                                <td className="p-5">
                                    <div className="flex justify-center gap-2">
                                        <button onClick={() => openEditModal(item)} className="p-2 hover:bg-blue-900 hover:text-white rounded-lg transition-all text-gray-300">📝</button>
                                        <button onClick={() => handleDelete(item.id)} className="p-2 hover:bg-red-600 hover:text-white rounded-lg transition-all text-gray-300">🗑️</button>
                                    </div>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </div>

            {showModal && (
                <div className="fixed inset-0 bg-blue-900/40 backdrop-blur-md flex items-center justify-center z-[100] p-4">
                    <div className="bg-white w-full max-w-3xl rounded-[2.5rem] shadow-2xl overflow-hidden animate-in zoom-in duration-200">
                        <div className="p-6 bg-blue-900 text-white flex justify-between items-center">
                            <h3 className="font-black uppercase italic tracking-widest">
                                {isEditing ? '🚀 Cập nhật' : '🌊 Thêm mới'}
                            </h3>
                            <button onClick={() => setShowModal(false)} className="text-2xl hover:text-yellow-400 transition-colors">&times;</button>
                        </div>
                        
                        <form onSubmit={handleSubmit} className="p-8">
                            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div className="space-y-4">
                                    <div>
                                        <label className="text-[10px] font-black text-gray-400 uppercase ml-2 mb-1 block">Tên sản phẩm *</label>
                                        <input name="name" value={formData.name} onChange={handleChange} required className="w-full px-5 py-3 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-900 outline-none font-bold" />
                                    </div>
                                    <div className="grid grid-cols-2 gap-4">
                                        <div>
                                            <label className="text-[10px] font-black text-gray-400 uppercase ml-2 mb-1 block">Giá bán *</label>
                                            <input type="number" name="price" value={formData.price} onChange={handleChange} required className="w-full px-5 py-3 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-900 outline-none font-bold text-red-600" />
                                        </div>
                                        <div>
                                            <label className="text-[10px] font-black text-gray-400 uppercase ml-2 mb-1 block">Đơn vị</label>
                                            <input name="unit" value={formData.unit} onChange={handleChange} className="w-full px-5 py-3 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-900 outline-none font-bold" />
                                        </div>
                                    </div>
                                    <div>
                                        <label className="text-[10px] font-black text-gray-400 uppercase ml-2 mb-1 block">Danh mục</label>
                                        <select name="category_id" value={formData.category_id} onChange={handleChange} className="w-full px-5 py-3 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-900 outline-none font-bold">
                                            {categories.map(c => <option key={c.id} value={c.id}>{c.name}</option>)}
                                        </select>
                                    </div>
                                </div>

                                <div className="space-y-4">
                                    <div className="grid grid-cols-2 gap-4">
                                        <div>
                                            <label className="text-[10px] font-black text-gray-400 uppercase ml-2 mb-1 block">Số tồn kho</label>
                                            <input type="number" name="stock" value={formData.stock} onChange={handleChange} className="w-full px-5 py-3 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-900 outline-none font-bold" />
                                        </div>
                                        <div>
                                            <label className="text-[10px] font-black text-gray-400 uppercase ml-2 mb-1 block">Kích cỡ</label>
                                            <input name="size" value={formData.size} onChange={handleChange} placeholder="VD: Lớn, Nhỏ, 30cm..." className="w-full px-5 py-3 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-900 outline-none font-bold" />
                                        </div>
                                    </div>
                                    <div>
                                        <label className="text-[10px] font-black text-gray-400 uppercase ml-2 mb-1 block">Loại hàng</label>
                                        <select name="type" value={formData.type} onChange={handleChange} className="w-full px-5 py-3 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-900 outline-none font-bold">
                                            <option value="fresh">Tươi sống</option>
                                            <option value="frozen">Đông lạnh</option>
                                            <option value="dried">Khô / Chế biến</option>
                                            <option value="fermentation">Lên men</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label className="text-[10px] font-black text-gray-400 uppercase ml-2 mb-1 block">Ảnh đại diện</label>
                                        <input type="file" name="image" onChange={handleChange} className="w-full text-xs text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-blue-50 file:text-blue-700 cursor-pointer" />
                                    </div>
                                </div>
                            </div>

                            <div className="mt-4">
                                <label className="text-[10px] font-black text-gray-400 uppercase ml-2 mb-1 block">Mô tả sản phẩm</label>
                                <textarea name="description" value={formData.description} onChange={handleChange} rows="2" className="w-full px-5 py-3 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-900 outline-none font-bold" />
                            </div>

                            <div className="mt-6 flex items-center justify-between p-4 bg-blue-50/50 rounded-2xl border border-blue-100">
                                <span className="text-[10px] font-black text-blue-900 uppercase">Trạng thái (Bật để khách xem được trên web)</span>
                                <label className="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="is_active" checked={formData.is_active === 1} onChange={handleChange} className="sr-only peer" />
                                    <div className="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-900"></div>
                                </label>
                            </div>

                            <button type="submit" className="w-full mt-8 bg-blue-900 text-white py-4 rounded-2xl font-black uppercase tracking-widest hover:bg-yellow-400 hover:text-blue-900 transition-all shadow-xl active:scale-95">
                                {isEditing ? 'LƯU THAY ĐỔI' : 'TẠO MỚI SẢN PHẨM'}
                            </button>
                        </form>
                    </div>
                </div>
            )}
        </div>
    );
}

export default AdminProduct;