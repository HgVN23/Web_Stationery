<div class="container">
    <h2>Chỉnh Sửa Sản Phẩm</h2>
    <form action="<?php echo _WEB_ROOT ?>/chinh-sua-san-pham" method="POST" enctype="multipart/form-data">
        <!-- Danh Mục Sản Phẩm -->
        <div class="mb-3">
            <label for="categoryId" class="form-label">Danh Mục</label>
            <select class="form-control" id="categoryId" name="categoryId" required>
                <?php
                foreach ($categories as $category) {
                    // Kiểm tra nếu danh mục hiện tại đã được chọn
                    $selected = $category['ID'] == $product['CategoryId'] ? 'selected' : '';
                    echo "<option value='{$category['ID']}' {$selected}>{$category['CategoryName']}</option>";
                }
                ?>
            </select>
        </div>
        <input type="hidden" value="<?php echo $product['ID']; ?>" class="form-control" id="productid" name="productid">

        <!-- Tên Sản Phẩm -->
        <div class="mb-3">
            <label for="productName" class="form-label">Tên Sản Phẩm</label>
            <input type="text" value="<?php echo $product['ProductName']; ?>" class="form-control" id="productName" name="productName" required>
        </div>

        <!-- Giá Gốc -->
        <div class="mb-3">
            <label for="unitPrice" class="form-label">Giá Gốc</label>
            <input type="number" value="<?php echo $product['UnitPrice']; ?>" class="form-control" id="unitPrice" name="unitPrice" min="0" required>
        </div>

        <!-- Giá Khuyến Mãi -->
        <div class="mb-3">
            <label for="priceSale" class="form-label">Giá Khuyến Mãi</label>
            <input type="number" value="<?php echo $product['PriceSale']; ?>" class="form-control" id="priceSale" name="priceSale" min="0">
        </div>

        <!-- Mô Tả -->
        <div class="mb-3">
            <label for="description" class="form-label">Mô Tả</label>
            <textarea class="form-control" required id="description" name="description" required><?php echo $product['Description']; ?></textarea>
        </div>

        <!-- Hình Ảnh -->
        <div class="mb-3">
            <label for="imageURL" class="form-label">Hình Ảnh</label>
            <input type="file" class="form-control" id="imageURL" name="imageURL">
            <!-- Hiển thị ảnh hiện tại nếu có -->
            <?php if (!empty($product['ImageURL'])) { ?>
                <div class="mt-2">
                    <img src="<?php echo _WEB_ROOT . $product['ImageURL']; ?>" alt="Product Image" style="max-width: 150px; max-height: 150px;">
                </div>
            <?php } ?>
        </div>

        <!-- Số Lượng Tồn Kho -->
        <div class="mb-3">
            <label for="stockQuantity" class="form-label">Số Lượng Tồn Kho</label>
            <input type="number" value="<?php echo $product['StockQuantity']; ?>" required class="form-control" id="stockQuantity" name="stockQuantity" min="0" required>
        </div>
        <!-- Sản Phẩm Nổi Bật -->
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="isHot" name="isHot" <?php echo $product['IsHot'] ? 'checked' : ''; ?>>
            <label class="form-check-label" for="isHot">Sản Phẩm Nổi Bật</label>
        </div>

        <div class="d-flex gap-2">
            <a class="btn btn-secondary" href="<?php echo _WEB_ROOT ?>/quan-ly-san-pham">Quay lại</a>
            <button type="submit" class="btn btn-primary">Cập Nhật</button>
        </div>
    </form>
</div>