<h1>Đây là chức năng Sửa Loại sản phẩm</h1>
<?php
    require_once __DIR__ . '/../dbconnect.php';

    $lsp_ma = $_GET['lsp_ma'];
    echo 'Đang sửa khóa chính là: ' . $lsp_ma . '<br/>';

    $sqlSelect = "SELECT * FROM loaisanpham WHERE lsp_ma = $lsp_ma;";
    $resultSelect = mysqli_query($conn, $sqlSelect);

    $loaisanphamRow = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC); // 1 record
    print_r($loaisanphamRow);
?>