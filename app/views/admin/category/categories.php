<style>
    th {
        text-align: center;
    }
    /* Cố định chiều rộng các cột */
    th:nth-child(1),
    td:nth-child(1) {
        width: 10%;
        text-align: center;
        /* Chiều rộng cột ID */
    }

    th:nth-child(2),
    td:nth-child(2) {
        width: 40%;
        /* Chiều rộng cột Tên Danh Mục */
    }

    th:nth-child(3),
    td:nth-child(3) {
        text-align: center;
        width: 20%;
        /* Chiều rộng cột Nổi bật */
    }

    th:nth-child(4),
    td:nth-child(4) {
        text-align: center;
        width: 30%;
        /* Chiều rộng cột Hành Động */
    }
</style>

<div class="admin-container">
    <h2>Quản Lý Danh Mục</h2>
    <div class="d-flex justify-content-between">
        <form action="<?php echo _WEB_ROOT ?>/quan-ly-danh-muc" method="GET">
            <div class="input-group">
                <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm danh mục" value="<?php if(isset($_GET["keyword"])) echo $_GET["keyword"] ?>">
                <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
            </div>
        </form>

        <a class="btn btn-primary" href="<?php echo _WEB_ROOT ?>/tao-moi-danh-muc">Thêm Danh Mục</a>
    </div>
    <table class="table table-striped table-bordered">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Tên Danh Mục</th>
                <th>Nổi bật</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $datamodel = $datapagination['datamodel'];
            if (isset($datamodel) && !empty($datamodel)) {
                foreach ($datamodel as $category) {
                    echo "<tr>
                            <td>{$category['ID']}</td>
                            <td>{$category['CategoryName']}</td>
                            <td>";
                    if ($category['IsFeature'] == 1) {
                        echo "<input  class='feature-checkbox'  type='checkbox' checked data-categoryid='{$category['ID']}'>"; // Checkbox được chọn (disabled) với data-categoryid
                    } else {
                        echo "<input class='feature-checkbox' type='checkbox' data-categoryid='{$category['ID']}'>"; // Checkbox không được chọn (disabled) với data-categoryid
                    }

                    echo "</td>
                            <td>
                                <a class='btn btn-warning' href='" . _WEB_ROOT . "/sua-danh-muc?categoryid={$category['ID']}'>Sửa</a>
                                <a class='btn btn-danger'  href='" . _WEB_ROOT . "/xoa-danh-muc?categoryid={$category['ID']}'>Xóa</a>
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