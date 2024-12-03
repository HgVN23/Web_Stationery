<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0">Xác Nhận Xóa Liên Hệ</h4>
                </div>
                <div class="card-body">
                    <p>Bạn có chắc chắn muốn xóa liên hệ của <strong><?php echo htmlspecialchars($detailcontact['CustomerName']); ?></strong>?</p>
                    <p>Email: <strong><?php echo htmlspecialchars($detailcontact['Email']); ?></strong></p>
                    <p>Ngày Gửi: <strong><?php echo date('d-m-Y H:i:s', strtotime($detailcontact['ContactDate'])); ?></strong></p>

                    <div class="mt-4">
                        <form action="<?php echo _WEB_ROOT ?>/xoa-lien-he" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa liên hệ này?');">
                            <input type="hidden" name="contactid" value="<?php echo $detailcontact['ID']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                            <a href="<?php echo _WEB_ROOT  ?>/quan-ly-lien-he" class="btn btn-secondary btn-sm">
                                Hủy
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>