<div class="cart-page" id='cart-page'>
	<div class="container" id="card-container">
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead class="thead-dark">
							<tr>
								<th>Hình ảnh</th>
								<th>Tên sản phẩm</th>
								<th>Đơn giá</th>
								<th>Số lượng</th>
								<th>Tổng giá</th>
								<th>Loại bỏ</th>
							</tr>
						</thead>
						<tbody class="align-middle">
							<?php if (!empty($cartitems)) {
								foreach ($cartitems as $item) { ?>
									<tr>
										<td><a href="#"><img src="<?php echo _WEB_ROOT . $item['ImageURL'] ?>" alt="Image"></a></td>
										<td><a href="#"><?php echo $item['ProductName'] ?></a></td>
										<td><?php echo number_format($item['Price'], 0, ',', '.') . ' đ' ?></td>
										<td>
											<div class="qty">
												<button class='btn-change-qty btn-decrease' data-item-id="<?php echo $item['ID']; ?>"><i class="fa fa-minus"></i></button>
												<input type="text" name="quantity" data-item-id="<?php echo $item['ID']; ?>" value="<?php echo $item['Quantity'] ?>">
												<button class='btn-change-qty btn-increase' data-item-id="<?php echo $item['ID']; ?>"><i class="fa fa-plus"></i></button>
											</div>
										</td>
										<td class="colum_totalPrice"><?php echo number_format($item['Price'] * $item['Quantity'], 0, ',', '.') . ' đ' ?></td>
										<td><button data-item-id="<?php echo $item['ID']; ?>" class="btn-delete_cart-item"><i class="fa fa-trash"></i></button></td>
									</tr>
							<?php
								}
							}
							?>

						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6"></div>
			<div class="col-md-6">
				<div class="cart-summary">
					<div class="cart-content cart_content--ft">
						<h3>Giỏ hàng</h3>
						<div class="items">
							<?php if (!empty($cartitems)) {
								foreach ($cartitems as $item) { ?>
									<p><?php echo $item['ProductName'] . ' &nbsp; x &nbsp; ' . $item['Quantity'] ?><span><?php echo number_format($item['Price'] * $item['Quantity'], 0, ',', '.') . ' đ'  ?></span></p>
							<?php
								}
							}
							?>
						</div>

						<h4>Thành tiền <span class="totalAmount"><?php echo number_format($totalAmount, 0, ',', '.') . ' đ' ?></span></h4>
					</div>
					<div class="cart-btn">
						<button class="btn_to_checkout"><a href="<?php echo _WEB_ROOT ?>/thanh-toan">Thanh toán</a></button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>