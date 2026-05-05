function Footer() {
  const currentYear = new Date().getFullYear();

  return (
    <footer className="bg-gray-900 text-gray-300 pt-12 pb-6 mt-auto">
      <div className="container mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-12 mb-8">
        
        {/* Column 1: Info */}
        <div>
          <h3 className="text-white font-bold text-lg mb-4 uppercase tracking-widest text-blue-400">
            Hệ thống kinh doanh thủy hải sản
          </h3>
          <p className="text-sm leading-relaxed text-gray-400">
            Chuyên cung cấp các loại thủy hải sản tươi sống đánh bắt trực tiếp từ vùng biển Trà Vinh. 
            Đảm bảo tiêu chuẩn vệ sinh an toàn thực phẩm và chất lượng tươi ngon nhất.
          </p>
        </div>

        {/* Column 2: TVU Info */}
        <div>
          <h3 className="text-white font-bold text-lg mb-4 uppercase tracking-widest text-blue-400">
            Đồ án tốt nghiệp
          </h3>
          <ul className="text-sm space-y-2">
            <li>Trường Đại học Trà Vinh (TVU)</li>
            <li>Khoa Kỹ thuật và Công nghệ</li>
            <li>Ngành: Công nghệ thông tin</li>
          </ul>
        </div>

        {/* Column 3: Contact */}
        <div>
          <h3 className="text-white font-bold text-lg mb-4 uppercase tracking-widest text-blue-400">
            Liên hệ hỗ trợ
          </h3>
          <p className="text-sm">📍 Ba Động, Duyên Hải, Trà Vinh</p>
          <p className="text-sm mt-2 font-mono text-blue-300">📧 lienxokieu@gmail.com</p>
        </div>
      </div>

      <div className="border-t border-gray-800 pt-6 text-center text-xs">
        <p>© {currentYear} Website Bán Thủy Hải Sản. All Rights Reserved.</p>
        <p className="mt-1 text-gray-600 italic">Thiết kế bởi Sinh viên Khoa KT&CN - TVU</p>
      </div>
    </footer>
  );
}

export default Footer;