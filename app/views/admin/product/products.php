<style type="text/css">
    th {
        text-align: center;
    }
    /* Cố định chiều rộng các cột */
    td:nth-child(1),
    td:nth-child(4) {
        text-align: center;
        /* Chiều rộng cột ID */
    }
    td:nth-child(6),
    td:nth-child(5) {
        text-align: right;
    }
</style>

<div class="admin-container">
    <h2>Quản Lý Sản phẩm</h2>
    <div class="d-flex justify-content-between">
        <form action="<?php echo _WEB_ROOT ?>/quan-ly-san-pham" method="GET">
            <div class="input-group">
                <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm sản phẩm" value="<?php if(isset($_GET["keyword"])) echo $_GET["keyword"] ?>">
                <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
            </div>
        </form>

        <a class="btn btn-primary" href="<?php echo _WEB_ROOT ?>/tao-moi-san-pham">Thêm Sản Phẩm</a>
    </div>
    <table class="table table-striped table-bordered">
        <thead class="table-primary">
            <tr>
                <th>STT</th>
                <th>Ảnh</th>
                <th>Tên Sản Phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Giá khuyến mãi</th>
                <th class="text-center">Mới</th>
                <th>Hành Động</th>
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
                    echo "<tr>
                             <td>" . (++$index) . "</td>
                            <td><img src='" . _WEB_ROOT . "/{$item['ImageURL']}' alt='Product Image' width='50'></td>
                            <td>{$item['ProductName']}</td>
                            <td>{$item['StockQuantity']}</td>
                            <td>" . number_format($item['UnitPrice'], 0, ',', '.') . " đ</td>
                            <td>" . number_format($item['PriceSale'], 0, ',', '.') . " đ</td>
                            <td class='text-center'>";

                    if ($item['IsHot'] == 1) {
                        echo "<input class='hot-checkbox' type='checkbox' data-productid='{$item['ID']}' checked >";
                    } else {
                        echo "<input class='hot-checkbox' type='checkbox' data-productid='{$item['ID']}' >";
                    }
                    echo "</td>
                            <td class='d-flex gap-2'>
                                <a class='btn btn-info' href='" . _WEB_ROOT . "/chi-tiet-san-pham?productid={$item['ID']}'>Chi tiết</a>
                                <a class='btn btn-warning' href='" . _WEB_ROOT . "/chinh-sua-san-pham?productid={$item['ID']}'>Sửa</a>
                                <a class='btn btn-danger' href='" . _WEB_ROOT . "/xoa-san-pham?productid={$item['ID']}'>Xóa</a>
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