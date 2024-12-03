<div class="product-detail">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="row product-detail-top">
					<div class="col-md-5">
						<div class="product-slider-single">
							<img src="<?php echo _WEB_ROOT . $product['ImageURL'] ?>" alt="<?php echo $product['ProductName'] ?>">
						</div>
					</div>
					<div class="col-md-7">
						<div class="product-content">
							<div class="title">
								<h2><?php echo $product['ProductName'] ?></h2>
							</div>
							<!-- <div class="price"><?php echo number_format($product['UnitPrice'], 0, ',', '.') . ' đ' ?></div> -->
							<?php if ($product['PriceSale'] > 0) { ?>
								<span class="old-price me-2">
									<?php echo number_format($product['UnitPrice'], 0, ',', '.') . ' đ'; ?>
								</span>
								<span class="sale-price price">
									<?php echo number_format($product['PriceSale'], 0, ',', '.') . ' đ'; ?>
								</span>
							<?php } else { ?>
								<span class="normal-price price">
									<?php echo number_format($product['UnitPrice'], 0, ',', '.') . ' đ'; ?>
								</span>
							<?php } ?>
							<div class="details">
								<p>
									<?php echo $product['Description'] ?>
								</p>
							</div>

							<div class="quantity">
								<h4>Số lượng:</h4>
								<div class="qty">
									<button class="btn-change-qty btn-decrease"><i class="fa fa-minus"></i></button>
									<input class="input_quantity" type="text" value="1">
									<button class="btn-change-qty btn-increase"><i class="fa fa-plus"></i></button>
								</div>
							</div>
							<div class="action">
								<button type="button" data-pr-id="<?php echo $product['ID'] ?>" class="btn btn_addtocart"><i class="fa fa-cart-plus"></i></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>