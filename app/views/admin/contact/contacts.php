<style>
    th:nth-child(1),
    td:nth-child(1) {
        width: 5%;

    }

    th:nth-child(2),
    td:nth-child(2) {
        width: 20%;

    }

    th:nth-child(3),
    td:nth-child(3) {
        width: 25%;

    }

    th:nth-child(4),
    td:nth-child(4) {
        width: 15%;

    }

    th:nth-child(5),
    td:nth-child(5) {
        width: 10%;

    }

    th:nth-child(6),
    td:nth-child(6) {
        width: 15%;

    }
</style>

<div class="admin-container">
    <div class="container mt-4">
        <h2 class="mb-3">Quản Lý Liên Hệ</h2>

        <table class="table table-striped table-bordered">
            <thead class="table-primary">
                <tr>
                    <th class="text-center">STT</th>
                    <th>Tên Khách Hàng</th>
                    <th>Email</th>
                    <th>Thời gian gửi</th>
                    <th class="text-center">Trạng Thái</th>
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
                    foreach ($datamodel as $contact) {
                        echo "<tr>
                        <td class='text-center'>" . ++$index . "</td>
                        <td>{$contact['CustomerName']}</td>
                        <td>{$contact['Email']}</td>
                        <td>" .  date('d-m-Y H:i:s', strtotime($contact['ContactDate'])) . "</td>
                        <td class='text-center'>
                            <span class='badge " . ($contact['IsReplied'] ? 'bg-success' : 'bg-danger') . "'>
                                " . ($contact['IsReplied'] ? 'Đã xem' : 'Chưa đọc') . "
                            </span>
                        </td>
                        <td class='text-center'>
                            <a href='" . _WEB_ROOT . "/chi-tiet-lien-he?contactid={$contact['ID']}' class='btn btn-info btn-sm'>Xem</a>
                            <a href='" . _WEB_ROOT . "/xoa-lien-he?contactid={$contact['ID']}' class='btn btn-danger btn-sm'>Xóa</a>
                        </td>
                    </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- phân trang -->
<div class="pagination-container">
    <?php include _DIR_ROOT . '/app/views/layouts/pagination_admin.php'; ?>
</div>
<!-- phân trang -->