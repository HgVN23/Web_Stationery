<!-- create_category.php -->
<div class="container">
    <h2>Tạo Mới Danh Mục</h2>
    <form action="<?php echo _WEB_ROOT ?>/tao-moi-danh-muc" method="POST">
        <div class="mb-3">
            <label for="categoryName" class="form-label">Tên Danh Mục</label>
            <input type="text" required class="form-control" id="categoryName" name="categoryName" required>
        </div>

        <div class="mb-3">
            <label for="categoryDescription" class="form-label">Mô Tả</label>
            <textarea class="form-control" required id="categoryDescription" name="categoryDescription" required></textarea>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="isFeatured" name="isFeatured">
            <label class="form-check-label" for="isFeatured">Danh Mục Nổi Bật</label>
        </div>

        <button type="submit" class="btn btn-primary">Tạo Mới</button>
    </form>
</div>