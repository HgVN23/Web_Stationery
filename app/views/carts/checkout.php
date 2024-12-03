<div class="checkout">
	<div class="container">
		<div class="row">
			<div class="col-5">
				<div class="billing-address">
					<h2>Hóa đơn</h2>
					<div class="row">
						<div class="col-6">
							<label>Tên tài khoản</label>
							<input class="form-control" type="text" value="<?php echo $customerinfo['CustomerName'] ?>" disabled>
						</div>
						<div class="col-6">
							<label>Số điện thoại</label>
							<input class="form-control" type="text" value="<?php echo $customerinfo['Phone'] ?>" disabled>
						</div>
						<div class="col-12">
							<label>Email</label>
							<input class="form-control" type="email" value="<?php echo $customerinfo['Email'] ?>" disabled>
						</div>
						<div class="col-12">
							<label>Địa chỉ</label>
							<input class="form-control" type="text" value="<?php echo $customerinfo['Address'] ?>" disabled>
						</div>
					</div>
				</div>

				<div class="checkout-payment">
					<div class="checkout-btn d-flex justify-content-between align-items-center">
						<button class="btn_checkout btn_custom" id="btn_checkout">Đặt hàng</button>
						<a href="<?php echo _WEB_ROOT ?>/thanh-toan?cancle_checkout=true" class="btn_custom btn_cancle_checkout">Huỷ</a>
					</div>
				</div>
			</div>

			<div class="col-7 content-checkout">
				<?php
				if (isset($_SESSION['data_cart_to_checkout'])) {
				?>
					<div class="checkout-summary">
						<div class="d-flex justify-content-between align-items-center">
							<h2>Giỏ hàng</h2>

						</div>

						<div class="checkout-content">
							<h3>Các sản phẩm</h3>
							<?php
							$data_cart_to_checkout = $_SESSION['data_cart_to_checkout'];
							$cartItems = $data_cart_to_checkout['filteredCart'];
							$toltalcartitems = $data_cart_to_checkout['toltalcartitems'];
							foreach ($cartItems as $item) {
							?>
								<p><?php echo $item['ProductName'] ?><span><?php echo number_format($item['Quantity'] * $item['Price'], 0, ',', '.') . ' đ'  ?></span></p>
							<?php
							}
							?>
							<h4>Thành tiền<span><?php echo number_format($toltalcartitems, 0, ',', '.') . ' đ'  ?></span></h4>


						</div>
					</div>
				<?php
				} else {
					echo "<div class='alert alert-danger' role='alert'>Chưa có sản phẩm nào!</div>";
				}
				?>

			</div>
		</div>
	</div>
</div>