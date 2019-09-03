<?php
require_once __DIR__ . '/../dbconnect.php';

?>

<form id="frmDangKy" name="frmDangKy" method="post" action="">
    Tên đăng nhập: <input type="text" name="kh_tendangnhap" id="kh_tendangnhap" class="form-control" /><br />
    Mật khẩu: <input type="password" name="kh_matkhau" id="kh_matkhau" class="form-control" /><br />
    <button name="btnDangNhap" id="btnDangNhap" class="btn btn-primary">
        <i class="fa fa-heartbeat" aria-hidden="true"></i> Đăng nhập
    </button>
</form>

<?php
if(isset($_POST['btnDangNhap'])) {
    $kh_tendangnhap = $_POST['kh_tendangnhap'];
    // 123456 -> sha1('123456')
    // 7c4a8d09ca3762af61e59520943dc26494f8941b
    $kh_matkhau = sha1($_POST['kh_matkhau']);

    $sqlSelect = "select * from khachhang where kh_tendangnhap = '$kh_tendangnhap' AND kh_matkhau = '$kh_matkhau'";
    $resultSelect = mysqli_query($conn, $sqlSelect);

    $khachhangRow = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC); // 1 record
    if(empty($khachhangRow)) {
        echo 'Đăng nhập không thành công. Vui lòng kiểm tra lại thông tin!';
    } else {
        echo 'Đăng nhập Thành công!';
    }
}
?>