<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('products')->delete();
        
        \DB::table('products')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Tôm Càng Xanh Trà Vinh',
                'size' => 'size 5-7 con',
                'slug' => 'tom-cang-xanh-tra-vinh-1778601824',
                'description' => 'Tôm càng xanh tự nhiên, thịt chắc ngọt, size 5-7 con/kg.

1. Đặc điểm nổi bật của Tôm Càng Xanh Trà Vinh
Hình thái: Tôm có màu xanh lam xen lẫn xám đặc trưng. Điểm nhận diện rõ nhất là đôi càng dài, màu xanh đậm, thịt trong càng cũng rất ngọt và chắc.

Chất lượng thịt: Thịt tôm càng xanh rất dẻo và ngọt. Đặc biệt, "vũ khí" bí mật của loại tôm này chính là phần gạch béo ngậy đóng đầy ở đầu tôm, vàng óng và thơm lừng khi chế biến.

Môi trường sống: Tại Trà Vinh, tôm thường được nuôi xen canh trong ruộng lúa hoặc các mương vườn tự nhiên, giúp tôm có thịt săn chắc và sạch, không bị hôi cỏ.

2. Giá trị dinh dưỡng dồi dào
Tôm càng xanh là nguồn thực phẩm cao cấp rất tốt cho sức khỏe:

Hàm lượng Canxi vượt trội: Hỗ trợ xương khớp chắc khỏe cho cả người già và trẻ nhỏ.

Protein tinh khiết: Cung cấp năng lượng nhưng ít chất béo xấu, phù hợp cho chế độ ăn lành mạnh.

Giàu Vitamin: Đặc biệt là vitamin B12 và sắt, hỗ trợ quá trình tái tạo máu và tăng cường sức đề kháng.

3. Gợi ý chế biến "Đậm chất miền Tây"
Tôm càng xanh Trà Vinh là nguyên liệu "vàng" cho các bữa tiệc gia đình:

Tôm càng xanh nướng mọi/nướng muối ớt: Khi nướng, mùi thơm từ vỏ tôm cháy sém hòa quyện với vị béo của gạch đầu tôm sẽ khiến bất kỳ ai cũng phải xiêu lòng.

Tôm càng xanh kho tàu: Đây là món ăn đẳng cấp trong mâm cơm miền Tây. Gạch tôm được tách ra, chưng lên tạo thành màu vàng cam tự nhiên bao phủ lấy thân tôm đậm đà.

Lẩu tôm càng xanh: Nước lẩu chua thanh, nhúng những con tôm càng tươi rói, thịt tôm dai ngọt ăn kèm bún tươi và rau nhút.

Tôm hấp nước dừa: Vị ngọt của tôm hòa cùng vị béo thanh của nước dừa Trà Vinh tạo nên một tổ hợp hương vị khó quên.

4. Cam kết chất lượng từ cửa hàng
Tươi sống 100%: Tôm được đánh bắt và vận chuyển từ các hộ dân tại các huyện như Châu Thành, Cầu Ngang (Trà Vinh), đảm bảo độ tươi ngon nhất.

Tuyển chọn kỹ lưỡng: Mỗi con tôm đều được kiểm tra kỹ về độ chắc thịt và gạch trước khi giao.

Đóng gói chuyên nghiệp: Giao hàng nhanh với phương pháp đóng gói đảm bảo tôm giữ được chất lượng tốt nhất đến tay khách hàng.

Giá trị thương phẩm
Chất lượng thịt: Thịt tôm càng xanh rất săn chắc, ngọt và có mùi thơm đặc trưng. Đặc biệt, phần gạch ở đầu tôm được coi là phần giá trị và ngon nhất.

Kích thước thương phẩm: Tôm thường đạt trọng lượng tốt nhất để thu hoạch khi đạt khoảng 100g – 200g/con, thậm chí có những con đực lớn có thể nặng tới 400g - 500g.',
                'price' => '380000.00',
                'unit' => 'kg',
                'stock' => 11,
                'image' => 'tom-cang-xanh.jpg',
                'category_id' => 1,
                'is_active' => 1,
                'type' => 'fresh',
                'created_at' => '2026-04-25 03:29:41',
                'updated_at' => '2026-05-12 16:03:44',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Tôm Sú Cà Mau L1',
            'size' => 'Đại(10 – 15 con)',
                'slug' => 'tom-su-ca-mau-l1-1778601734',
                'description' => 'Tôm sú sinh thái, vỏ mỏng thịt dày, giàu dinh dưỡng.

1. Đặc điểm nổi bật của Tôm Sú Cà Mau
Ngoại hình: Tôm có thân hình dài, lớp vỏ cứng, dày với các sọc màu đen, vàng đặc trưng trải dài khắp cơ thể. Tôm sú tự nhiên thường có màu sắc đậm và tươi sáng hơn tôm nuôi.

