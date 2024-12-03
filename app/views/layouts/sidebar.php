<aside class="sidebar">
	<h1>MENU</h1>
	<a href="<?php echo _WEB_ROOT ?>/trang-chu" class="dropdown-item"><i class="fa fa-home"></i> Trang chủ</a>
	<a class="dropdown-item"><i class="fa fa-th"></i> Danh mục</a>
	<div style="margin-left: 1.5rem; border-left: 2px solid white;">

		<a href="<?php echo _WEB_ROOT ?>/danh-muc" class="dropdown-item">Tất cả</a>
		<?php if (isset($categories)) {
			foreach ($categories as $category) {	?>
				<a href="<?php echo _WEB_ROOT ?>/danh-muc-<?php echo urlencode($category['ID']); ?>" class="dropdown-item"><?php echo ($category['CategoryName']); ?></a>
		<?php
			}
		}
		?>
	</div>
	<hr>
	<a href="<?php echo _WEB_ROOT ?>/gio-hang" class="dropdown-item"><i class="fa fa-cart-plus"></i> Giỏ hàng</a>
	<a href="<?php echo _WEB_ROOT ?>/don-hang" class="dropdown-item"><i class="fa fa-archive"></i> Đơn hàng</a>
	<a href="<?php echo _WEB_ROOT ?>/thanh-toan" class="dropdown-item"><i class="fa fa-credit-card-alt"></i>Thanh toán</a>
	<hr>
	<a href="<?php echo _WEB_ROOT ?>/tai-khoan" class="dropdown-item"><i class="fa fa-user"></i> Tài khoản</a>
	<a href="<?php echo _WEB_ROOT ?>/lien-he" class="dropdown-item"><i class="fa fa-phone"></i> Liên hệ</a>
</aside>