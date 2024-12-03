<!-- phân trang -->
<div class="col-lg-12">
    <nav aria-label="Page navigation example">
        <ul id="pagination" class="pagination justify-content-center">
            <?php

            $page = $datapagination['currentpage'];
            $totalPages = $datapagination['totalPages'];
            $productcurrentpage = $datapagination['productcurrentpage'];
            // $url = _WEB_ROOT . "/home/listproducts";
            $url = _WEB_ROOT . "/danh-sach-san-pham";

            // Tạo chuỗi query string cho các tham số khác
            $queryParams = $datapagination['queryparams'] ?? [];

            // Thêm query string vào URL
            $queryString = http_build_query($queryParams);
            $url .= !empty($queryString) ? '?' . $queryString . '&' : '?';



            if ($totalPages > 1) {


                // Hiển thị trang đầu và trang thứ hai
                if ($page > 2) {
                    echo '<li class="page-item"><a class="page-link" href="' . htmlspecialchars($url) . 'page=1">1</a></li>';
                    if ($page > 3) {
                        echo '<li class="page-item"><a class="page-link" href="' . htmlspecialchars($url) . 'page=2">2</a></li>';
                        echo '<li class="page-item disabled"><a class="page-link">...</a></li>';
                    }
                }
                for ($i = max(1, $page - 1); $i <= min($totalPages, $page + 1); $i++) {
                    if ($i == $page) {
                        echo '<li class="page-item active"><a class="page-link">' . $i . '</a></li>';
                    } else {
                        echo '<li class="page-item"><a class="page-link" href="' . htmlspecialchars($url) . 'page=' . $i . '">' . $i . '</a></li>';
                    }
                }

                // Hiển thị trang cuối và trang kế cuối
                if ($page < $totalPages - 1) {
                    echo '<li class="page-item disabled"><a class="page-link">...</a></li>';
                    if ($page <= $totalPages - 2) {
                        echo '<li class="page-item"><a class="page-link" href="' . htmlspecialchars($url) . 'page=' . $totalPages . '">' . $totalPages . '</a></li>';
                    }
                }
            }
            ?>

        </ul>
    </nav>
</div>
<!-- phân trang -->