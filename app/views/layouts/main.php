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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <link href="<?php echo _WEB_ROOT ?>/public/lib/slick/slick.css" rel="stylesheet">
    <link href="<?php echo _WEB_ROOT ?>/public/lib/slick/slick-theme.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/css/style.css">



</head>

<body>
    <?php include _DIR_ROOT . '/app/views/layouts/alert.php'; ?>
    <?php include _DIR_ROOT . '/app/views/layouts/header.php'; ?>

    <div class="row">
        <div class="col-3">
            <?php
            include _DIR_ROOT . '/app/views/layouts/sidebar.php';
            ?>
        </div>
        <div class="col-9">
            <?php
            include _DIR_ROOT . '/app/views/layouts/_breadcrumb.php';
            echo $content;
            ?>
        </div>
    </div>

    <?php include _DIR_ROOT . '/app/views/layouts/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo _WEB_ROOT ?>/public/lib/easing/easing.min.js"></script>
    <script src="<?php echo _WEB_ROOT ?>/public/lib/slick/slick.min.js"></script>
    <script src="<?php echo _WEB_ROOT ?>/public/js/main.js"></script>

</body>

</html>