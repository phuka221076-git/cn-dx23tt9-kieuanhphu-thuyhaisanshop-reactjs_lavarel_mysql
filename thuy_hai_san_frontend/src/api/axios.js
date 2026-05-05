import axios from 'axios';

const instance = axios.create({
    baseURL: 'http://127.0.0.1:8000/api',
});

/* instance.interceptors.request.use((config) => {
    const token = localStorage.getItem('admin_token') || localStorage.getItem('user_token');
    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
}); */

instance.interceptors.response.use(
    (response) => response,
    (error) => {
        const token = localStorage.getItem('admin_token') || localStorage.getItem('user_token');

        // Chỉ hiện thông báo và đá về login nếu trước đó có token (đang login mà hết hạn)
        if (error.response && error.response.status === 401 && token) {
            alert("Phiên đăng nhập đã hết hạn, vui lòng đăng nhập lại nhe Bạn!");
            localStorage.removeItem('admin_token');
            localStorage.removeItem('user_token');
            window.location.href = '/login';
        }
        
        // Nếu là khách (không token) mà vẫn bị 401, ta trả về error để Checkout.jsx xử lý
        return Promise.reject(error);
    }
);

// src/api/axios.js
// Tự động đính kèm Token vào Header trước khi gửi request
instance.interceptors.request.use((config) => {
    const token = localStorage.getItem('token');
    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
});
export default instance;