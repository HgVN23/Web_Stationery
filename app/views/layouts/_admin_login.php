<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .alert-overlay {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
            width: auto;
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
    echo $content;
    ?>

    <!-- Bootstrap JS và Popper.js -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $(".alert").alert("close");
            }, 1500); // 3000ms = 3 seconds
        });
    </script>
</body>

</html>