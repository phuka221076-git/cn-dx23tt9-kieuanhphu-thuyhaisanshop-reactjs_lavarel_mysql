import React, { useState } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';

function Register() {
    const [formData, setFormData] = useState({
        name: '', email: '', password: '', phone: '', address: ''
    });
    const navigate = useNavigate();

    const handleRegister = async (e) => {
        e.preventDefault();
        try {
            const res = await axios.post('http://127.0.0.1:8000/api/register', formData);
            alert(res.data.message);
            navigate('/login');
        } catch (err) {
            const errors = err.response?.data?.errors;
            alert("Lỗi: " + (errors ? Object.values(errors).flat().join(', ') : "Không thể đăng ký"));
        }
    };

    return (
        <div className="max-w-md mx-auto mt-10 p-8 bg-white rounded-[40px] shadow-2xl border-t-8 border-blue-900 font-sans">
            <h2 className="text-2xl font-black text-center text-blue-900 mb-6 uppercase italic">Đăng ký thành viên</h2>
            <form onSubmit={handleRegister} className="space-y-4">
                <input type="text" placeholder="Họ và tên" className="w-full p-4 bg-gray-50 border rounded-2xl outline-none focus:border-blue-900" 
                    onChange={(e) => setFormData({...formData, name: e.target.value})} required />
                
                <input type="email" placeholder="Email" className="w-full p-4 bg-gray-50 border rounded-2xl outline-none focus:border-blue-900" 
                    onChange={(e) => setFormData({...formData, email: e.target.value})} required />
                
                <input type="password" placeholder="Mật khẩu" className="w-full p-4 bg-gray-50 border rounded-2xl outline-none focus:border-blue-900" 
                    onChange={(e) => setFormData({...formData, password: e.target.value})} required />
                
                <input type="text" placeholder="Số điện thoại" className="w-full p-4 bg-gray-50 border rounded-2xl outline-none focus:border-blue-900" 
                    onChange={(e) => setFormData({...formData, phone: e.target.value})} required />
                
                <textarea placeholder="Địa chỉ giao hàng" className="w-full p-4 bg-gray-50 border rounded-2xl outline-none focus:border-blue-900" 
                    onChange={(e) => setFormData({...formData, address: e.target.value})} required />

                <button type="submit" className="w-full bg-blue-900 text-white py-4 rounded-2xl font-black uppercase hover:bg-black transition-all">
                    Tạo tài khoản ngay
                </button>
            </form>
        </div>
    );
}

export default Register;