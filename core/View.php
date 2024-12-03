<?php

class View
{
    // Hàm để hiển thị view với dữ liệu
    public function render($view, $data = [], $layout = 'layouts/main')
    {
        // Chuyển đổi dữ liệu thành biến để sử dụng trong view
        foreach ($data as $key => $value) {
            $$key = $value;
        }

        // Kiểm tra nếu tệp view tồn tại
        if (file_exists(_DIR_ROOT . "/app/views/" . $view . ".php")) {
            ob_start(); // nội dung sẽ được lưu vào bộ đệm.
            require _DIR_ROOT . "/app/views/" . $view . ".php";
            // Lưu nội dung view vào biến $content
            $content = ob_get_clean(); // lấy nội dung đã được lưu trong bộ đệm
        } else {
            die("View không tồn tại: " . $view);
        }
        require _DIR_ROOT . "/app/views/$layout.php";
    }
}
