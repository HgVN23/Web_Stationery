<div class="my-account">
	<div class="container">
		<div class="row">
			<div class="col-3">
				<div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
					<a class="nav-link active" id="account-nav" data-toggle="pill" href="#account-tab" role="tab">Chi tiết tài khoản</a>
					<a class="nav-link" href="<?php echo _WEB_ROOT ?>/trang-chu?logout">Đăng xuất</a>
				</div>
			</div>
			<div class="col-9">
				<div class="tab-content">
					<div class="tab-pane fade show active" id="account-tab" role="tabpanel" aria-labelledby="account-nav">
						<h4>Chi tiết tài khoản</h4>
						<div class="row">

							<div class="col-6">
								<input type="text" name="phone" id="phone" required placeholder="Số điện thoại" value="<?php echo $infouser['Phone'] ?>">
							</div>
							<div class="col-6">
								<input type="text" name="email" id="email" required placeholder="Email" value="<?php echo $infouser['Email'] ?>">
							</div>
							<div class="col-12">
								<input type="text" name="address" id="address" required placeholder="Địa chỉ" value="<?php echo $infouser['Address'] ?>">
							</div>
							<div class="col-12">
								<button id="btn_Update_Info">Cập nhật</button>
								<br><br>
							</div>
						</div>
						<h4>Đổi mật khẩu</h4>
						<div class="row">
							<div class="col-12">
								<input type="password" name="curent_password" id="curent_password" required placeholder="Mật khẩu hiện tại">
							</div>
							<div class="col-6">
								<input type="text" name="new_password" autocomplete="off" id="new_password" required placeholder="Mật khẩu mới">
							</div>
							<div class="col-6">
								<input type="text" name="confirm_password" autocomplete="off" id="confirm_password" required placeholder="Xác nhận mật khẩu mới">
							</div>
							<div class="col-12">
								<button type="submit" id="btn_Update_Password">Cập nhật</button>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>