import { BrowserRouter as Router, Routes, Route, Navigate } from 'react-router-dom';
import { useState, useEffect } from 'react';
import './index.css';

// Components
import Header from './components/Header';
import Footer from './components/Footer';
import Checkout from './Checkout';

// Pages
import ProductList from './pages/ProductList';
import Login from './pages/Login';
import Register from './pages/Register';
import Admin from './pages/Admin';
import Cart from './pages/Cart';
import OrderHistory from './pages/OrderHistory';
import ProductDetail from './pages/ProductDetail';

// Admin Pages
import AdminProduct from './pages/admin/AdminProduct';
import AdminCategory from './pages/admin/AdminCategory';
import AdminUser from './pages/admin/AdminUser'; 
import AdminOrder from './pages/admin/AdminOrder';
import AdminDashboard from './pages/admin/AdminDashboard'; // Import trang vừa tạo

function App() {
  // 1. Quản lý Giỏ hàng
  const [cart, setCart] = useState(() => {
    const saved = localStorage.getItem('cart');
    return saved ? JSON.parse(saved) : [];
  });
  
  // 2. Quản lý Tìm kiếm & Người dùng
  const [searchTerm, setSearchTerm] = useState('');
  // Đã gộp 2 dòng khai báo user thành 1 dòng duy nhất
  const [user, setUser] = useState(JSON.parse(localStorage.getItem('user_info')) || null);
  const [cartCount, setCartCount] = useState(0);

  // Cập nhật số lượng hiển thị trên icon giỏ hàng
  useEffect(() => {
    const total = cart.reduce((sum, item) => sum + (item.qty || 1), 0);
    setCartCount(total);
    localStorage.setItem('cart', JSON.stringify(cart));
  }, [cart]);

  // Logic giỏ hàng
  const addToCart = (product) => {
    const exist = cart.find((x) => x.id === product.id);
    if (exist) {
      setCart(cart.map((x) => x.id === product.id ? { ...exist, qty: exist.qty + 1 } : x));
    } else {
      setCart([...cart, { ...product, qty: 1 }]);
    }
  };

  const updateQty = (id, delta) => {
    setCart(prev => prev.map(item => 
      item.id === id ? { ...item, qty: Math.max(1, (item.qty || 1) + delta) } : item
    ));
  };

  const removeFromCart = (id) => {
    setCart(prev => prev.filter(item => item.id !== id));
  };

  return (
    <Router>
      <div className="flex flex-col min-h-screen bg-gray-50 font-sans text-gray-900">
        <Header 
            user={user} 
            setUser={setUser} 
            cartCount={cartCount} 
            searchTerm={searchTerm} 
            setSearchTerm={setSearchTerm} 
        />
        
        <main className="flex-grow">
          <Routes>
            {/* Trang chủ */}
            <Route path="/" element={<ProductList searchTerm={searchTerm} addToCart={addToCart} />} />
            <Route path="/product/:id" element={<ProductDetail addToCart={addToCart} />} />
            
            {/* Giỏ hàng & Thanh toán */}
            <Route path="/cart" element={<Cart cart={cart} updateQty={updateQty} removeFromCart={removeFromCart} />} />
            <Route path="/checkout" element={<Checkout user={user} cartItems={cart} setCartItems={setCart} />} />
            
            {/* Tài khoản */}
            <Route path="/login" element={<Login setUser={setUser} />} />
            <Route path="/register" element={<Register />} />
            <Route path="/order-history" element={<OrderHistory />} />
            
            {/* Quản trị Admin */}
            <Route 
              path="/admin" 
              element={user?.role === 'admin' ? <Admin /> : <Navigate to="/login" />} 
            />
            
            {/* Đã xóa dòng Route thừa ở ngoài và gộp tại đây */}
            <Route 
              path="/admin/products" 
              element={user?.role === 'admin' ? <AdminProduct user={user} searchTerm={searchTerm} /> : <Navigate to="/login" />} 
            />
            {/* Route cho Admin quản trị */}
            <Route path="/admin/dashboard" element={<AdminDashboard />} />
            <Route 
              path="/admin/categories" 
              element={user?.role === 'admin' ? <AdminCategory /> : <Navigate to="/login" />} 
            />
            
            <Route 
              path="/admin/orders" 
              element={user?.role === 'admin' ? <AdminOrder /> : <Navigate to="/login" />} 
            />
            
            <Route 
              path="/admin/users" 
              element={user?.role === 'admin' ? <AdminUser /> : <Navigate to="/login" />} 
            />
          </Routes>
        </main>
        
        <Footer />
      </div>
    </Router>
  );
}

export default App;