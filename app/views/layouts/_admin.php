<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Trang chủ - Văn phòng phẩm</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <base href="<?php echo _WEB_ROOT ?>">
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">

    <!-- CSS Libraries -->
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        /* Sidebar styles */
        .sidebar {
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            background-color: #343a40;
            color: white;
            padding-top: 20px;
        }

        .sidebar h3 {
            color: white;
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar .nav-link {
            color: white;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background-color: #495057;
        }

        /* Main content styles */
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        /* Header styles */
        .admin-header {
            background-color: #ffffff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .admin-header .dropdown .btn {
            background-color: #6c757d;
            color: white;
        }

        .admin-header .dropdown-menu {
            right: 0;
            left: auto;
        }

        .content-section {
            background-color: #f8f9fa;
        }

        .content-section h2 {
            font-size: 1.75rem;
            font-weight: bold;
        }

        .home-admin .card {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .home-admin .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #007bff;
        }

        .card-text {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .admin-container {
            width: 90%;
            margin: 20px auto;
            min-height: 70vh;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        button {
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .alert-overlay {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
            width: auto;
        }

        .pagination-container {
            margin-top: auto;
            /* Đẩy phần phân trang xuống dưới */
            text-align: center;
        }

        .pagination {
            justify-content: center;
            /* Giữ phân trang ở giữa */
        }
    </style>
</head>

<body>
    <div class="alert-overlay">
        <?php

        if (isset($_SESSION['result'])) {
            $result = $_SESSION['result'];
        ?>
            <div class="alert alert-<?php echo $result['class'] ?>" role="alert">

                <?php echo $result['msg'] ?>

            </div>
        <?php
            unset($_SESSION['result']);
        }
        ?>
    </div>


    <?php
    $menuItems = [
        'quan-ly-danh-muc' => ['tao-moi-danh-muc', 'sua-danh-muc', 'xoa-danh-muc'],
        'quan-ly-san-pham' => ['tao-moi-san-pham', 'chi-tiet-san-pham', 'chinh-sua-san-pham', 'xoa-san-pham'],
        'quan-ly-don-hang' => ['xem-chi-tiet-don-hang'],
        'quan-ly-tai-khoan' => ['chi-tiet-tai-khoan-khach-hang'],
        'quan-ly-lien-he' => ['chi-tiet-lien-he', 'xoa-lien-he'],
    ];
    $currentUrl = $_SERVER['REQUEST_URI'];

    $currentPage = basename(parse_url($currentUrl, PHP_URL_PATH));

    function isActivePage($page, $menuItems, $currentPage)
    {
        if (in_array($currentPage, $menuItems[$page])) {
            return 'active';
        }
        if ($currentPage === $page) {
            return 'active';
        }
        return '';
    }
    ?>


    <!-- Sidebar -->
    <nav class="sidebar">
        <a href="<?php echo _WEB_ROOT ?>/trang-chu-admin" class="text-decoration-none">
            <h3>Quản Trị</h3>
        </a>
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
                <a href="<?php echo _WEB_ROOT ?>/quan-ly-danh-muc" class="nav-link <?php echo isActivePage('quan-ly-danh-muc', $menuItems, $currentPage); ?>"><i class="fa fa-list"></i> Quản Lý Danh Mục</a>
            </li>
            <li class="nav-item">
                <a href="<?php echo _WEB_ROOT ?>/quan-ly-san-pham" class="nav-link <?php echo isActivePage('quan-ly-san-pham', $menuItems, $currentPage); ?>"><i class="fa fa-box"></i> Quản Lý Sản Phẩm</a>
            </li>
            <li class="nav-item">
                <a href="<?php echo _WEB_ROOT ?>/quan-ly-don-hang" class="nav-link <?php echo isActivePage('quan-ly-don-hang', $menuItems, $currentPage); ?>"><i class="fa fa-shopping-cart"></i> Quản Lý Đơn Hàng</a>
            </li>
            <li class="nav-item">
                <a href="<?php echo _WEB_ROOT ?>/quan-ly-tai-khoan" class="nav-link <?php echo isActivePage('quan-ly-tai-khoan', $menuItems, $currentPage); ?>"><i class="fa fa-user"></i> Quản Lý Tài Khoản</a>
            </li>
            <li class="nav-item">
                <a href="<?php echo _WEB_ROOT ?>/quan-ly-lien-he" class="nav-link <?php echo isActivePage('quan-ly-lien-he', $menuItems, $currentPage); ?>"><i class="fa fa-envelope"></i> Quản Lý Liên Hệ</a>
            </li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <header class="admin-header">
            <h1>Tổng quan</h1>

            <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-user"></i> <?php if (isset($_SESSION['useradmin'])) echo $_SESSION['useradmin']['username'] ?>
                </button>
                <ul class="dropdown-menu" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="<?php echo _WEB_ROOT ?>/trang-chu-admin?logout">Đăng Xuất</a></li>
                </ul>
            </div>
        </header>

        <!-- Nội dung -->
        <div class="container">
            <?php
            echo $content;
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo _WEB_ROOT ?>/public/js/admin.js"></script>

    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $(".alert").alert("close");
            }, 3000); // 3000ms = 3 seconds
        });
    </script>

</body>

</html>