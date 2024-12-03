<h2 class="mb-4">Chi Tiết Tài Khoản Khách Hàng</h2>

<!-- Thông tin khách hàng -->
<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        Thông Tin Khách Hàng
    </div>
    <div class="card-body">
        <p><strong>Trạng Thái:</strong>
            <?php
            if ($detailusercustomer['IsActive'] == 1) {
                echo '<span class="badge bg-success">Hoạt Động</span>';
            } else {
                echo '<span class="badge bg-danger">Khóa</span>';
            }
            ?>
        </p>
        <p><strong>Tên người dùng:</strong> <?php echo $detailusercustomer['Username']; ?></p>
        <p><strong>Họ Tên:</strong> <?php echo $detailusercustomer['CustomerName']; ?></p>
        <p><strong>Email:</strong> <?php echo $detailusercustomer['Email']; ?></p>
        <p><strong>Số Điện Thoại:</strong> <?php echo $detailusercustomer['Phone']; ?></p>
        <p><strong>Địa Chỉ:</strong> <?php echo $detailusercustomer['Address']; ?></p>
    </div>
</div>
<div class="d-flex gap-2">
    <?php
    if ($detailusercustomer['IsActive'] == 1) {


    ?>
        <div class="mt-4">
            <form action="<?php echo _WEB_ROOT ?>/khoa-tai-khoan" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn khóa tài khoản này không?');">
                <input type="hidden" name="user_id" value="<?php echo $detailusercustomer['user_id']; ?>" />
                <button type="submit" name="lock" class="btn btn-danger">Khóa Tài Khoản</button>
            </form>
        </div>
    <?php
    } else {
    ?>
        <div class="mt-4">
            <form action="<?php echo _WEB_ROOT ?>/mo-khoa-tai-khoan" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn mở khóa tài khoản này không?');">
                <input type="hidden" name="user_id" value="<?php echo $detailusercustomer['user_id']; ?>" />
                <button type="submit" name="unlock" class="btn btn-danger">Mở Khoá Tài Khoản</button>
            </form>
        </div>
    <?php
    }

    ?>

    <!-- Nút Quay Lại -->
    <div class="mt-4">
        <a href="<?php echo _WEB_ROOT ?>/quan-ly-tai-khoan" class="btn btn-secondary">Quay Lại</a>
    </div>
</div>