import React from 'react';
import { useNavigate } from 'react-router-dom';

function Cart({ cart, updateQty, removeFromCart }) {
  const navigate = useNavigate();
  const total = cart.reduce((sum, item) => sum + (item.price * (item.qty || 1)), 0);

  return (
    <div className="container mx-auto p-6">
      <h1 className="text-2xl font-black mb-6 uppercase italic text-blue-900 border-b-4 border-blue-900 w-fit">Giỏ hàng</h1>
      
      {cart.length === 0 ? (
        <div className="text-center py-20 bg-white rounded-3xl shadow-inner">
          <p className="text-gray-400 italic font-bold">Giỏ hàng đang trống!</p>
        </div>
      ) : (
        <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
          <div className="lg:col-span-2 space-y-4">
            {cart.map((item) => (
              <div key={item.id} className="bg-white p-4 rounded-2xl shadow-sm border flex items-center gap-4 transition-all hover:shadow-md">
                <img src={`http://127.0.0.1:8000/storage/${item.image}`} className="w-20 h-20 object-cover rounded-xl" alt={item.name} />
                <div className="flex-grow">
                  <h3 className="font-bold uppercase text-sm text-gray-700">{item.name}</h3>
                  <p className="text-red-600 font-black">{Number(item.price).toLocaleString()}đ</p>
                </div>
                
                <div className="flex items-center gap-3 bg-gray-100 rounded-xl p-1">
                  <button onClick={() => updateQty(item.id, -1)} className="w-8 h-8 flex items-center justify-center font-bold bg-white rounded-lg shadow-sm">-</button>
                  <span className="font-black text-blue-600 w-4 text-center">{item.qty}</span>
                  <button onClick={() => updateQty(item.id, 1)} className="w-8 h-8 flex items-center justify-center font-bold bg-white rounded-lg shadow-sm">+</button>
                </div>

                <button onClick={() => removeFromCart(item.id)} className="text-gray-300 hover:text-red-500 p-2 transition-colors">
                   Xóa
                </button>
              </div>
            ))}
          </div>

          <div className="bg-white p-8 rounded-3xl shadow-2xl border-t-8 border-blue-900 h-fit sticky top-4">
            <h2 className="font-black text-xl mb-4 text-gray-800 uppercase tracking-tighter">Tổng thanh toán</h2>
            <div className="text-4xl font-black text-red-600 mb-8 italic">
              {total.toLocaleString()} <span className="text-sm underline italic">đ</span>
            </div>
            
            {/* NÚT BẤM DUY NHẤT: KHÔNG THÊM LOGIC GÌ Ở ĐÂY */}
            <button 
              onClick={() => navigate('/checkout')}
              className="w-full bg-blue-900 text-white py-5 rounded-2xl font-black uppercase tracking-widest hover:bg-blue-800 shadow-lg active:scale-95 transition-all"
            >
              Thanh toán ngay
            </button>
          </div>
        </div>
      )}
    </div>
  );
}

export default Cart;