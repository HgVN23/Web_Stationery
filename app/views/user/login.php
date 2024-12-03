<!-- Login Start -->
<div class="login">
	<div class="container">
		<div class="section-header">
			<h3>Đăng nhập</h3>
		</div>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<form action="<?php echo _WEB_ROOT ?>/dang-nhap" method="post" class="login-form">
					<div>
						<div>
							<label>Tên đăng nhập/Email</label>
							<input class="form-control" type="text" name="username" placeholder="Nhập tên đăng nhập hoặc Email...">
						</div>
						<div>
							<label>Mật khẩu</label>
							<input class="form-control" type="password" name="password" placeholder="Nhập mật khẩu...">
						</div>
						<!-- <div>
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="newaccount">
								<label class="custom-control-label" for="newaccount">Lưu đăng nhập</label>
							</div>
						</div> -->
						<div class="mb-2">
							<button type="submit" class="btn w-100 btn-h">Đăng nhập</button>
						</div>
						<div>
							<a class="w-100" href="<?php echo _WEB_ROOT ?>/dang-ky-tai-khoan">Chưa có tài khoản? Đăng ký</a>
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-4"></div>
		</div>
	</div>
</div>
<!-- Login End -->