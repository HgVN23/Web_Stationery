<style>
    th {
        text-align: center;
    }
    th:nth-child(1),
    td:nth-child(1) {
        width: 5%;
        /* STT */
        text-align: center;
    }

    th:nth-child(2),
    td:nth-child(2) {
        width: 15%;
        /* Mã đơn hàng */
    }

    th:nth-child(3),
    td:nth-child(3) {
        width: 20%;
        /* Khách hàng */
    }

    th:nth-child(4),
    td:nth-child(4) {
        width: 20%;
        /* Ngày đặt */
    }

    th:nth-child(5),
    td:nth-child(5) {
        width: 10%;
        /* Trạng thái */
    }

    th:nth-child(6),
    td:nth-child(6) {
        width: 15%;
        /* Tổng tiền */
    }
    td:nth-child(6) {
        text-align: right;
    }

    th:nth-child(7),
    td:nth-child(7) {
        width: 15%;
        /* Hành động */
    }
</style>


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
<div class="admin-container">
    <h2>Quản lý đơn hàng</h2>
    <div class="d-flex justify-content-between">
        <form action="<?php echo _WEB_ROOT ?>/quan-ly-don-hang" method="GET">
            <div class="input-group">
                <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm sản phẩm" value="<?php if(isset($_GET["keyword"])) echo $_GET["keyword"] ?>">
                <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
            </div>
        </form>
    </div>
    <table class="table table-striped table-bordered">
        <thead class="table-primary">
            <tr>
                <th>STT</th>
                <th>Mã đơn hàng</th>
                <th>Khách Hàng</th>
                <th>Ngày Đặt</th>
                <th>Trạng Thái</th>
                <th>Tổng Tiền</th>
                <th class="text-center">Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $datamodel = $datapagination['datamodel'];
            if (isset($datamodel) && !empty($datamodel)) {
                $currentPage = $datapagination['currentpage'];
                $limit = $datapagination['limit'];
                $index = ($currentPage - 1) * $limit;
                foreach ($datamodel as $item) {
                    $statusText = $arrstatus[$item['OrderStatus']];
                    $statusClass = $badgeClass[$item['OrderStatus']];
                    echo "<tr>
                            <td>" . ++$index . "</td>
                            <td>{$item['OrderCode']}</td>
                            <td>{$item['CustomerName']}</td>
                            <td>{$item['OrderDate']}</td>
                            <td><span class='badge $statusClass'>$statusText</span></td>
                            <td>" . number_format($item['TotalAmount'], 0, ',', '.') . " đ</td>
                            <td class='text-center'>
                               <a class='btn btn-info' href='" . _WEB_ROOT . "/xem-chi-tiet-don-hang?ordercode={$item['OrderCode']}'>Chi tiết</a>
                            </td>
                        </tr>";
                }
            }
            ?>
        </tbody>
    </table>
</div>
<!-- phân trang -->
<div class="pagination-container">
    <?php include _DIR_ROOT . '/app/views/layouts/pagination_admin.php'; ?>
</div>
<!-- phân trang -->