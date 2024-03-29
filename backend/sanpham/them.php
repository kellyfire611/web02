<?php
require_once __DIR__ . '/../dbconnect.php';

// Lấy dữ liệu Loại sản phẩm
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

// Lấy dữ liệu Nhà sản xuất
$sqlNhaSanXuat = <<<EOT
    SELECT * FROM nhasanxuat;
EOT;
$resultNhaSanXuat = mysqli_query($conn, $sqlNhaSanXuat);
$dataNhaSanXuat = [];
while ($row = mysqli_fetch_array($resultNhaSanXuat, MYSQLI_ASSOC)) {
    $dataNhaSanXuat[] = array(
        'nsx_ma' => $row['nsx_ma'],
        'nsx_ten' => $row['nsx_ten'],
    );
}

// Lấy dữ liệu Khuyến mãi
$sqlKhuyenMai = <<<EOT
    SELECT * FROM khuyenmai;
EOT;
$resultKhuyenMai = mysqli_query($conn, $sqlKhuyenMai);
$dataKhuyenMai = [];
while ($row = mysqli_fetch_array($resultKhuyenMai, MYSQLI_ASSOC)) {
    $dataKhuyenMai[] = array(
        'km_ma' => $row['km_ma'],
        'km_ten' => $row['km_ten'],
    );
}
?>

<form name="frmThemMoiSanPham" id="frmThemMoiSanPham" method="post" action="">
    Tên sản phẩm: <input type="text" name="sp_ten" id="sp_ten" class="form-control" /><br />
    Giá sản phẩm: <input type="text" name="sp_gia" id="sp_gia" class="form-control" /><br />
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
    Nhà sản xuất: 
    <select name="nsx_ma" id="nsx_ma">
        <?php foreach($dataNhaSanXuat as $nhasanxuat) : ?>
        <option value="<?= $nhasanxuat['nsx_ma'] ?>"><?= $nhasanxuat['nsx_ten'] ?></option>
        <?php endforeach; ?>
    </select>
    <br />
    Khuyến mãi: 
    <select name="km_ma" id="km_ma">
        <?php foreach($dataKhuyenMai as $khuyenmai) : ?>
        <option value="<?= $khuyenmai['km_ma'] ?>"><?= $khuyenmai['km_ten'] ?></option>
        <?php endforeach; ?>
    </select>
    <br />
    <button name="btnLuu" id="btnLuu" class="btn btn-primary">
        <i class="fa fa-heartbeat" aria-hidden="true"></i> Lưu
    </button>
</form>

<?php
if(isset($_POST['btnLuu'])) {
    $sp_ten = $_POST['sp_ten'];
    $sp_gia = $_POST['sp_gia'];
    $sp_giacu = $_POST['sp_giacu'];
    $sp_mota_ngan = $_POST['sp_mota_ngan'];
    $sp_mota_chitiet = $_POST['sp_mota_chitiet'];
    $sp_ngaycapnhat = $_POST['sp_ngaycapnhat'];
    $sp_soluong = $_POST['sp_soluong'];
    $lsp_ma = $_POST['lsp_ma'];
    $nsx_ma = $_POST['nsx_ma'];
    $km_ma = isset($_POST['km_ma']) ? $_POST['km_ma'] : 'NULL';

    // Kiểm tra ràng buộc dữ liệu (Validation)
    // Tạo biến lỗi để chứa thông báo lỗi
    $errors = [];
    // required
    // ''
    // NULL
    if (empty($sp_ten)) {
        $errors['sp_ten'][] = [
            'rule' => 'required',
            'rule_value' => true,
            'value' => $sp_ten,
            'msg' => 'Vui lòng nhập tên Sản phẩm'
        ];
    }
    // minlength 3
    if (!empty($sp_ten) && strlen($sp_ten) < 3) {
        $errors['sp_ten'][] = [
            'rule' => 'minlength',
            'rule_value' => 3,
            'value' => $sp_ten,
            'msg' => 'Tên Sản phẩm phải có ít nhất 3 ký tự'
        ];
    }
    // maxlength 50
    if (!empty($sp_ten) && strlen($sp_ten) > 50) {
        $errors['sp_ten'][] = [
            'rule' => 'maxlength',
            'rule_value' => 50,
            'value' => $sp_ten,
            'msg' => 'Tên Sản phẩm không được vượt quá 50 ký tự'
        ];
    }

    // Nếu như có lỗi -> thông báo lỗi ra màn hình
    if (!empty($errors)) { ?>
<div id="thongbao" class="alert alert-danger face" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <ul>
        <?php foreach($errors as $fields) : ?>
            <?php foreach($fields as $field) : ?>
            <li><?= $field['msg']; ?></li>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </ul>
</div>
    <?php
    }
    else {
        $sqlInsert = "INSERT INTO sanpham(sp_ten, sp_gia, sp_giacu, sp_mota_ngan, sp_mota_chitiet, sp_ngaycapnhat, sp_soluong, lsp_ma, nsx_ma, km_ma) VALUES (N'$sp_ten', $sp_gia, $sp_giacu, N'$sp_mota_ngan', N'$sp_mota_chitiet', '$sp_ngaycapnhat', $sp_soluong, $lsp_ma, $nsx_ma, $km_ma);";
        $resultInsert = mysqli_query($conn, $sqlInsert);
    }
}
?>