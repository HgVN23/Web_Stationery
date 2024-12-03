<?php
$routes['default_controller'] = 'home';

// $routes['dang-nhap'] = 'user/index';
$routes['dang-nhap'] = 'user/login';
$routes['dang-ky-tai-khoan'] = 'user/register';
$routes['tai-khoan'] = 'user/my_account';
$routes['lien-he'] = 'home/contact';
$routes['cap-nhap-thong-tin'] = 'user/update_my_account';
$routes['gui-phan-hoi'] = 'home/sendmessage';

$routes['trang-chu'] = 'home';
$routes['danh-muc$'] = 'home/listproducts'; // Trường hợp không có tham số
$routes['danh-muc-(\d+)$'] = 'home/listproducts/$1'; // Trường hợp có tham số
$routes['san-pham/([a-zA-Z0-9-]+)-(\d+)'] = 'product/productdetails/$2'; // Trường hợp không có tham số
$routes['danh-sach-san-pham'] = 'home/listproducts'; // Trường hợp không có tham số


$routes['gio-hang'] = 'cart/index';
$routes['don-hang'] = 'cart/orders';
$routes['chi-tiet-don-hang'] = 'cart/order_detail';

$routes['xoa-san-pham-khoi-gio-hang'] = 'cart/delete_Cart_Item';
$routes['thay-doi-so-luong'] = 'cart/change_cart_item';
$routes['them-vao-gio-hang'] = 'cart/add_product_to_cart';
$routes['thanh-toan'] = 'cart/checkout';
$routes['loc-gio-hang'] = 'cart/handel_cart_to_order';
$routes['tao-don-hang'] = 'cart/create_order';

// admin
$routes['dang-nhap-admin'] = 'admin/dashboard/handelLoginAction';
$routes['trang-chu-admin'] = 'admin/dashboard/index';
$routes['quan-ly-danh-muc'] = 'admin/dashboard/categories_admin';
$routes['quan-ly-san-pham'] = 'admin/dashboard/products_admin';
$routes['quan-ly-don-hang'] = 'admin/dashboard/orders_admin';
$routes['quan-ly-tai-khoan'] = 'admin/dashboard/users_admin';
$routes['quan-ly-lien-he'] = 'admin/dashboard/contacts_admin';

// category
$routes['tao-moi-danh-muc'] = 'admin/dashboard/create_categories_admin';
$routes['sua-danh-muc'] = 'admin/dashboard/edit_categories_admin';
$routes['xoa-danh-muc'] = 'admin/dashboard/delete_categories_admin';
$routes['cap-nhat-danh-muc-noi-bat'] = 'admin/dashboard/updateIsFeatured';
//product
$routes['tao-moi-san-pham'] = 'admin/dashboard/create_products_admin';
$routes['cap-nhat-san-pham-hot'] = 'admin/dashboard/updateIsHot';
$routes['chi-tiet-san-pham'] = 'admin/dashboard/detail_products_admin';
$routes['chinh-sua-san-pham'] = 'admin/dashboard/edit_products_admin';
$routes['xoa-san-pham'] = 'admin/dashboard/delete_products_admin';
// Order
$routes['xem-chi-tiet-don-hang'] = 'admin/dashboard/detail_orders_admin';
$routes['xac-nhan-don-hang'] = 'admin/dashboard/confirm_orders_admin';

// user
$routes['chi-tiet-tai-khoan-khach-hang'] = 'admin/dashboard/detail_usercustomer_admin';
$routes['khoa-tai-khoan'] = 'admin/dashboard/unlock_lock_usercustomer_admin';
$routes['mo-khoa-tai-khoan'] = 'admin/dashboard/unlock_lock_usercustomer_admin';


// contact 
$routes['chi-tiet-lien-he'] = 'admin/dashboard/detail_contacts_admin';
$routes['cap-nhat-trang-thai-lien-he'] = 'admin/dashboard/replydetailcontact';
$routes['xoa-lien-he'] = 'admin/dashboard/deletecontact';
// breadcrumb
$breadcrumbConfig = [
    'trang-chu' => [
        'name' => 'Trang chủ',
        'url' => _WEB_ROOT . '/trang-chu',
        'parent' => null, // Trang chủ không có parent
    ],
    'danh-muc$' => [
        'name' => 'Sản phẩm',
        'url' => _WEB_ROOT . '/danh-muc',
        'parent' => 'trang-chu', // Trang chủ là parent của sản phẩm
    ],
    'danh-sach-san-pham' => [
        'name' => 'Sản phẩm',
        'url' => _WEB_ROOT . '/danh-sach-san-pham',
        'parent' => 'trang-chu', // Trang chủ là parent của sản phẩm
    ],
    'danh-muc-(\d+)$' => [
        'name' => 'Sản phẩm',
        'url' => _WEB_ROOT . '/danh-muc/$1', // URL cho danh mục, thay thế $1 với ID
        'parent' => 'trang-chu', // Danh mục là parent của danh mục chi tiết
    ],
    'san-pham/([a-zA-Z0-9-]+)-(\d+)' => [
        'name' => 'Chi tiết sản phẩm',
        'url' => _WEB_ROOT . '/san-pham/$2', // URL cho chi tiết sản phẩm, thay thế $2 với ID sản phẩm
        'parent' => 'danh-muc$', // Danh mục là parent của chi tiết sản phẩm
    ],
    'dang-nhap' => [
        'name' => 'Đăng nhập',
        'url' => _WEB_ROOT . '/dang-nhap',
        'parent' => 'trang-chu', // Đăng nhập không có parent
    ],
    'dang-ky-tai-khoan' => [
        'name' => 'Đăng ký tài khoản',
        'url' => _WEB_ROOT . '/dang-ky-tai-khoan',
        'parent' => 'trang-chu', // Đăng nhập không có parent
    ],
    'lien-he' => [
        'name' => 'Liên hệ',
        'url' => _WEB_ROOT . '/lien-he',
        'parent' => 'trang-chu',
    ],
    'gui-phan-hoi' => [
        'name' => 'Liên hệ',
        'url' => _WEB_ROOT . '/gui-phan-hoi',
        'parent' => 'trang-chu',
    ],
    'gio-hang' => [
        'name' => 'Giỏ hàng',
        'url' => _WEB_ROOT . '/gio-hang',
        'parent' => 'trang-chu',
    ],
    'don-hang' => [
        'name' => 'Đơn hàng',
        'url' => _WEB_ROOT . '/don-hang',
        'parent' => 'trang-chu',
    ],
    'chi-tiet-don-hang' => [
        'name' => 'Chi tiết đơn hàng',
        'url' => _WEB_ROOT . '/chi-tiet-don-hang',
        'parent' => 'don-hang', // Đơn hàng là parent của chi tiết đơn hàng
    ],
    'thanh-toan' => [
        'name' => 'Thanh toán',
        'url' => _WEB_ROOT . '/thanh-toan',
        'parent' => 'gio-hang', // Giỏ hàng là parent của thanh toán
    ],
    'tai-khoan' => [
        'name' => 'Tài khoản',
        'url' => _WEB_ROOT . '/tai-khoan',
        'parent' => 'trang-chu',
    ]
];
