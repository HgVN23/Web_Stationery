<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Chi Tiết Sản Phẩm</h4>
        </div>

        <div class="card-body">
            <div class="row">
                <!-- Tên Sản Phẩm -->
                <div class="col-md-6">
                    <p><strong>Tên Sản Phẩm:</strong></p>
                    <p id="productName" class="text-muted"><?php echo $product['ProductName'] ?></p>
                </div>

                <!-- Danh Mục -->
                <div class="col-md-6">
                    <p><strong>Danh Mục:</strong></p>
                    <p id="category" class="text-muted"><?php echo $product['CategoryName'] ?></p>
                </div>
            </div>

            <div class="row">
                <!-- Giá Gốc -->
                <div class="col-md-6">
                    <p><strong>Giá Gốc:</strong></p>
                    <p id="unitPrice" class="text-muted"><?php echo number_format($product['UnitPrice'], 0, ',', '.') ?>đ</p>
                </div>

                <!-- Giá Khuyến Mãi -->
                <div class="col-md-6">
                    <p><strong>Giá Khuyến Mãi:</strong></p>
                    <p id="priceSale" class="text-muted"><?php echo number_format($product['PriceSale'], 0, ',', '.') ?>đ</p>
                </div>
            </div>

            <!-- Mô Tả -->
            <p><strong>Mô Tả:</strong></p>
            <p id="description" class="text-muted"><?php echo $product['Description'] ?></p>

            <!-- Hình Ảnh -->
            <p><strong>Hình Ảnh:</strong></p>
            <div class="text-center">
                <img id="imageURL" src="<?php echo _WEB_ROOT . $product['ImageURL']  ?>" alt="Hình sản phẩm" class="img-fluid rounded shadow" style="max-width: 250px;">
            </div>

            <div class="row mt-3">
                <!-- Số Lượng Tồn Kho -->
                <div class="col-md-6">
                    <p><strong>Số Lượng Tồn Kho:</strong></p>
                    <p id="stockQuantity" class="text-muted"><?php echo $product['StockQuantity'] ?></p>
                </div>


                <!-- Sản Phẩm Nổi Bật -->
                <div class="col-md-3">
                    <p><strong>Sản Phẩm Nổi Bật:</strong></p>
                    <p id="isHot" class="badge <?php echo $product['IsHot'] ? 'bg-success' : 'bg-secondary'; ?>">
                        <?php echo $product['IsHot'] ? "Hàng hot" : "Bình thường"; ?>
                    </p>
                </div>
            </div>

            <!-- Nút Quay Lại -->
            <div class="text-right">
                <a href="<?php echo _WEB_ROOT  ?>/quan-ly-san-pham" class="btn btn-secondary">Quay Lại</a>
            </div>
        </div>
    </div>
</div>