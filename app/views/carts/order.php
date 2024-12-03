<style>
    .order-table td,
    .order-table th {
        vertical-align: middle;
    }

    .order-status {
        padding: 5px;
        border-radius: 5px;
        font-size: 14px;
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
<div class="container mt-5">
    <h3 class="mb-4 text-center">Danh Sách Đơn Hàng Của Bạn</h3>
    <!-- Table hiển thị danh sách đơn hàng -->
    <table class="table table-bordered order-table">
        <thead>
            <tr>
                <th>Mã Đơn Hàng</th>
                <th>Ngày Đặt Hàng</th>
                <th>Tổng Tiền</th>
                <th>Trạng Thái</th>
                <th>Chi Tiết</th>
            </tr>
        </thead>
        <tbody>

            <?php
            if (isset($myorder)) {
                $statusMap = [
                    'Completed' => 'completed',
                    'Cancelled' => 'cancelled',
                    'Pending' => 'pending',
                ];

                $arrstatus = array(
                    "Pending" => "Chờ xác nhận",
                    "Cancelled" => "Đã huỷ",
                    "Completed" => "Hoàn thành",
                );


                foreach ($myorder as $mo) {

                    $status = $statusMap[$mo['OrderStatus']];
            ?>

                    <tr>
                        <td><?php echo $mo['OrderCode'] ?></td>
                        <td><?php echo $mo['OrderDate'] ?></td>
                        <td><?php echo number_format($mo['TotalAmount'], 0, ',', '.') . ' đ'  ?></td>
                        <td><span class="order-status <?php echo $status ?>"><?php echo $arrstatus[$mo['OrderStatus']] ?></span></td>
                        <td><a href="<?php echo _WEB_ROOT ?>/chi-tiet-don-hang?orderCode=<?php echo $mo['OrderCode'] ?>" class="btn btn-info btn-sm">Xem chi tiết</a></td>
                    </tr>
            <?php
                }
            } else {
                echo ("Không có đơn hàng nào nha!");
            }
            ?>
            <!-- Bạn có thể thêm các đơn hàng khác -->
        </tbody>
    </table>
</div>