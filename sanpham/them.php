<?php
require_once __DIR__ . '/../dbconnect.php';

$sqlLoaiSanPham = <<<EOT
    SELECT * FROM loaisanpham;
EOT;
$resultLoaiSanPham = mysqli_query($conn, $sqlLoaiSanPham);
$dataLoaiSanPham = [];
while ($row = mysqli_fetch_array($resultLoaiSanPham, MYSQLI_ASSOC)) {
    $dataLoaiSanPham[] = array(
        'lsp_ma' => $row['lsp_ma'],
        'lsp_ten' => $row['lsp_ten'],
    );
}
?>

<form name="frmThemMoiSanPham" id="frmThemMoiSanPham" method="post" action="">
    Tên sản phẩm: <input type="text" name="sp_ten" id="sp_ten" /><br />
    Giá sản phẩm: <input type="text" name="sp_gia" id="sp_gia" /><br />
    Giá cũ sản phẩm: <input type="text" name="sp_giacu" id="sp_giacu" /><br />
    Mô tả ngắn sản phẩm: <input type="text" name="sp_mota_ngan" id="sp_mota_ngan" /><br />
    Mô tả chi tiết sản phẩm: <input type="text" name="sp_mota_chitiet" id="sp_mota_chitiet" /><br />
    Ngày cập nhật sản phẩm: <input type="text" name="sp_ngaycapnhat" id="sp_ngaycapnhat" /><br />
    Số lượng sản phẩm: <input type="text" name="sp_soluong" id="sp_soluong" /><br />
    Loại sản phẩm: 
    <select name="lsp_ma" id="lsp_ma">
        <?php foreach($dataLoaiSanPham as $loaiSanPham) : ?>
        <option value="<?= $loaiSanPham['lsp_ma'] ?>"><?= $loaiSanPham['lsp_ten'] ?></option>
        <?php endforeach; ?>
    </select>
    
    <br />
    

    <input type="submit" name="btnLuu" id="btnLuu" value="Lưu dữ liệu" />
</form>