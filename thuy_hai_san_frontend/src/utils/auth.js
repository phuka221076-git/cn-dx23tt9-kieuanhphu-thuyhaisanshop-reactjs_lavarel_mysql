// src/utils/auth.js

/**
 * QUẢN LÝ TOKEN CHO KHÁCH HÀNG (USER)
 */
export const setUserToken = (token) => {
    localStorage.setItem('user_token', token);
};

export const getUserToken = () => {
    return localStorage.getItem('user_token');
};

export const removeUserToken = () => {
    localStorage.removeItem('user_token');
    localStorage.removeItem('user_info'); // Xóa luôn info nếu có
};

/**
 * QUẢN LÝ TOKEN CHO QUẢN TRỊ VIÊN (ADMIN)
 */
export const setAdminToken = (token) => {
    localStorage.setItem('admin_token', token);
};

export const getAdminToken = () => {
    return localStorage.getItem('admin_token');
};

export const removeAdminToken = () => {
    localStorage.removeItem('admin_token');
    localStorage.removeItem('admin_info');
};

/**
 * KIỂM TRA TRẠNG THÁI ĐĂNG NHẬP
 */
export const isAuthenticated = (role = null) => {
    const token = localStorage.getItem('token');
    const user = JSON.parse(localStorage.getItem('user'));
    if (!token || !user) return false;
    if (role) return user.role === role; // Chỉ check role nếu có truyền vào
    return true; // Nếu không truyền role, chỉ cần có token + user là OK
};

export const logout = () => {
    // 1. Xóa thông tin cá nhân
    localStorage.removeItem('user_info');
    localStorage.removeItem('admin_info');

    // 2. Xóa các Token xác thực
    localStorage.removeItem('user_token');
    localStorage.removeItem('admin_token');

    // 3. Xóa giỏ hàng (nếu muốn khách mới có giỏ hàng trống)
    localStorage.removeItem('cart');

    // 4. (Tùy chọn) Xóa sạch toàn bộ LocalStorage cho an toàn tuyệt đối
    localStorage.clear(); 

    // 5. Điều hướng người dùng về trang chủ hoặc trang đăng nhập
    window.location.href = '/login'; 
};

