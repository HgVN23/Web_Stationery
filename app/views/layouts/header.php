<header class="top-header">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-md-6">
				<div class="logo">
					<a href="<?php echo _WEB_ROOT ?>/trang-chu" style="font-size: 30px;">
						<img src="<?php echo _WEB_ROOT ?>/public/img/logo.png" width="44" height="44"> Văn phòng phẩm</a>
				</div>
			</div>
			<div class="col-md-6">
				<div class="user">

					<?php

					if (isset($_SESSION['username'])) {
						$user = $_SESSION['user'];
					?>
						<!-- <a style="margin-right: 1rem; font-size: 20px;" href="<?php echo _WEB_ROOT ?>/tai-khoan"><i class='fa fa-user'></i>
						<?php echo $user['CustomerName']  ?></a> -->

						<div class="dropdown">
							<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-right: 1rem; font-size: 20px;">
								<i class='fa fa-user'></i> <?php echo $user['CustomerName']; ?>
							</a>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
								<a class="dropdown-item" href="<?php echo _WEB_ROOT ?>/tai-khoan">Tài khoản</a>
								<a class="dropdown-item" href="<?php echo _WEB_ROOT ?>/trang-chu?logout">Đăng xuất</a>
							</div>
						</div>

					<?php
					} else {
					?>
						<a style="margin-right: 1rem;" href="<?php echo _WEB_ROOT ?>/dang-nhap">Đăng nhập</a>
					<?php
					}
					?>
					<a class="cart" href="<?php echo _WEB_ROOT ?>/gio-hang">
						<i class="fa fa-cart-plus"></i>
						<span class="number_cart"><?php if (isset($_SESSION['username'])) {
														echo  "($totalcartitem)";
													} ?></span>
					</a>
				</div>
			</div>
		</div>
	</div>
</header>

<div class="header">
	<div class="container">
		<nav class="navbar navbar-expand-md bg-dark navbar-dark">
			<a href="#" class="navbar-brand">MENU</a>
			<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
				<div class="navbar-nav m-auto">
					<a href="<?php echo _WEB_ROOT ?>/trang-chu" class="nav-item nav-link active">trang chủ</a>
					<a href="<?php echo _WEB_ROOT ?>/danh-sach-san-pham" class="nav-item nav-link">sản phẩm</a>
					<div class="nav-item dropdown">
						<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Khác</a>
						<div class="dropdown-menu">
							<a href="<?php echo _WEB_ROOT ?>/gio-hang" class="dropdown-item">Giỏ hàng</a>
							<a href="<?php echo _WEB_ROOT ?>/don-hang" class="dropdown-item">Đơn hàng</a>
							<a href="<?php echo _WEB_ROOT ?>/thanh-toan" class="dropdown-item">Thanh toán</a>
						</div>
					</div>
					<a href="<?php echo _WEB_ROOT ?>/lien-he" class="nav-item nav-link">Liên hệ</a>
					<a href="<?php echo _WEB_ROOT ?>/tai-khoan" class="nav-item nav-link">Tài khoản</a>
				</div>
			</div>
		</nav>
	</div>
</div>