<section class="content-section bg-light rounded shadow p-4">
    <h2 class="text-primary">Chào mừng đến với trang quản trị!</h2>

    <div class="row mt-4 home-admin">

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Danh Mục</h5>
                    <p class="card-text">Quản lý <?php echo $numbercategory ?> danh mục</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Sản Phẩm</h5>
                    <p class="card-text">Quản lý <?php echo $numberproduct ?> sản phẩm</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Đơn Hàng</h5>
                    <p class="card-text">Có <?php echo $numberorder ?> đơn hàng đang xử lý</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Người Dùng</h5>
                    <p class="card-text"><?php echo $numberuser ?> người dùng đã đăng ký</p>
                </div>
            </div>
        </div>

    </div>
    <div class="row mt-4 home-admin">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Liên Hệ</h5>
                    <p class="card-text"><?php echo $numbercontact ?> người đã gửi phản hồi</p>
                </div>
            </div>
        </div>
    </div>
</section>