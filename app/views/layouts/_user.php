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


    <?php
    include _DIR_ROOT . '/app/views/layouts/_breadcrumb.php';
    echo $content;
    ?>

    <?php include _DIR_ROOT . '/app/views/layouts/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

    <script src="<?php echo _WEB_ROOT ?>/public/lib/easing/easing.min.js"></script>
    <script src="<?php echo _WEB_ROOT ?>/public/lib/slick/slick.min.js"></script>

    <script src="<?php echo _WEB_ROOT ?>/public/js/main.js"></script>
    <script>
        function deletecartitem(itemId) {
            // Gửi yêu cầu AJAX
            $.ajax({
                url: '<?php echo _WEB_ROOT . '/xoa-san-pham-khoi-gio-hang'  ?>', // Địa chỉ URL để gửi yêu cầu
                method: 'POST',
                data: {
                    item_id: itemId,
                }, // Gửi dữ liệu
                success: function(response) {
                    update_content(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error fetching data:', textStatus, errorThrown);
                }
            });
        }

        $(document).on('click', '.btn-delete_cart-item', function() {
            let itemId = $(this).data('item-id');
            deletecartitem(itemId);
        });




        $(document).on('click', '.btn-change-qty', function() {
            let btn = $(this);
            let currentValue = btn.parent().find("input").val();
            let itemId = $(this).data('item-id');

            handelChangeQuantity(currentValue, itemId, btn);


        });

        $(document).on('keypress', 'input[name="quantity"]', function(event) {
            if (event.which === 13) {
                event.preventDefault();
                let newQuantity = $(this).val();
                let itemId = $(this).data('item-id');
                let input = $(this);
                handelChangeQuantity(newQuantity, itemId, input);
            }
        });


        function handelChangeQuantity(currentValue, itemId, element) {
            if (currentValue == 0) {
                deletecartitem(itemId);
            } else {
                $.ajax({
                    url: '<?php echo _WEB_ROOT . '/thay-doi-so-luong'  ?>', // Địa chỉ URL để gửi yêu cầu
                    method: 'POST',
                    data: {
                        item_id: itemId,
                        quantity: currentValue,
                    }, // Gửi dữ liệu
                    success: function(response) {
                        const data = JSON.parse(response);
                        console.log(data);
                        $(`.cart_content--ft .items`).html(data.content);
                        $(`.cart_content--ft .totalAmount`).html(data.totalAmount);
                        element.closest('tr').find('.colum_totalPrice').text(data.totalPrice);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error fetching data:', textStatus, errorThrown);
                    }
                });
            }
        }




        function update_content(response) {
            const parser = new DOMParser();
            const doc = parser.parseFromString(response, 'text/html');
            const content = doc.getElementById('card-container');
            const alert = doc.querySelector('.alert-overlay');
            content && (document.getElementById('card-container').innerHTML = content.innerHTML);
            alert && (document.querySelector('.alert-overlay').innerHTML = alert.innerHTML);

            alert && setTimeout(function() {
                $(".alert").alert("close");
            }, 3000); // 3000ms = 3 seconds


        }
    </script>
</body>

</html>