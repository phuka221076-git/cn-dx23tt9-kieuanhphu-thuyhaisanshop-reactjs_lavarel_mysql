import React, { useState } from 'react';
import axios from 'axios';
import { useNavigate, Link } from 'react-router-dom';
import { setUserToken, setAdminToken } from '../utils/auth'; // Đảm bảo import đúng

function Login({ setUser }) {
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const navigate = useNavigate();

    const handleLogin = async (e) => {
        e.preventDefault();
        try {
            // 1. Gọi API login
            const response = await axios.post('http://127.0.0.1:8000/api/login', { email, password });
            
            const userData = response.data.user; 
            const token = response.data.access_token; // Hoặc response.data.token tùy Backend của bạn

            // 2. Sử dụng helper từ auth.js để lưu token dựa trên Role
            if (userData.role === 'admin') {
                setAdminToken(token);
                localStorage.setItem('admin_info', JSON.stringify(userData));
                setUser(userData);
                navigate('/admin/orders'); 
            } else {
                setUserToken(token);
                localStorage.setItem('user_info', JSON.stringify(userData));
                setUser(userData);
                navigate('/'); 
            }

        } catch (error) {
            if (error.response) {
                if (error.response.status === 403) {
                    alert(error.response.data.message || "Tài khoản của bạn đã bị khóa!");
                } else if (error.response.status === 401) {
                    alert("Email hoặc mật khẩu không chính xác!");
                } else {
                    alert("Lỗi hệ thống, vui lòng thử lại sau.");
                }
            } else {
                alert("Không thể kết nối đến máy chủ!");
            }
        }
    };

    return (
        <div className="max-w-md mx-auto mt-20 p-10 bg-white rounded-[40px] shadow-2xl border-4 border-blue-50 font-sans">
            <h2 className="text-3xl font-black text-center text-blue-900 mb-8 uppercase italic">Đăng Nhập</h2>
            
            <form onSubmit={handleLogin} className="space-y-6">
                <input 
                    type="email" 
                    placeholder="Email" 
                    className="w-full p-5 bg-gray-50 border-0 rounded-3xl outline-none focus:ring-2 focus:ring-blue-900 text-gray-700" 
                    value={email} 
                    onChange={(e) => setEmail(e.target.value)} 
                    required 
                />
                <input 
                    type="password" 
                    placeholder="Mật khẩu" 
                    className="w-full p-5 bg-gray-50 border-0 rounded-3xl outline-none focus:ring-2 focus:ring-blue-900 text-gray-700" 
                    value={password} 
                    onChange={(e) => setPassword(e.target.value)} 
                    required 
                />
                <button 
                    type="submit" 
                    className="w-full bg-blue-900 text-white py-5 rounded-3xl font-black uppercase shadow-lg hover:bg-yellow-400 hover:text-blue-900 transition-all active:scale-95"
                >
                    Vào hệ thống
                </button>
            </form>

            <div className="mt-8 pt-6 border-t border-gray-100 text-center">
                <p className="text-gray-500 text-sm">Bạn chưa có tài khoản?</p>
                <Link 
                    to="/register" 
                    className="mt-2 inline-block text-blue-900 font-black hover:text-yellow-500 transition-colors uppercase text-sm tracking-widest border-b-2 border-blue-900 hover:border-yellow-500"
                >
                    Tạo tài khoản mới ngay ➔
                </Link>
            </div>
        </div>
    );
}

export default Login;