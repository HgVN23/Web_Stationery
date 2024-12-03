<div class="container my-5">
    <!-- Tiêu đề trang -->
    <h2 class="mb-4">Chi Tiết Liên Hệ</h2>

    <!-- Card hiển thị thông tin liên hệ -->
    <div class="card">
        <div class="card-header bg-primary text-white">
            <i class="fas fa-envelope"></i> Thông Tin Liên Hệ
        </div>
        <div class="card-body">
            <!-- Thông tin khách hàng -->
            <div class="mb-3">
                <strong>Họ Tên:</strong> <?php echo $detailcontact['CustomerName']; ?>
            </div>
            <div class="mb-3">
                <strong>Email:</strong> <?php echo $detailcontact['Email']; ?>
            </div>
            <!-- Nội dung liên hệ -->
            <div class="mb-3">
                <strong>Nội Dung:</strong>
                <p><?php echo nl2br($detailcontact['Message']); ?></p>
            </div>

            <!-- Ngày gửi -->
            <div class="mb-3">
                <strong>Ngày Gửi:</strong>
                <?php echo $detailcontact['ContactDate']; ?>
            </div>

            <!-- Trạng thái liên hệ -->
            <div class="mb-3">
                <strong>Trạng Thái:</strong>
                <span class="badge <?php echo $detailcontact['IsReplied'] ? 'bg-success' : 'bg-danger'; ?>">
                    <?php echo $detailcontact['IsReplied'] ? 'Đã xem' : 'Chưa đọc'; ?>
                </span>
            </div>

            <div class="d-flex gap-2">
                <!-- Hành động xử lý -->
                <?php if (!$detailcontact['IsReplied']) { ?>
                    <a href="<?php echo _WEB_ROOT ?>/cap-nhat-trang-thai-lien-he?contactid=<?php echo $detailcontact['ID']; ?>" class="btn btn-success">
                        <i class="fas fa-reply"></i> Xác Nhận Đã Xem
                    </a>
                <?php } ?>
                <a href="<?php echo _WEB_ROOT  ?>/quan-ly-lien-he" class="btn btn-secondary">Quay Lại</a>

            </div>
        </div>
    </div>
</div>