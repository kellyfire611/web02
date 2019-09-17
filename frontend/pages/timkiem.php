<?php
// Include file cấu hình ban đầu của `Twig`
require_once __DIR__ . '/../../bootstrap.php';
// Truy vấn database để lấy danh sách
// 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
include_once(__DIR__ . '/../../dbconnect.php');

/* --- 
   --- 2.Truy vấn dữ liệu Loại Sản phẩm 
   --- 
*/
$sqlSelectLoaiSanPham = <<<EOT
    SELECT lsp.lsp_ma, lsp.lsp_ten, COUNT(*) soluongsanpham
    FROM `loaisanpham` lsp
    LEFT JOIN `sanpham` sp ON lsp.lsp_ma = sp.lsp_ma
    GROUP BY lsp.lsp_ma, lsp.lsp_ten
EOT;

// Thực thi câu truy vấn SQL để lấy về dữ liệu ban đầu của record 
$resultSelectLoaiSanPham = mysqli_query($conn, $sqlSelectLoaiSanPham);

// Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
// Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
// Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
$loaisanphamData = [];
while ($row = mysqli_fetch_array($resultSelectLoaiSanPham, MYSQLI_ASSOC)) {
    $loaisanphamData[] = array(
        'lsp_ma' => $row['lsp_ma'],
        'lsp_ten' => $row['lsp_ten'],
        'soluongsanpham' => $row['soluongsanpham'],
    );
}
/* --- End Truy vấn dữ liệu Loại Sản phẩm --- */

/* --- 
   --- 3.Truy vấn dữ liệu Nhà sản xuất
   --- 
*/
$sqlSelectNhaSanXuat = <<<EOT
    SELECT nsx.nsx_ma, nsx.nsx_ten, COUNT(*) soluongsanpham
    FROM `nhasanxuat`nsx
    LEFT JOIN `sanpham` sp ON nsx.nsx_ma = sp.nsx_ma
    GROUP BY nsx.nsx_ma, nsx.nsx_ten
EOT;
// Thực thi câu truy vấn SQL để lấy về dữ liệu ban đầu của record 
$resultSelectNhaSanXuat = mysqli_query($conn, $sqlSelectNhaSanXuat);
// Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
// Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
// Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
$nhasanxuatData = [];
while ($row = mysqli_fetch_array($resultSelectNhaSanXuat, MYSQLI_ASSOC)) {
    $nhasanxuatData[] = array(
        'nsx_ma' => $row['nsx_ma'],
        'nsx_ten' => $row['nsx_ten'],
        'soluongsanpham' => $row['soluongsanpham'],
    );
}
/* --- End Truy vấn dữ liệu Nhà sản xuất --- */

/* --- 
   --- 4.Truy vấn dữ liệu Khuyến mãi
   --- 
*/
$sqlSelectKhuyenMai = <<<EOT
    SELECT km.km_ma, km.km_ten, km_noidung, km_tungay, km_denngay, COUNT(*) soluongsanpham
    FROM `khuyenmai` km
    LEFT JOIN `sanpham` sp ON km.km_ma = sp.km_ma
    GROUP BY km.km_ma, km.km_ten, km_noidung, km_tungay, km_denngay
EOT;
// Thực thi câu truy vấn SQL để lấy về dữ liệu ban đầu của record 
$resultSelectKhuyenMai = mysqli_query($conn, $sqlSelectKhuyenMai);
// Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
// Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
// Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
$khuyenmaiData = [];
while ($row = mysqli_fetch_array($resultSelectKhuyenMai, MYSQLI_ASSOC)) {
    $khuyenmaiData[] = array(
        'km_ma' => $row['km_ma'],
        'km_ten' => $row['km_ten'],
        'km_noidung' => $row['km_noidung'],
        'km_tungay' => $row['km_tungay'],
        'km_denngay' => $row['km_denngay'],
        'soluongsanpham' => $row['soluongsanpham'],
    );
}
/* --- End Truy vấn dữ liệu Khuyến mãi --- */

// Yêu cầu `Twig` vẽ giao diện được viết trong file `frontend/pages/timkiem.html.twig`
echo $twig->render(
    'frontend/pages/timkiem.html.twig',
    [
        // Danh mục tiêu chí tìm kiếm
        'danhsachloaisanpham' => $loaisanphamData,
        'danhsachnhasanxuat' => $nhasanxuatData,
        'danhsachkhuyenmai' => $khuyenmaiData,
    ]
);