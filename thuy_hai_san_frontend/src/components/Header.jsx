import React, { useState } from 'react';
import { Link, useNavigate, useLocation } from 'react-router-dom';
import { getAdminToken, isAuthenticated } from '../utils/auth';

function Header({ user, setUser, cartCount, searchTerm, setSearchTerm }) {
    const navigate = useNavigate();
    const location = useLocation();
    const [showAdminMenu, setShowAdminMenu] = useState(false);

    const getPlaceholder = () => {
        const path = location.pathname;
        if (path.includes('/admin/orders')) return "Tìm mã đơn, trạng thái...";
        if (path.includes('/admin/categories')) return "Tìm tên danh mục...";
        if (path.includes('/admin/users')) return "Tìm tên, số điện thoại...";
        if (path.includes('/admin/products')) return "Tìm tên sản phẩm, giá...";
        return "Tìm kiếm thủy hải sản...";
    };

    const handleLogout = () => {
        if (window.confirm("Bạn có chắc muốn đăng xuất không?")) {
            localStorage.removeItem('admin_token');
            localStorage.removeItem('user_info');
            setUser(null);
            navigate('/');
        }
    };

    const handleInputChange = (e) => {
        setSearchTerm(e.target.value);
    };

    const handleSearchSubmit = (e) => {
        if (e.key === 'Enter') {
            const path = location.pathname;
            const query = encodeURIComponent(searchTerm);

            if (user?.role === 'admin') {
                if (path.includes('/admin/orders')) navigate(`/admin/orders?search=${query}`);
                else if (path.includes('/admin/categories')) navigate(`/admin/categories?search=${query}`);
                else if (path.includes('/admin/users')) navigate(`/admin/users?search=${query}`);
                else if (path.includes('/admin/products')) navigate(`/admin/products?search=${query}`);
                else navigate(`/admin/products?search=${query}`);
            } else {
                navigate(`/?search=${query}`);
            }
        }
    };

    return (
        <nav className="bg-blue-900 p-4 text-white shadow-lg sticky top-0 z-50 font-sans">
            <div className="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
                <Link to="/" className="flex items-center space-x-2 shrink-0">
                    <span className="text-2xl">🦞</span>
                    <span className="text-xl font-black italic tracking-tighter uppercase">
                        Thủy hải sản <span className="text-yellow-400">Việt Nam</span>
                    </span>
                </Link>

                <div className="relative w-full md:w-96">
                    <input
                        type="text"
                        className="w-full py-2.5 pl-10 pr-4 bg-white/10 text-white placeholder-blue-100 border border-blue-400/30 rounded-2xl focus:outline-none focus:bg-white focus:text-blue-900 focus:placeholder-gray-400 transition-all duration-300 font-medium"
                        placeholder={getPlaceholder()}
                        value={searchTerm}
                        onChange={handleInputChange} 
                        onKeyDown={handleSearchSubmit} 
                    />
                    <div className="absolute left-3 top-1/2 -translate-y-1/2 text-blue-200">
                        <svg xmlns="http://www.w3.org/2000/svg" className="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                <div className="flex items-center space-x-6">
                    {user && user.role === 'admin' ? (
                        <div className="relative" onMouseEnter={() => setShowAdminMenu(true)} onMouseLeave={() => setShowAdminMenu(false)}>
                            <button className="text-xl hover:scale-110 transition-transform flex items-center gap-1 pb-2 outline-none">
                                🏠 <span className="text-[10px] bg-yellow-400 text-blue-900 px-1 rounded font-black">ADM</span>
                            </button>
                            {showAdminMenu && (
                                <div className="absolute top-full left-0 w-56 pt-2 z-[60]">
                                    <div className="bg-white shadow-2xl rounded-2xl py-3 border border-gray-100 overflow-hidden">
                                        <Link to="/" className="block px-4 py-2 text-xs font-bold text-gray-400 hover:bg-gray-50">Xem trang chủ</Link>
                                        <div className="h-[1px] bg-gray-100 my-1 mx-3"></div>
                                        {/* MỤC MỚI THÊM VÀO: Báo cáo chung */}
                                        <Link 
                                            to="/admin/dashboard" 
                                            onClick={() => setShowAdminMenu(false)} // Bấm xong thì đóng menu lại
                                            className="flex items-center gap-2.5 px-4 py-2.5 text-slate-700 hover:bg-blue-50 hover:text-blue-900 text-xs font-black uppercase tracking-tight transition-colors"
                                        >
                                            <span>📊</span>
                                            <span>Báo cáo chung (Dashboard)</span>
                                        </Link>
                                        <Link to="/admin/products" className="block px-4 py-2.5 text-blue-900 font-bold text-sm hover:bg-blue-50 transition-colors">📦 Cập nhật Sản phẩm</Link>
                                        <Link to="/admin/categories" className="block px-4 py-2.5 text-blue-900 font-bold text-sm hover:bg-blue-50 transition-colors">📂 Cập nhật Phân loại</Link>
                                        <Link to="/admin/users" className="block px-4 py-2.5 text-blue-900 font-bold text-sm hover:bg-blue-50 transition-colors">👥 Quản lý Người dùng</Link>
                                        <Link to="/admin/orders" className="block px-4 py-2.5 text-blue-900 font-bold text-sm hover:bg-blue-50 transition-colors">🧾 Quản lý Đơn hàng</Link>
                                    </div>
                                </div>
                            )}
                        </div>
                    ) : (
                        <Link to="/" title="Trang chủ" className="text-xl hover:scale-110 transition-transform">🏠</Link>
                    )}
                    
                    {user && <Link to="/order-history" title="Lịch sử mua hàng" className="text-xl hover:scale-110 transition-transform">📋</Link>}
                    
                    <Link to="/cart" title="Giỏ hàng" className="relative text-xl hover:scale-110 transition-transform">
                        🛒
                        {cartCount > 0 && (
                            <span className="absolute -top-2 -right-2 bg-red-600 text-white text-[10px] font-black px-1.5 py-0.5 rounded-full border-2 border-blue-900">
                                {cartCount}
                            </span>
                        )}
                    </Link>

                    <div className="h-6 w-[1px] bg-blue-700 hidden md:block"></div>

                    {!user ? (
                        <Link to="/login" className="bg-yellow-400 text-blue-900 px-4 py-1.5 rounded-full font-black text-xs uppercase hover:bg-white transition-all shadow-md">Login</Link>
                    ) : (
                        <div className="flex items-center space-x-4">
                            <div className="flex flex-col items-end">
                                <span className="text-[10px] text-blue-300 uppercase font-bold">Thành viên</span>
                                <span className="text-sm font-black text-yellow-400 italic">{user.name ? user.name.split(' ').pop() : 'User'}</span>
                            </div>
                            <button onClick={handleLogout} className="p-2 hover:bg-red-500/20 rounded-lg transition-colors text-red-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={2} stroke="currentColor" className="w-5 h-5">
                                    <path strokeLinecap="round" strokeLinejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                                </svg>
                            </button>
                        </div>
                    )}
                </div>
            </div>
        </nav>
    );
}

export default Header;