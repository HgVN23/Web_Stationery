<div class="container">
    <h2>Xóa Danh Mục</h2>
    <p>Bạn có chắc chắn muốn xóa danh mục <strong><?php echo $currentcategory['CategoryName'] ?></strong></p>

    <form action="<?php echo _WEB_ROOT ?>/xoa-danh-muc" method="POST">
        <input type="hidden" name="categoryID" value="<?php echo $currentcategory['ID'] ?>">
        <button type="submit" class="btn btn-danger">Xóa</button>
        <a href="<?php echo _WEB_ROOT ?>/quan-ly-danh-muc" class="btn btn-secondary">Quay lại</a>
    </form>
</div>