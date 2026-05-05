import { useEffect, useState } from 'react';
import axios from 'axios';

function Admin() {
  const [products, setProducts] = useState([]);

  useEffect(() => {
    axios.get('http://127.0.0.1:8000/api/products').then(res => setProducts(res.data));
  }, []);

  return (
    <div className="container mx-auto p-6">
      <h2 className="text-2xl font-bold mb-6">Bảng điều khiển Quản trị viên</h2>
      <table className="w-full bg-white shadow-md rounded-lg overflow-hidden">
        <thead className="bg-gray-100">
          <tr>
            <th className="p-3 text-left">Tên sản phẩm</th>
            <th className="p-3 text-left">Giá</th>
            <th className="p-3 text-center">Hành động</th>
          </tr>
        </thead>
        <tbody>
          {products.map(p => (
            <tr key={p.id} className="border-t">
              <td className="p-3">{p.name}</td>
              <td className="p-3">{p.price}đ</td>
              <td className="p-3 text-center">
                <button className="text-blue-500 mr-2">Sửa</button>
                <button className="text-red-500">Xóa</button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
}
export default Admin;