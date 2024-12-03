<style>
    h3,
    h4 {
        color: #007bff;
    }

    .order-header {
        border-bottom: 2px solid #007bff;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    .order-items th,
    .order-items td {
        vertical-align: middle;
    }

    .order-items thead {
        background-color: #007bff;
        color: white;
    }

    .total-payment p {
        font-size: 1.2rem;
        font-weight: bold;
        color: #007bff;
    }

    .action-buttons .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .action-buttons .btn-primary:hover {
        background-color: #0056b3;
    }

    .product-image {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 4px;
    }

    .pending {
        background-color: #d8ad00;
        color: white;
    }

    .completed {
        background-color: #28a745;
        color: white;
    }

    .cancelled {
        background-color: #dc3545;
        color: white;
    }
</style>

<?php
$statusMap = [
    'Completed' => 'badge-success',
    'Cancelled' => 'badge-danger',
    'Pending' => 'badge-warning',
];

$arrstatus = array(
    "Pending" => "Chờ xác nhận",
    "Cancelled" => "Đã huỷ",
    "Completed" => "Hoàn thành",
);
?>
<!-- Main Content -->
<div class="container mt-5 p-4">
    <div class="order-header mb-4 text-center">
        <h3>Chi Tiết Đơn Hàng: <?php echo $myorder['OrderCode'] ?></h3>
        <p><strong>Ngày đặt hàng:</strong> <?php echo $myorder['OrderDate'] ?></p>
        <p><strong>Trạng thái đơn hàng:</strong> <span class="p-2 badge <?php echo $statusMap[$myorder['OrderStatus']] . ' ' . lcfirst($myorder['OrderStatus']) ?>"><?php echo $arrstatus[$myorder['OrderStatus']]  ?></span></p>

    </div>

    <h4>Thông tin khách hàng</h4>
    <div class="row mb-4">
        <div class="col-md-6">
            <p><strong>Tên khách hàng:</strong> <?php echo $customerinfo['CustomerName'] ?></p>
            <p><strong>Email:</strong> <?php echo $customerinfo['Email'] ?></p>
            <p><strong>Số điện thoại:</strong> <?php echo $customerinfo['Phone'] ?></p>
        </div>
        <div class="col-md-6">
            <p><strong>Địa chỉ giao hàng:</strong> <?php echo $myorder['ShippingAddress'] ?></p>
        </div>
    </div>

    <h4>Danh sách sản phẩm</h4>
    <table class="table table-striped table-bordered order-items">
        <thead>
            <tr>
                <th>STT</th>
                <th>Hình ảnh</th>
                <th>Tên sản phẩm</th>
                <th class="text-center">Số lượng</th>
                <th class="text-end">Giá</th>
                <th class="text-end">Tổng</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($myorder_detail as $detail) {
            ?>
                <tr>
                    <td>1</td>
                    <td><img src="<?php echo _WEB_ROOT . "/" . $detail['ImageUrl'] ?>" alt="Kẹp giấy tam giác C62" class="product-image"></td>
                    <td><?php echo $detail['ProductName'] ?></td>
                    <td class="text-center"><?php echo $detail['Quantity'] ?></td>
                    <td class="text-end"><?php echo number_format($detail['UnitPrice'], 0, ',', '.') . ' đ'  ?></td>
                    <td class="text-end"><?php echo number_format($detail['Price'], 0, ',', '.') . ' đ'  ?></td>
                </tr>

            <?php
            }
            ?>
        </tbody>
    </table>

    <div class="total-payment text-end mt-4">
        <p>Tổng sản phẩm: <?php echo count($myorder_detail) ?> sản phẩm</p>
        <p>Tổng tiền: <?php echo number_format($myorder['TotalAmount'], 0, ',', '.') . ' đ' ?></p>
    </div>

    <div class="action-buttons mt-4 d-flex justify-content-between">
        <a href="<?php echo _WEB_ROOT . '/don-hang' ?>" class="btn btn-secondary">Quay lại</a>
        <?php if ($myorder['OrderStatus'] == 'Pending') {
            echo ("<a href='" . _WEB_ROOT . "/chi-tiet-don-hang?orderCode=" . $myorder['OrderCode'] . "&cancelorder' class='btn btn-primary'>Huỷ đơn hàng</a>");
        } ?>

    </div>
</div>