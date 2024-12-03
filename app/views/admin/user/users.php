<div class="admin-container">
    <h2>Quản lý tài khoản khách hàng</h2>
    <div class="d-flex justify-content-between">
        <form action="<?php echo _WEB_ROOT ?>/quan-ly-tai-khoan" method="GET">
            <div class="input-group">
                <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm sản phẩm" value="<?php if(isset($_GET["keyword"])) echo $_GET["keyword"] ?>">
                <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
            </div>
        </form>
    </div>
    <table class="table table-striped table-bordered">
        <thead class="table-primary">
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Tên đăng nhập</th>
                <th class="text-center">Họ và tên</th>
                <th class="text-center">Email</th>
                <th class="text-center">Số điện thoại</th>
                <th class="text-center">Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                $datamodel = $datapagination['datamodel'];
                if (isset($datamodel) && !empty($datamodel)) {
                    $currentPage = $datapagination['currentpage'];
                    $limit = $datapagination['limit'];
                    $index = ($currentPage - 1) * $limit;
                    foreach ($datamodel as $item) {
                        ++$index;
                        echo "<tr>
                                <td class='text-center'>{$index}</td>
                                <td>{$item['Username']}</td>
                                <td>{$item['CustomerName']}</td>
                                <td>{$item['Email']}</td>
                                <td>{$item['Phone']}</td>
                                <td class='text-center'>
                                   <a class='btn btn-info' href='" . _WEB_ROOT . "/chi-tiet-tai-khoan-khach-hang?userid={$item['user_id']}'>Chi tiết</a>
                                </td>
                            </tr>";
                    }
                } ?>

            </tr>
        </tbody>
    </table>
</div>
<!-- phân trang -->
<div class="pagination-container">
    <?php include _DIR_ROOT . '/app/views/layouts/pagination_admin.php'; ?>
</div>
<!-- phân trang -->