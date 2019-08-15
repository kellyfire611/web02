<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quản lý Salomon</title>

    <!-- Liên kết CSS bootstrap -->
    <link href="public/vendor/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet" />

    <style>
    div {
        border: 1px solid red;
    }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="row">
            <div class="col-md-6 col-12 col-xl-3">
                Cột LOGO
            </div><!-- /End cột LOGO -->
            <div class="col-md-6 col-12 col-xl-9">
                Cột Tên công ty
            </div><!-- /End cột COMPANY NAME -->
        </div><!-- /End header -->

        <!-- Main content -->
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <ul class="list-group">
                    <li class="list-group-item"><a href="loaisanpham/danhsach.php">Danh sách Loại sản phẩm</a></li>
                    <li class="list-group-item"><a href="sanpham/danhsach.php">Danh sách Sản phẩm</a></li>
                </ul>
            </div><!-- /End sidebar -->
            <!-- Content -->
            <div class="col-md-9">
                <?php
                $page = $_GET['page'];
                if($page == 'loaisanpham_danhsach') {
                    include('loaisanpham/danhsach.php');
                } else if($page == 'sanpham_danhsach') {
                    include('sanpham/danhsach.php');
                }
                ?>
            </div><!-- /End content -->
        </div><!-- /End main content -->

        <!-- Footer -->
        <div class="row">
            <div class="col-md-3">
                Cột ABOUT US
            </div><!-- /End cột ABOUT US -->
            <div class="col-md-3">
                Cột LINK
            </div><!-- /End cột LINK -->
            <div class="col-md-3">
                Cột NEWS
            </div><!-- /End cột NEWS -->
            <div class="col-md-3">
                Cột GOOGLE MAP
            </div><!-- /End cột MAP -->
        </div><!-- /End Footer -->
    </div>


    <!-- Hầu như tích hợp thư viện JS trước khi đóng thẻ BODY để tăng trải nghiệm người dùng -->
    <!-- Liên kết thư viện JQuery -->
    <script src="public/vendor/jquery/jquery.min.js"></script>

    <!-- Liên kết thư viện POPPERJS -->
    <script src="public/vendor/popperjs/popper.min.js"></script>

    <!-- Liên kết thư viện Bootstrap 4 -->
    <script src="public/vendor/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