Chất lượng thịt: Thịt tôm sú Cà Mau cực kỳ săn chắc, dai và có độ ngọt đậm đà. Khi chế biến xong, thịt tôm không bị bở, lớp vỏ đỏ rực rất bắt mắt. Đặc biệt, phần đầu tôm thường chứa nhiều gạch béo ngậy.

2. Giá trị dinh dưỡng dồi dào
Tôm sú là nguồn thực phẩm lý tưởng để bổ sung dưỡng chất cho cơ thể:

Hàm lượng Protein cao: Giúp cung cấp năng lượng và hỗ trợ cơ bắp.

Ít chất béo: Phù hợp cho những người đang trong chế độ ăn uống lành mạnh.

Khoáng chất thiết yếu: Chứa nhiều Canxi, Kali, Photpho và Vitamin B12 giúp xương chắc khỏe và hỗ trợ hệ thần kinh.

3. Gợi ý chế biến "Đánh thức vị giác"
Với tôm sú Cà Mau, càng chế biến đơn giản càng giữ được độ ngọt tự nhiên:

Tôm sú hấp nước dừa/hấp bia: Cách này giúp giữ trọn vẹn vị ngọt thanh của thịt tôm và mùi thơm của biển.

Tôm sú nướng muối ớt: Lớp vỏ ngoài giòn cay, bên trong thịt ngọt dẻo, là món ăn "khoái khẩu" trong các buổi tiệc.

Tôm sú rang muối/rang me: Vị đậm đà của gia vị hòa quyện với thịt tôm chắc ngọt tạo nên sức hút khó cưỡng.

Sashimi tôm sú: Với những con tôm đạt độ tươi chuẩn, khách có thể ăn sống kèm mù tạt để cảm nhận độ giòn và ngọt lịm của sớ thịt.

4. Cam kết từ cửa hàng
Tươi ngon mỗi ngày: Tôm được thu mua và vận chuyển ngay trong ngày từ các đầm tôm tại Cà Mau.

Size chuẩn: Cửa hàng cam kết giao đúng size, tôm đều con, không bị ốp.

Bảo quản: Đảm bảo điều kiện bảo quản lạnh tiêu chuẩn để giữ nguyên hàm lượng dinh dưỡng và vị ngọt của tôm.',
                'price' => '450000.00',
                'unit' => 'kg',
                'stock' => 90,
                'image' => 'tom-su-ca-mau.jpg',
                'category_id' => 1,
                'is_active' => 1,
                'type' => 'fresh',
                'created_at' => '2026-04-25 03:29:41',
                'updated_at' => '2026-05-12 16:02:14',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Cá Hồi Na Uy Phi Lê',
                'size' => NULL,
                'slug' => 'ca-hoi-na-uy-phi-le-1778601626',
                'description' => 'Cá hồi nhập khẩu trực tiếp, đạt chuẩn ăn sashimi.

1. Nguồn gốc từ vùng biển Bắc Âu
Xuất xứ: Cá được nuôi và đánh bắt tại vùng biển lạnh Na Uy – nơi có dòng nước sạch tinh khiết và quy trình kiểm soát chất lượng nghiêm ngặt nhất thế giới.

Quy cách phi lê: Cá sau khi đánh bắt được sơ chế, lọc bỏ xương và da (hoặc để da tùy yêu cầu) theo tiêu chuẩn quốc tế, đảm bảo miếng phi lê vuông vức, đẹp mắt và giữ trọn dưỡng chất.

2. Đặc điểm nổi bật về chất lượng
Màu sắc: Miếng cá có màu cam tươi rói xen kẽ với những vân mỡ trắng bạc đều đặn như vân cẩm thạch.

Hương vị: Thịt cá hồi Na Uy nổi tiếng với độ mềm tan trong miệng, vị béo ngậy tự nhiên và mùi thơm thanh nhẹ, không hề có mùi tanh nồng.

Độ tươi: Sản phẩm được vận chuyển bằng đường hàng không và bảo quản lạnh chuyên sâu, đảm bảo đạt chuẩn Sashimi Grade (ăn sống được ngay).

3. Giá trị dinh dưỡng "Vàng"
Cá hồi Na Uy là "siêu thực phẩm" cho mọi lứa tuổi:

Omega-3 (DHA/EPA): Cực kỳ dồi dào, giúp phát triển trí não ở trẻ nhỏ, tăng cường trí nhớ cho người già và bảo vệ sức khỏe tim mạch.

Vitamin & Khoáng chất: Giàu Vitamin A, D, B12 và các chất chống oxy hóa mạnh mẽ như Selen, giúp làm đẹp da và tăng cường thị lực.

4. Gợi ý chế biến chuẩn nhà hàng 5 sao
Với cá hồi phi lê, Phú có thể tư vấn khách hàng thực hiện các món:

Sashimi/Sushi: Thái lát mỏng, ăn kèm mù tạt, nước tương Nhật và gừng hồng để cảm nhận độ tươi béo nguyên bản.

