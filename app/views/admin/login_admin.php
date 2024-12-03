<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow" style="width: 100%; max-width: 400px;">
        <div class="card-header bg-primary text-white text-center">
            <h3>Đăng Nhập</h3>
        </div>
        <div class="card-body">
            <!-- Form đăng nhập -->
            <form action="<?php echo _WEB_ROOT ?>/dang-nhap-admin" method="POST">
                <div class="mb-3">
                    <label for="text" class="form-label">Tên đăng nhập</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mật Khẩu</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Đăng Nhập</button>
            </form>
        </div>
    </div>
</div>