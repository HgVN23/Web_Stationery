<div class="container">
    <h2>Xác nhận xoá sản Phẩm</h2>
    <div class="product-info">
        <p><strong>Tên sản phẩm:</strong> <?= htmlspecialchars($product['ProductName']) ?></p>
        <p><strong>Giá:</strong> <?= number_format($product['UnitPrice'], 0, ',', '.') ?> đ</p>
    </div>

    <form method="POST" action="<?php echo _WEB_ROOT ?>/xoa-san-pham">
        <div class="d-flex gap-2">
            <input type="hidden" name="product_id" value="<?php echo $product['ID'] ?>" />
            <button type="submit" class="btn btn-danger">Xóa</button>
            <a class="btn btn-secondary" href="<?php echo _WEB_ROOT ?>/quan-ly-san-pham">Quay lại</a>

        </div>
    </form>
</div>