<div class="category banner">
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
		</ol>
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img class="d-block w-100" src="<?php echo _WEB_ROOT ?>/public/img/banner_5.jpg" alt="First slide">
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="<?php echo _WEB_ROOT ?>/public/img/banner_2.jpg" alt="Second slide">
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="<?php echo _WEB_ROOT ?>/public/img/banner_3.jpg" alt="Third slide">
			</div>
		</div>
		<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
</div>


<div class="category">
	<div>
		<div class="container">
			<div class="section-header">
				<h3>Danh mục

				</h3>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4">
				<div class="category-img">
					<img src="<?php echo _WEB_ROOT ?>/public/img/category_1.jpg" />
					<a class="category-name" href="<?php echo _WEB_ROOT ?>/danh-muc-<?php echo urlencode($categoryfeature[0]['ID']); ?>">
						<h2><?php echo $categoryfeature[0]['CategoryName'] ?></h2>
					</a>
				</div>
			</div>
			<div class="col-md-4">
				<div class="category-img">
					<img src="<?php echo _WEB_ROOT ?>/public/img/category_2_1.jpg" />
					<a class="category-name" href="<?php echo _WEB_ROOT ?>/danh-muc-<?php echo urlencode($categoryfeature[1]['ID']); ?>">
						<h2><?php echo $categoryfeature[1]['CategoryName'] ?></h2>
					</a>
				</div>
				<div class="category-img">
					<img src="<?php echo _WEB_ROOT ?>/public/img/category_2_2.jpg" />
					<a class="category-name" href="<?php echo _WEB_ROOT ?>/danh-muc-<?php echo urlencode($categoryfeature[2]['ID']); ?>">
						<h2><?php echo $categoryfeature[2]['CategoryName'] ?></h2>
					</a>
				</div>
			</div>
			<div class="col-md-4">
				<div class="category-img">
					<img src="<?php echo _WEB_ROOT ?>/public/img/category_3.jpg" />
					<a class="category-name" href="<?php echo _WEB_ROOT ?>/danh-muc-<?php echo urlencode($categoryfeature[3]['ID']); ?>">
						<h2><?php echo $categoryfeature[3]['CategoryName'] ?></h2>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="featured-product">
	<div class="container">
		<div class="section-header">
			<h3>Hàng mới</h3>
		</div>
		<div class="row align-items-center product-slider product-slider-4 slick-slider">
			<?php
			foreach ($listproductsnew as $product) {
			?>
				<div class="col-4">
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
							<?php if ($product['PriceSale'] > 0) { ?>
								<span class="old-price font-price  me-2">
									<?php echo number_format($product['UnitPrice'], 0, ',', '.') . ' đ'; ?>
								</span>
								<span class="sale-price font-price ">
									<?php echo number_format($product['PriceSale'], 0, ',', '.') . ' đ'; ?>
								</span>
							<?php } else { ?>
								<span class="normal-price font-price ">
									<?php echo number_format($product['UnitPrice'], 0, ',', '.') . ' đ'; ?>
								</span>
							<?php } ?>
						</div>
					</div>
				</div>
			<?php
			}
			?>

		</div>
	</div>
</div>

<br>

<div class="recent-product">
	<div class="container">
		<div class="section-header">
			<h3>Hàng bán chạy</h3>
		</div>
		<div class="row align-items-center product-slider product-slider-4 slick-slider">
			<?php
			foreach ($listproductshot as $product) {
			?>
				<div class="col-4">
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
							<?php if ($product['PriceSale'] > 0) { ?>
								<span class="old-price font-price  me-2">
									<?php echo number_format($product['UnitPrice'], 0, ',', '.') . ' đ'; ?>
								</span>
								<span class="sale-price font-price ">
									<?php echo number_format($product['PriceSale'], 0, ',', '.') . ' đ'; ?>
								</span>
							<?php } else { ?>
								<span class="normal-price font-price ">
									<?php echo number_format($product['UnitPrice'], 0, ',', '.') . ' đ'; ?>
								</span>
							<?php } ?>
						</div>
					</div>
				</div>
			<?php
			}
			?>

		</div>
	</div>
</div>