Cá hồi áp chảo sốt chanh dây/sốt cam: Lớp da giòn rụm (nếu còn da), thịt bên trong vừa chín tới, mềm ngọt hòa quyện cùng vị chua thanh của sốt.

Salad cá hồi: Trộn cùng rau mầm và sốt mè rang cho bữa tối lành mạnh, hỗ trợ giảm cân.

Ruốc (Chà bông) cá hồi: Rất tốt để làm món ăn dặm giàu dinh dưỡng cho các bé.',
                    'price' => '550000.00',
                    'unit' => 'kg',
                    'stock' => 0,
                    'image' => 'ca-hoi-nauy-file.jpg',
                    'category_id' => 2,
                    'is_active' => 1,
                    'type' => 'frozen',
                    'created_at' => '2026-04-25 03:29:41',
                    'updated_at' => '2026-05-12 16:00:26',
                ),
                3 => 
                array (
                    'id' => 4,
                    'name' => 'Cá Lóc Đồng Trà Vinh',
                    'size' => NULL,
                    'slug' => 'ca-loc-dong-tra-vinh-1778601556',
                    'description' => 'Cá lóc đồng làm sạch sẵn, phù hợp cho món canh chua.

Đã có hải sản biển thì không thể thiếu Cá Lóc Đồng Trà Vinh – một đặc sản dân dã nhưng cực kỳ giá trị của vùng đất chín rồng. Với hệ thống kênh rạch chằng chịt và các cánh đồng phù sa tại Trà Vinh, cá lóc đồng tại đây nổi tiếng với độ ngọt, thơm và chắc thịt hơn hẳn cá nuôi công nghiệp.

Dưới đây là nội dung chi tiết để Phú đưa vào website, làm nổi bật niềm tự hào quê hương nhé:

1. Đặc điểm nhận diện Cá Lóc Đồng Trà Vinh
Hình dáng: Cá lóc đồng có đầu thon nhọn, thân mình thuôn dài, da màu đen sẫm hoặc vàng nâu tùy vào môi trường sống (mương rạch hay ruộng lúa).

Chất lượng thịt: Vì sinh tồn trong môi trường tự nhiên, cá lóc đồng vận động nhiều nên thịt rất săn chắc, ít mỡ. Khi chế biến, thịt cá trắng ngần, có vị ngọt thanh đậm đà và mùi thơm đặc trưng của bùn đất phù sa, không bị bở hay có mùi cám như cá nuôi.

2. Giá trị dinh dưỡng và Công dụng
Cá lóc đồng không chỉ là món ăn ngon mà còn là một vị thuốc trong Đông y:

Bồi bổ sức khỏe: Thịt cá tính bình, giúp trừ phong, lợi tiểu, rất tốt cho người mới ốm dậy, phụ nữ sau sinh và trẻ em suy dinh dưỡng.

Giàu dưỡng chất: Cung cấp hàm lượng lớn protein, canxi và các khoáng chất thiết yếu cho cơ thể.

3. Những món ngon "Đậm chất miền Tây"
Từ con cá lóc đồng Trà Vinh, Phú có thể gợi ý cho khách hàng những món ăn bất hủ:

Cá lóc nướng trui: Món ăn linh hồn của miền Tây. Cá không cần đánh vảy, xiên qua que tre nướng bằng rơm rạ, chấm với nước mắm me cay nồng và ăn kèm rau sống vườn.

Canh chua cá lóc: Nấu cùng bông súng, điên điển hoặc trái bần đặc trưng của vùng Trà Vinh, tạo nên vị chua thanh mát lạnh.

Cá lóc kho tộ/kho tiêu: Miếng cá săn chắc, thấm đẫm nước mắm nhĩ và tiêu sọ, ăn cùng cơm cháy thì không gì bằng.

Mắm cá lóc/Khô cá lóc: Những con cá lóc đồng được tuyển chọn để làm mắm hoặc phơi khô, giúp lưu giữ hương vị quê hương đi xa.

4. Cam kết chất lượng
Nguồn gốc rõ ràng: Đảm bảo cá đánh bắt tự nhiên từ các vùng huyện như Châu Thành, Trà Cú, Cầu Ngang (Trà Vinh).

Độ tươi: Cá được nhập mới mỗi ngày, bảo quản trong môi trường nước sạch, đảm bảo còn sống khỏe khi giao đến tay khách hàng.',
                    'price' => '120000.00',
                    'unit' => 'kg',
                    'stock' => 101,
                    'image' => 'ca-loc-dong-tra-vinh.jpg',
                    'category_id' => 2,
                    'is_active' => 1,
                    'type' => 'fresh',
                    'created_at' => '2026-04-25 03:29:41',
                    'updated_at' => '2026-05-12 15:59:16',
                ),
                4 => 
                array (
                    'id' => 5,
                    'name' => 'Cá Bớp Nguyên Con',
                    'size' => NULL,
                    'slug' => 'ca-bop-nguyen-con-1778601480',
                    'description' => 'Cá bớp tươi sống chuyên dùng nấu lẩu, thịt béo và dai.

1. Đặc điểm nổi bật của Cá Bớp
Chất lượng thịt: Cá bớp có thịt trắng, sớ thịt dày, dai nhẹ và đặc biệt là không có xương dăm, rất an toàn cho người già và trẻ nhỏ.

Hương vị: Thịt cá bớp có vị ngọt thanh tự nhiên, lớp da dày màu xám đen chứa nhiều collagen nên khi ăn rất béo và giòn, không bị ngấy.

Độ tươi: Cá bớp tại cửa hàng được tuyển chọn từ những con cá khỏe mạnh, mắt trong, mang đỏ, thân cá cứng và độ đàn hồi tốt.

2. Giá trị dinh dưỡng tuyệt vời
Cá bớp nguyên con là nguồn thực phẩm "vàng" cho sức khỏe:

Omega-3 và Protein: Chứa hàm lượng lớn giúp hỗ trợ phát triển trí não, tốt cho tim mạch và tăng cường cơ bắp.

Vitamin & Khoáng chất: Giàu Vitamin D, Vitamin B6 và các khoáng chất như Selen, Magie giúp xương chắc khỏe và tăng cường hệ miễn dịch.

3. Gợi ý chế biến "Món gì cũng ngon"
Một con cá bớp nguyên con có thể chia ra chế biến thành nhiều món cho cả mâm cơm:

Đầu cá: Tuyệt vời nhất là nấu Lẩu cá bớp chua cay hoặc Canh chua cá bớp với măng chua, bông điên điển. Phần sụn ở đầu cá ăn rất giòn và béo.

Thân cá (Cắt khoanh): Phù hợp cho món Cá bớp kho tộ, Cá bớp chiên nước mắm hoặc Nướng muối ớt. Thịt cá khi kho sẽ thấm vị, săn chắc rất đưa cơm.

Đuôi cá: Có thể dùng để nấu cháo cho bé hoặc băm nhỏ làm chả cá rất ngọt.

4. Cam kết từ cửa hàng "Thủy Hải Sản Việt Nam"
Nguồn gốc: Cá được đánh bắt hoặc nuôi tại các bè cá lớn vùng biển miền Trung và miền Nam, vận chuyển nhanh trong ngày.

Làm sạch: Hỗ trợ làm sạch, đánh vảy, cắt khúc theo yêu cầu của khách hàng hoàn toàn miễn phí.

Đóng gói: Hút chân không và bảo quản lạnh tiêu chuẩn để giữ trọn vị ngọt tươi của cá khi đến tay khách hàng.',
                    'price' => '280000.00',
                    'unit' => 'kg',
                    'stock' => 219,
                    'image' => 'ca-bop-nguyen-con.jpg',
                    'category_id' => 2,
                    'is_active' => 1,
                    'type' => 'fresh',
                    'created_at' => '2026-04-25 03:29:41',
                    'updated_at' => '2026-05-12 15:58:00',
                ),
                5 => 
                array (
                    'id' => 6,
                    'name' => 'Cua Gạch Cà Mau',
                    'size' => NULL,
                    'slug' => 'cua-gach-ca-mau-1778601401',
                    'description' => 'Cua gạch loại 1, bao ăn từng con, gạch đầy và béo.

1. Nguồn gốc và Chất lượng đặc biệt
Vùng nuôi: Được đánh bắt tự nhiên hoặc nuôi trong môi trường sinh thái rừng ngập mặn tại Cà Mau (Năm Căn, Đầm Dơi...). Nhờ nguồn thức ăn dồi dào từ phù sa, cua Cà Mau có vỏ ngoài màu sẫm, cứng cáp và thịt cực kỳ săn chắc.

Đặc điểm "Gạch": Cua gạch là những con cua cái đã trưởng thành, phần yếm đầy ắp gạch đỏ rực, béo ngậy. Gạch cua Cà Mau không chỉ nhiều mà còn có độ bùi, thơm và tan ngay trong miệng, không bị khô hay tanh.

2. Hương vị đẳng cấp
Thịt cua: Có vị ngọt đậm, dai sớ và thơm mùi đặc trưng của biển và rừng ngập mặn. Thịt cua ở các càng rất đầy, không bị ốp (trống).

Gạch cua: Là "tinh hoa" của con cua. Gạch đỏ tươi tràn lan khắp thân cua khi tách mai ra, mang vị béo đậm đà, cực kỳ bổ dưỡng và giàu omega-3.

3. Gợi ý chế biến "Chuẩn bài"
Cua gạch Cà Mau ngon nhất khi được chế biến để làm nổi bật phần gạch:

Cua gạch hấp sả/hấp bia: Giữ nguyên vị ngọt thanh của thịt và độ béo nguyên bản của gạch.

Cua gạch rang me: Vị chua ngọt của me hòa quyện với vị béo của gạch tạo nên một tổ hợp hương vị bùng nổ.

Cua gạch nướng mọi: Cách ăn dân dã của người miền Tây, giúp gạch cua có mùi thơm cháy cạnh cực kỳ hấp dẫn.

Lẩu cua gạch: Nước lẩu sẽ trở nên vàng óng, béo ngậy nhờ gạch cua tan ra, ăn kèm với rau muống và bún tươi.

4. Cam kết chất lượng từ Cửa hàng
Tỷ lệ thịt: Cam kết thịt đầy trên 90%, yếm chắc, bao ăn.

Chất lượng gạch: Cua gạch được soi đèn kỹ lưỡng để đảm bảo con nào cũng đầy gạch đỏ trước khi giao đến tay khách hàng.

Dây buộc: Sử dụng dây buộc mỏng (dây không trọng lượng) để đảm bảo khách hàng nhận đúng khối lượng cua thực tế.',
                        'price' => '650000.00',
                        'unit' => 'kg',
                        'stock' => 43539,
                        'image' => 'cua-gach-ca-mau.jpg',
                        'category_id' => 3,
                        'is_active' => 1,
                        'type' => 'fresh',
                        'created_at' => '2026-04-25 03:29:41',
                        'updated_at' => '2026-05-12 15:56:41',
                    ),
                    6 => 
                    array (
                        'id' => 7,
                        'name' => 'Ghẹ Xanh Phan Thiết',
                        'size' => NULL,
                        'slug' => 'ghe-xanh-phan-thiet-1778601152',
                        'description' => 'Ghẹ xanh đánh bắt tự nhiên, thịt thơm ngon.

1. Đặc điểm nhận diện "Ghẹ Xanh Phan Thiết"
Ngoại hình: Ghẹ có màu xanh lam đặc trưng với các đốm trắng li ti trải đều trên lớp mai. Đôi càng của ghẹ xanh thường dài, thon và có màu xanh đậm bắt mắt.

Chất lượng thịt: Đây là loại ghẹ có tỷ lệ thịt cao nhất. Thịt ghẹ xanh Phan Thiết nổi tiếng với độ ngọt thanh, thơm đặc trưng và đặc biệt là sớ thịt rất chắc, không bị mọng nước hay bở như các loại ghẹ đỏ hay ghẹ đá.

2. Giá trị dinh dưỡng vượt trội
Ghẹ xanh là nguồn cung cấp canxi và protein dồi dào, rất tốt cho sức khỏe xương khớp và tim mạch.

Chứa nhiều kẽm, đồng và các vitamin nhóm B, giúp tăng cường hệ miễn dịch tự nhiên.

3. Bí quyết thưởng thức ngon nhất
Với một loại hải sản cao cấp như ghẹ xanh Phan Thiết, càng chế biến đơn giản càng giữ được vị ngon tinh túy:

Ghẹ hấp bia/nước dừa: Đây là cách chế biến số 1. Hương thơm của bia hoặc vị béo của nước dừa sẽ làm tôn lên vị ngọt lịm của thịt ghẹ.

Ghẹ rang muối kéo chỉ: Món ăn đậm đà, kích thích vị giác, thường thấy trong các nhà hàng hải sản lớn.

Bánh canh ghẹ: Thịt ghẹ chắc ngọt kết hợp với nước dùng đậm đà tạo nên món ăn sáng trứ danh.

Nước chấm đi kèm: Không gì hoàn hảo hơn khi chấm ghẹ với muối tiêu chanh hoặc muối ớt xanh pha chuẩn vị.

4. Hướng dẫn chọn và Bảo quản
Cách chọn ghẹ ngon: Phú có thể chia sẻ cho khách mẹo: "Bấm nhẹ vào phần yếm, nếu yếm chắc, không bị lún là ghẹ đầy thịt".

Bảo quản: Ghẹ xanh ngon nhất khi còn sống. Tuy nhiên, tại cửa hàng, ghẹ có thể được ướp đá lạnh để giữ độ tươi trong ngày hoặc cấp đông chuyên sâu nếu vận chuyển xa.',
                        'price' => '420000.00',
                        'unit' => 'kg',
                        'stock' => 0,
                        'image' => 'ghe-xanh-phan-thiet.jpg',
                        'category_id' => 3,
                        'is_active' => 1,
                        'type' => 'fresh',
                        'created_at' => '2026-04-25 03:29:41',
                        'updated_at' => '2026-05-12 15:52:32',
                    ),
                    7 => 
                    array (
                        'id' => 8,
                        'name' => 'Mực Lá Miền Trung',
                        'size' => NULL,
                        'slug' => 'muc-la-mien-trung-1778601053',
                        'description' => 'Mực lá dày mình, giòn sần sật, phù hợp món xào hoặc nướng.

1. Đặc điểm hình thái (Cách nhận biết)
Hình dáng: Mực có thân hình bầu dục, vây dày hình lá trải dài dọc theo cả thân (đây là lý do có tên gọi là Mực Lá).

Đặc điểm thịt: Phần cơm (thịt) của mực lá rất dày và trắng muốt. So với mực ống, mực lá có thân ngắn hơn nhưng bề ngang rộng và thịt dày hơn hẳn.

Màu sắc: Mực lá tươi có lớp da lốm đốm màu tím nâu ánh kim, khi chạm vào các điểm màu này có thể đổi màu sắc liên tục (mực nháy).

2. Chất lượng đẳng cấp từ miền Trung
Vị ngọt nguyên bản: Nhờ điều kiện môi trường biển dải miền Trung đầy nắng và gió, mực lá tại đây có độ ngọt tự nhiên rất cao.

Độ giòn: Khi ăn, bạn sẽ cảm nhận được độ giòn sần sật ở lớp vỏ ngoài nhưng lại mềm ngọt ở bên trong, không bị dai cứng như các loại mực già.

3. Món ngon đề xuất
Mực lá miền Trung rất "đa năng" trong chế biến, nhưng ngon nhất vẫn là:

Mực lá nướng mọi/nướng muối ớt: Vì thịt dày nên khi nướng sẽ không bị teo, miếng mực vàng ươm, thơm nức mũi.

Mực lá hấp gừng/cần tỏi: Cách này giữ trọn vẹn nước ngọt của mực, rất bổ dưỡng.

Lẩu mực: Sớ thịt dày giúp mực giữ được độ giòn lâu trong nồi lẩu mà không bị nát.

Mực lá ăn sống (Sashimi): Đối với những con mực lá vừa đánh bắt còn nháy, thịt mực đạt độ tinh khiết cao, rất ngọt và giòn.

4. Thông tin sản phẩm cho khách hàng
Quy cách: Thường đóng gói theo con (Size từ 0.5kg - 1.5kg/con).

Trạng thái: Tươi xanh hoặc cấp đông chuyên sâu ngay tại tàu để giữ chất lượng "như mới đánh bắt".

Lưu ý bảo quản: Để trong ngăn đông tủ lạnh, tránh rửa bằng nước ngọt trước khi bảo quản để không làm mất vị ngọt tự nhiên của mực.',
                        'price' => '350000.00',
                        'unit' => 'kg',
                        'stock' => 1107,
                        'image' => 'muc-la-mien-trung.jpg',
                        'category_id' => 4,
                        'is_active' => 1,
                        'type' => 'fresh',
                        'created_at' => '2026-04-25 03:29:41',
                        'updated_at' => '2026-05-12 15:50:53',
                    ),
                    8 => 
                    array (
                        'id' => 9,
                        'name' => 'Bạch Tuộc Hai Da',
                        'size' => NULL,
                        'slug' => 'bach-tuoc-hai-da-1778600984',
                        'description' => 'Bạch tuộc tươi giòn, chuyên cho các quán nướng/lẩu.
1. Tại sao gọi là "Bạch tuộc hai da"?
Đặc điểm tên gọi: Sở dĩ có tên gọi này là vì lớp da của chúng dày hơn, khi chế biến hoặc lột nhẹ sẽ cảm giác như có hai lớp da bao bọc. Đây là dấu hiệu của loại bạch tuộc có phần thịt săn chắc, dày cơm và rất dẻo.

Kích thước: Thường có kích cỡ vừa phải, không quá to nhưng cầm rất nặng tay, thịt đặc.

2. Ưu điểm nổi bật về chất lượng
Độ giòn và dẻo: Khác với bạch tuộc nước thường bị ra nước nhiều và bở khi nấu, bạch tuộc hai da khi chế biến xong vẫn giữ được độ giòn sần sật nhưng lại có độ dẻo thơm đặc trưng.

Vị ngọt: Thịt có vị ngọt đậm đà tự nhiên của biển, không cần tẩm ướp quá nhiều gia vị vẫn rất ngon.

Tỷ lệ hao hụt thấp: Khi xào hoặc nướng, bạch tuộc hai da ít bị teo nhỏ lại so với các loại khác, giúp món ăn trông đầy đặn và bắt mắt hơn.

3. Gợi ý chế biến (Dành cho thực khách)
Bạch tuộc hai da là "vua" của các món nướng và nhúng mẻ:

Bạch tuộc nướng sa tế/muối ớt: Đây là món ăn kinh điển. Lớp da bên ngoài cháy cạnh thơm lừng, bên trong vẫn giữ được độ ẩm và ngọt.

Nhúng giấm/nhúng mẻ: Giúp giữ trọn vẹn độ giòn sần sật.

Hấp gừng/hấp hành: Giữ nguyên vị thanh ngọt nguyên bản cho những ai thích ăn hải sản kiểu truyền thống.

4. Quy cách đóng gói tại cửa hàng
Trạng thái: Tươi sống (nguyên con) hoặc cấp đông nhanh (IQF) để giữ trọn dưỡng chất.

Làm sạch: Sản phẩm thường được hỗ trợ làm sạch nội tạng, khách mua về chỉ cần rửa sơ qua là có thể chế biến ngay.',
                        'price' => '180000.00',
                        'unit' => 'kg',
                        'stock' => 3324,
                        'image' => 'Bach-Tuoc-2-Da.jpg',
                        'category_id' => 4,
                        'is_active' => 1,
                        'type' => 'frozen',
                        'created_at' => '2026-04-25 03:29:41',
                        'updated_at' => '2026-05-12 15:49:44',
                    ),
                    9 => 
                    array (
                        'id' => 10,
                    'name' => 'Mực Khô Loại 1 (6-8 con/kg)',
                        'size' => '6-8 con',
                        'slug' => 'muc-kho-loai-1-6-8-conkg-1778600898',
                        'description' => 'Mực khô câu tay, phơi nắng tự nhiên, thịt ngọt lịm.
1. Nguồn gốc và Tiêu chuẩn chọn lọc
Nguyên liệu: Được tuyển chọn từ những con mực ống tươi vừa mới đánh bắt từ vùng biển sâu (đặc biệt là vùng biển sạch có độ mặn cao).

Phương pháp phơi: Mực được phơi theo phương pháp "phơi sào" hoặc "phơi mành" ngay trên tàu hoặc tại bãi biển dưới cái nắng gắt, đảm bảo thân mực thẳng, bụng trắng, lưng có màu hồng nhạt tự nhiên và lốm đốm phấn trắng.

2. Đặc điểm nhận dạng (Size VIP)
Kích thước: Đây là loại mực kích cỡ lớn (6-8 con mỗi cân). Thân mực dài, dày cơm, thịt rất chắc.

Trạng thái: Mực khô chuẩn loại 1 phải có lớp phấn trắng bao phủ vừa phải (chứng tỏ mực mới phơi, không phải hàng cũ). Đầu mực và râu mực dính chặt vào thân, không bị rơi rụng.

3. Trải nghiệm ẩm thực
Hương vị: Khi nướng lên, mực tỏa mùi thơm đặc trưng của biển cả, không có mùi hôi hay khét nồng.

Cảm giác khi ăn: Thịt mực ngọt đậm đà, càng nhai càng ngọt. Độ dai vừa phải, sớ thịt xé ra tơi xốp, không bị cứng hay vụn.

Món ăn kèm: Hoàn hảo nhất khi chấm cùng tương ớt cay hoặc làm món mực khô xào mắm tỏi, gỏi mực ngũ sắc.

4. Quy cách đóng gói & Bảo quản
Quy cách: Đóng gói hút chân không (thường là 500g hoặc 1kg) để đảm bảo vệ sinh và giữ nguyên mùi vị.

Bảo quản: Ngăn đông tủ lạnh (có thể giữ chất lượng tốt nhất lên đến 6-12 tháng).',
                            'price' => '1150000.00',
                            'unit' => 'kg',
                            'stock' => 213,
                            'image' => 'products/fhF289ZSF2Ii8nbdoDv4jhhQRmM2m2A0X0lFkCcx.jpg',
                            'category_id' => 5,
                            'is_active' => 1,
                            'type' => 'dried',
                            'created_at' => '2026-04-25 03:29:41',
                            'updated_at' => '2026-05-12 15:48:18',
                        ),
                        10 => 
                        array (
                            'id' => 11,
                            'name' => 'Khô Cá Khoai Trà Vinh',
                            'size' => '20 con',
                            'slug' => 'kho-ca-khoai-tra-vinh-1778620988',
                            'description' => 'Đặc sản khô cá khoai xứ biển Ba Động, nướng chấm mắm me. 

1. Nguồn gốc và Đặc điểm hình thái
Nguyên liệu: Được làm từ cá khoai tươi (hay còn gọi là cá cháo). Loại cá này có thân hình thon dài, thịt trắng muốt, mềm như cháo và rất ít xương.

Quy trình chế biến: Cá khoai sau khi đánh bắt về được làm sạch, không cần tẩm ướp quá nhiều gia vị để giữ nguyên vị ngọt thanh tự nhiên. Cá được móc mang vào những cây sào tre và phơi dưới nắng gắt của vùng biển cho đến khi săn lại, chuyển sang màu vàng rơm đặc trưng.

2. Hương vị đặc trưng
Mùi vị: Khô cá khoai có mùi thơm nồng nàn rất riêng, không lẫn với các loại khô khác.

Cảm giác khi ăn: Khi nướng chín, thịt cá khô dai nhẹ, vị ngọt thanh xen lẫn chút vị đắng thanh tao ở hậu vị – đây chính là "điểm gây nghiện" của loại khô này. Khi nhai kỹ, bạn sẽ cảm nhận được độ béo bùi tự nhiên của cá biển.

3. Cách chế biến phổ biến
Nướng lửa than: Đây là cách chế biến ngon nhất. Khô cá khoai nướng vừa chín tới, đập dập cho mềm rồi xé nhỏ.

Nước chấm "thần thánh": Món này bắt buộc phải đi kèm với nước mắm me cay nồng hoặc nước mắm xoài băm sợi. Vị chua của me, vị cay của ớt hòa quyện với vị đắng ngọt của cá tạo nên một trải nghiệm vị giác khó quên.

4. Giá trị dinh dưỡng và Sử dụng
Dinh dưỡng: Cá khoai chứa nhiều đạm, canxi và các khoáng chất có lợi cho sức khỏe, đặc biệt là tính mát, hỗ trợ giải nhiệt tốt.

Sử dụng: Thường được dùng làm món nhắm (mồi nhậu) lý tưởng, hoặc ăn kèm với cơm trắng, cháo trắng trong các bữa ăn gia đình miền Tây sông nước.',
                                'price' => '250000.00',
                                'unit' => 'kg',
                                'stock' => 438,
                                'image' => 'kho-ca-khoai-size-co.jpg',
                                'category_id' => 5,
                                'is_active' => 1,
                                'type' => 'dried',
                                'created_at' => '2026-04-25 03:29:41',
                                'updated_at' => '2026-05-12 21:23:08',
                            ),
                            11 => 
                            array (
                                'id' => 12,
                                'name' => 'Mắm cá linh',
                                'size' => '500g',
                                'slug' => 'mam-ca-linh-1778596253',
                                'description' => 'Sản phẩm dùng rất ngon.',
                                'price' => '80000.00',
                                'unit' => 'hủ',
                                'stock' => 103,
                                'image' => 'products/DnzUqF2kQNuuEo4yTCZTveTG0BxU5MdWfMtYlqes.jpg',
                                'category_id' => 6,
                                'is_active' => 0,
                                'type' => 'fermentation',
                                'created_at' => '2026-05-05 14:41:42',
                                'updated_at' => '2026-05-12 14:30:53',
                            ),
                            12 => 
                            array (
                                'id' => 14,
                                'name' => 'Cá Trắm Cỏ',
                                'size' => 'Vừa',
                                'slug' => 'ca-tram-co-1778813914',
                                'description' => '1. Đặc điểm hình thái
Cá trắm cỏ có ngoại hình rất dễ nhận biết, khác biệt rõ rệt với cá trắm đen:

Thân hình: Hình trụ dài, thuôn về phía đuôi.

Màu sắc: Thân có màu vàng nhạt hoặc trắng xám, bụng màu trắng bạc. Vảy cá to, tròn và có viền đen nhạt tạo thành họa tiết đẹp mắt.

Miệng: Miệng rộng, hình cung, không có râu.

Kích thước: Trong môi trường tự nhiên hoặc nuôi lâu năm, chúng có thể đạt trọng lượng từ 10 – 30kg.

2. Tập tính và thức ăn
Đây là loài cá cực kỳ hiền lành và dễ nuôi nhờ đặc điểm ăn uống "thuần chay":

Thức ăn: Thức ăn chính là các loại thực vật thủy sinh (rong, rêu, bèo) và các loại cỏ trên cạn. Khi nuôi công nghiệp, chúng ăn tốt các loại cám ngô, cám gạo và thức ăn viên.

Môi trường sống: Ưa sống ở tầng nước giữa và tầng dưới, nơi có nước sạch và hàm lượng oxy cao.

Sinh sản: Trong tự nhiên, cá thường đẻ trứng ở các dòng sông có dòng chảy mạnh. Trong môi trường ao nuôi, con người thường phải thực hiện sinh sản nhân tạo bằng cách tiêm kích dục tố.

3. Giá trị kinh tế và dinh dưỡng
Cá trắm cỏ là thực phẩm quen thuộc trong mâm cơm gia đình Việt nhờ những ưu điểm:

Về dinh dưỡng
Thịt cá trắm cỏ chắc, thơm bùi và chứa nhiều dưỡng chất:

Giàu protein và các axit amin thiết yếu.

Chứa nhiều khoáng chất như canxi, photpho, sắt và các vitamin nhóm B.

Trong ẩm thực
Thịt cá có vị ngọt tính bình, rất dễ chế biến thành nhiều món ngon:

Cá trắm kho riềng: Món ăn kinh điển, thịt cá săn chắc, thấm vị.

Cá trắm nấu canh chua: Giải nhiệt tốt, vị thanh.

Cá trắm hấp xì dầu: Giữ trọn vị ngọt tự nhiên của thịt cá.',
                                'price' => '60000.00',
                                'unit' => 'kg',
                                'stock' => 9,
                                'image' => 'products/GpvueumUttHspqOIX19V6qeHAJtebECKNQ6SeHdx.jpg',
                                'category_id' => 2,
                                'is_active' => 1,
                                'type' => 'fresh',
                                'created_at' => '2026-05-15 02:58:34',
                                'updated_at' => '2026-05-15 07:50:14',
                            ),
                        ));
        
        
    }
}