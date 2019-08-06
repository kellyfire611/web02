<h1>Đây là chức năng Sửa Loại sản phẩm</h1>
<?php
    require_once __DIR__ . '/../dbconnect.php';

    $lsp_ma = $_GET['lsp_ma'];
    echo 'Đang sửa khóa chính là: ' . $lsp_ma . '<br/>';

    $sqlSelect = "SELECT * FROM loaisanpham WHERE lsp_ma = $lsp_ma;";
    $resultSelect = mysqli_query($conn, $sqlSelect);

    $loaisanphamRow = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC); // 1 record
    // print_r($loaisanphamRow);
?>

<form name="frmLoaiSanPhamSua" id="frmLoaiSanPhamSua" method="post" action="">
    Mã loại sản phẩm: <input type="text" name="lsp_ma" id="lsp_ma" readonly value="<?php echo $loaisanphamRow['lsp_ma'] ?>" /><br />
    Tên sản phẩm: <input type="text" name="lsp_ten" id="lsp_ten" value="<?= $loaisanphamRow['lsp_ten'] ?>" /><br />
    Mô tả sản phẩm: <input type="text" name="lsp_mota" id="lsp_mota" value="<?= $loaisanphamRow['lsp_mota'] ?>" /><br />
    <input type="submit" name="btnSua" id="btnSua" value="Lưu" />
</form>