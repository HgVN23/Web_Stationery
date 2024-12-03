<div class="container">
    <h2>Thêm Mới Sản Phẩm</h2>
    <form action="<?php echo _WEB_ROOT ?>/tao-moi-san-pham" method="POST" enctype="multipart/form-data">
        <!-- Danh Mục Sản Phẩm -->
        <div class="mb-3">
            <label for="categoryId" class="form-label">Danh Mục</label>
            <select class="form-control" id="categoryId" name="categoryId" required>
                <?php
                foreach ($categories as $category) {
                    echo "<option value='{$category['ID']}'>{$category['CategoryName']}</option>";
                }
                ?>
            </select>
        </div>

        <!-- Tên Sản Phẩm -->
        <div class="mb-3">
            <label for="productName" class="form-label">Tên Sản Phẩm</label>
            <input type="text" required class="form-control" id="productName" name="productName" required>
        </div>

        <!-- Giá Gốc -->
        <div class="mb-3">
            <label for="unitPrice" class="form-label">Giá Gốc</label>
            <input type="number" required class="form-control" id="unitPrice" name="unitPrice" min="0" required>
        </div>

        <!-- Giá Khuyến Mãi -->
        <div class="mb-3">
            <label for="priceSale" class="form-label">Giá Khuyến Mãi</label>
            <input type="number" class="form-control" id="priceSale" name="priceSale" min="0">
        </div>

        <!-- Mô Tả -->
        <div class="mb-3">
            <label for="description" class="form-label">Mô Tả</label>
            <textarea class="form-control" required id="description" name="description" required></textarea>
        </div>

        <!-- Hình Ảnh -->
        <div class="mb-3">
            <label for="imageURL" class="form-label">Hình Ảnh</label>
            <input type="file" class="form-control" id="imageURL" name="imageURL" required>
        </div>

        <!-- Số Lượng Tồn Kho -->
        <div class="mb-3">
            <label for="stockQuantity" class="form-label">Số Lượng Tồn Kho</label>
            <input type="number" required class="form-control" id="stockQuantity" name="stockQuantity" min="0" required>
        </div>

        <!-- Sản Phẩm Nổi Bật -->
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="isHot" name="isHot">
            <label class="form-check-label" for="isHot">Sản Phẩm Nổi Bật</label>
        </div>
        <div class="d-flex gap-2">
            <a class="btn btn-secondary" href="<?php echo _WEB_ROOT ?>/quan-ly-san-pham">Quay lại</a>
            <button type="submit" class="btn btn-primary">Thêm Mới</button>
        </div>
    </form>
</div>