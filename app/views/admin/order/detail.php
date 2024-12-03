<?php
$arrstatus = array(
    "Pending" => "Chờ xác nhận",
    "Cancelled" => "Đã huỷ",
    "Completed" => "Hoàn thành",
);
$badgeClass = array(
    "Pending" => "bg-warning",
    "Cancelled" => "bg-danger",
    "Completed" => "bg-success"
);
?>

<div class="container mt-4">
    <h2 class="mb-3">Chi Tiết Đơn Hàng <span class="text-primary fw-bold"><?php echo $orderdetail[0]['OrderCode']; ?></span></h2>
    <!-- Thông tin khách hàng -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">Thông Tin Khách Hàng</div>
        <div class="card-body">
            <strong>Họ Tên:</strong> <?php echo $orderdetail[0]['CustomerName'] ?></p>
            <p><strong>Email:</strong> <?php echo $orderdetail[0]['Email'] ?></p>
            <p><strong>Số Điện Thoại:</strong> <?php echo $orderdetail[0]['Phone'] ?></p>
            <p><strong>Trạng Thái Đơn Hàng:</strong>
                <span class="badge 
                <?php echo $badgeClass[$orderdetail[0]['OrderStatus']] ?>">
                    <?php echo $arrstatus[$orderdetail[0]['OrderStatus']]  ?>
                </span>
            </p>
            <?php if ($orderdetail[0]['OrderStatus'] == 'Pending') : ?>
                <form method="POST" action="<?php echo _WEB_ROOT ?>/xac-nhan-don-hang">
                    <input type="hidden" name="OrderCode" value="<?php echo $orderdetail[0]['OrderCode']; ?>">
                    <button type="submit" class="btn btn-success">Xác Nhận Đơn Hàng</button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <!-- Địa chỉ giao hàng -->
    <div class="card mb-4">
        <div class="card-header bg-info text-white">Địa Chỉ Giao Hàng</div>
        <div class="card-body">
            <p><?php echo $orderdetail[0]['ShippingAddress'] ?></p>
        </div>
    </div>

    <!-- Danh sách sản phẩm -->
    <div class="card">
        <div class="card-header bg-success text-white">Sản Phẩm Mua</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-center">Hình ảnh</th>
                        <th class="text-center">Tên sản phẩm</th>
                        <th class="text-center">Giá gốc</th>
                        <th class="text-center">Số lượng</th>
                        <th class="text-center">Tổng giá</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($orderdetail as $index => $product) {

                        echo "<tr>
                                    <td class='text-center align-middle'>" . ($index + 1) . "</td>
                                    <td class='text-center'><img src=" . _WEB_ROOT . $product['ImageUrl'] . " alt='{$product['ProductName']}' class='img-thumbnail' width='100'></td>
                                    <td class='align-middle'>{$product['ProductName']}</td>
                                    <td class='text-center align-middle'>" . number_format($product['UnitPrice'], 0, ',', '.') . " đ</td>
                                    <td class='text-center align-middle'>{$product['Quantity']}</td>
                                    <td class='text-center align-middle'>" . number_format($product['Price'], 0, ',', '.') . " đ</td>
                                </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Nút quay lại -->
    <div class="mt-4">
        <a href="<?php echo _WEB_ROOT ?>/quan-ly-don-hang" class="btn btn-secondary">Quay Lại</a>
    </div>
</div>