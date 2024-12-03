<!-- edit_category.php -->
<div class="container">
    <h2>Sửa Danh Mục</h2>

    <form action="<?php echo _WEB_ROOT ?>/sua-danh-muc" method="POST">
        <input type="hidden" name="categoryID" value="<?php echo $currentcategory['ID']; ?>">

        <div class="mb-3">
            <label for="categoryName" class="form-label">Tên Danh Mục</label>
            <input type="text" class="form-control" id="categoryName" name="categoryName" value="<?php echo $currentcategory['CategoryName']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="categoryDescription" class="form-label">Mô Tả</label>
            <textarea class="form-control" id="categoryDescription" name="categoryDescription" required><?php echo $currentcategory['Description']; ?></textarea>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="isFeatured" name="isFeatured" <?php echo $currentcategory['IsFeature'] == 1 ? 'checked' : ''; ?>>
            <label class="form-check-label" for="isFeatured">Danh Mục Nổi Bật</label>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Cập Nhật</button>
            <a href="<?php echo _WEB_ROOT  ?>/quan-ly-danh-muc" class="btn btn-secondary">
                Quay lại
            </a>
        </div>
    </form>
</div>