<div class="product-view">
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<div class="row">
					<div class="col-lg-12">
						<div class="row">
							<div class="col-md-8">
								<div class="product-search">
									<form action="" method="get">
										<input name="search" type="text" placeholder="Tìm kiếm sản phẩm..." value="<?php if(isset($_GET["search"])) echo $_GET["search"] ?>">
										<button><i class="fa fa-search"></i></button>
									</form>
								</div>
							</div>
							<div class="col-md-4">
								<form method="GET" action="" class="form-inline" id="sortForm">
									<input type="hidden" name="url" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
									<div class="form-group mb-0 me-2">
										<select class="form-control" name="sort" id="sortSelect" style="cursor: pointer;">
											<option value="">Sắp xếp</option>
											<option value="asc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'asc') echo 'selected'; ?>>Tăng dần theo giá</option>
											<option value="desc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'desc') echo 'selected'; ?>>Giảm dần theo giá</option>
										</select>
									</div>
								</form>

							</div>
						</div>
					</div>

					<div class="row" id="product-container">
						<?php
						foreach ($datapagination['productcurrentpage'] as $product) { ?>
							<div class="col-lg-4 col-md-6 mb-4">
								<div class="product-item">
									<div class="product-image">
										<a href="<?php echo _WEB_ROOT ?>/san-pham/<?php echo create_slug($product['ProductName']) . '-' . urlencode($product['ID']); ?>">
											<img src="<?php echo _WEB_ROOT . $product['ImageURL'] ?>" alt="<?php echo $product['ProductName'] ?>">
										</a>
										<div class="product-action">
											<button type="button" data-pr-id="<?php echo $product['ID'] ?>" class="btn btn_addtocart"><i class="fa fa-cart-plus"></i></button>
										</div>
									</div>
									<div class="product-content">
										<div class="title"><a href="<?php echo _WEB_ROOT ?>/san-pham/<?php echo create_slug($product['ProductName']) . '-' . urlencode($product['ID']); ?>"><?php echo $product['ProductName'] ?></a></div>
										<!-- <div class="price"><?php echo number_format($product['UnitPrice'], 0, ',', '.') . ' đ' ?></div> -->
										<?php if ($product['PriceSale'] > 0) { ?>
											<span class="old-price me-2 font-price">
												<?php echo number_format($product['UnitPrice'], 0, ',', '.') . ' đ'; ?>
											</span>
											<span class="sale-price font-price">
												<?php echo number_format($product['PriceSale'], 0, ',', '.') . ' đ'; ?>
											</span>
										<?php } else { ?>
											<span class="normal-price font-price">
												<?php echo number_format($product['UnitPrice'], 0, ',', '.') . ' đ'; ?>
											</span>
										<?php } ?>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>

				</div>
				<!-- phân trang -->
				<?php include  _DIR_ROOT . '/app/views/layouts/pagination.php' ?>
				<!-- phân trang -->
			</div>

			<div class="col-md-3">
				<div class="sidebar-widget category">
					<h2 class="title">Danh mục</h2>
					<ul>
						<?php foreach ($categoryandcountproduct as $pc) { ?>
							<li><a class="text-truncate" style="width: 200px;" href="<?php echo _WEB_ROOT ?>/danh-muc-<?php echo urlencode($pc['ID']); ?>"><?php echo $pc['CategoryName']  ?></a><span>(<?php echo $pc['product_count']  ?>)</span></li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>