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
export const isAuthenticated = (type = 'user') => {
    return type === 'admin' ? !!getAdminToken() : !!getUserToken();
};