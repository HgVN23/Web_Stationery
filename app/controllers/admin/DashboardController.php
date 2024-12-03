<?php
class DashboardController extends Controller
{

    public function checkloginadmin()
    {
        if (!isset($_SESSION['useradmin'])) {
            $this->view('admin/login_admin', [], 'layouts/_admin_login');
            return false;
        }
        return true;
    }
    public function handelLoginAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username'])  && !empty($_POST['password'])) {
                $usermodel = $this->model("User");
                $iflogin = $usermodel->loginUserAdmin(["username" => $_POST["username"], "password" => $_POST['password']]);
                if ($iflogin) {
                    $_SESSION['useradmin'] = $iflogin;
                    header('Location: trang-chu-admin');

                    $_SESSION['result'] = ['class' => 'success',  'msg' => "Đăng nhập thành công"];

                    return;
                } else {
                    $_SESSION['result'] = ['class' => 'danger', 'msg' => "Đăng nhập thất bại"];
                }
            }
        }
        $this->view('admin/login_admin', [], 'layouts/_admin_login');
    }
    function index()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['logout'])) {
                unset($_SESSION['useradmin']);
            }
        }

        if (!$this->checkloginadmin()) {
            return;
        }

        $category = $this->model("Category");
        $product = $this->model("Product");
        $order = $this->model("Order");
        $user = $this->model("User");
        $contact = $this->model("Contact");

        $params = [
            "numbercategory" =>  $category->countCategory(),
            "numberuser" =>  $user->countUserCustomers(),
            "numberproduct" =>  $product->countProduct(),
            "numberorder" =>  $order->countOrderPending(),
            "numbercontact" => $contact->countAllMessages(),
        ];
        $this->view('admin/index',  $params,  'layouts/_admin');
    }


    // category
    public function categories_admin()
    {
        if (!$this->checkloginadmin()) {
            return;
        }

        $categorymodel = $this->model("Category");

        $params = [];
        if (isset($_GET['keyword'])) {
            $params = ['keyword' => $_GET['keyword']];
        }

        $numbercategory = $categorymodel->countCategory($params);
        $fetchCategoryData = function ($limit, $offset, $params) use ($categorymodel) {
            return $categorymodel->getCategoryCurrentPage($limit, $offset, $params);
        };


        $paginationResult = $this->pagination($params, $numbercategory, $fetchCategoryData, 5);

        $datapagination = [...$paginationResult, "baseurl" => _WEB_ROOT . "/quan-ly-danh-muc"];

        $this->view('admin/category/categories',  ["datapagination" =>  $datapagination,],  'layouts/_admin');
    }

    public function create_categories_admin()
    {
        if (!$this->checkloginadmin()) {
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ form
            $categoryName = $_POST['categoryName'];
            $categoryDescription = $_POST['categoryDescription'];
            $isFeatured = isset($_POST['isFeatured']) ? 1 : 0;

            $categorymodel = $this->model("Category");
            $iscreate = $categorymodel->addCategory($categoryName, $categoryDescription, $isFeatured);
            if ($iscreate) {
                $_SESSION['result'] = ['class' => 'success',  'msg' => "Thêm danh mục thành công"];
            } else {
                $_SESSION['result'] = ['class' => 'danger', 'msg' => "Thêm danh mục thất bại"];
            }


            header('Location: quan-ly-danh-muc');
            return;
        }
        $this->view('admin/category/create',  [],  'layouts/_admin');
    }

    public function edit_categories_admin()
    {
        if (!$this->checkloginadmin()) {
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['categoryid'])) {
                $category_id = $_GET['categoryid'];
                $categorymodel = $this->model("Category");
                $currentcategory = $categorymodel->GetCategoryByID($category_id);
                $this->view('admin/category/edit',  ["currentcategory" => $currentcategory],  'layouts/_admin');
            } else {
                header('Location: ' . _WEB_ROOT . '/quan-ly-danh-muc');
                exit();
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categorymodel = $this->model("Category");
            $categoryID = $_POST['categoryID'];
            $categoryName = $_POST['categoryName'];
            $categoryDescription = $_POST['categoryDescription'];
            $isFeatured = isset($_POST['isFeatured']) ? 1 : 0;
            $isUpdateCategory  = $categorymodel->UpdateCategory($categoryID, $categoryName, $categoryDescription, $isFeatured);
            if ($isUpdateCategory) {
                $_SESSION['result'] = ['class' => 'success',  'msg' => "Cập nhật danh mục thành công"];
            } else {
                $_SESSION['result'] = ['class' => 'danger', 'msg' => "Cập nhật danh mục thất bại"];
            }
            header('Location: quan-ly-danh-muc');
            return;
        }
    }

    public function delete_categories_admin()
    {
        if (!$this->checkloginadmin()) {
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['categoryid'])) {
                $category_id = $_GET['categoryid'];
                $categorymodel = $this->model("Category");
                $currentcategory = $categorymodel->GetCategoryByID($category_id);
                $this->view('admin/category/delete',  ["currentcategory" => $currentcategory],  'layouts/_admin');
            } else {
                header('Location: ' . _WEB_ROOT . '/quan-ly-danh-muc');
                exit();
            }
        }

        // // Xử lý xóa danh mục
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categorymodel = $this->model("Category");
            $categoryID = $_POST['categoryID'];
            $isDeleteCategory  = $categorymodel->DeleteCategory($categoryID);
            if ($isDeleteCategory) {
                $_SESSION['result'] = ['class' => 'success',  'msg' => "Xoá danh mục thành công"];
            } else {
                $_SESSION['result'] = ['class' => 'danger', 'msg' => "Xoá danh mục thất bại"];
            }
            header('Location: quan-ly-danh-muc');
            return;
        }
    }


    public function updateIsFeatured()
    {
        if (!$this->checkloginadmin()) {
            return;
        }

        if (isset($_POST['category_id']) && isset($_POST['is_feature'])) {
            $categoryId = $_POST['category_id'];
            $isFeature = $_POST['is_feature'];
            $categorymodel = $this->model('Category');
            $rs = $categorymodel->UpdateIsFeature($categoryId, $isFeature);
            if ($rs) {
                echo json_encode(["is_feature" => $isFeature]);
            }
        }
    }


    // product
    public function products_admin()
    {
        if (!$this->checkloginadmin()) {
            return;
        }


        $productmodel = $this->model("Product");

        $params = [];
        if (isset($_GET['keyword'])) {
            $params = ['keyword' => $_GET['keyword']];
        }

        $numberproduct = $productmodel->countProduct($params);
        $fetchProđuctData = function ($limit, $offset, $params) use ($productmodel) {
            return $productmodel->getProductCurrentPageForAdmin($limit, $offset, $params);
        };


        $paginationResult = $this->pagination($params, $numberproduct, $fetchProđuctData, 5);

        $datapagination = [
            ...$paginationResult,
            "baseurl" => _WEB_ROOT . "/quan-ly-san-pham",
        ];
        $this->view('admin/product/products',  ["datapagination" =>  $datapagination],  'layouts/_admin');
    }


    public function create_products_admin()
    {
        if (!$this->checkloginadmin()) {
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoryId = $_POST['categoryId'];
            $productName = $_POST['productName'];
            $unitPrice = $_POST['unitPrice'];
            $priceSale = $_POST['priceSale'];
            $description = $_POST['description'];
            $imageFile = $_FILES['imageURL'];
            $stockQuantity = $_POST['stockQuantity'];
            $isHot = isset($_POST['isHot']) ? 1 : 0;
            $productmodel = $this->model("Product");
            $iscreateproduct = $productmodel->addProduct($categoryId, $productName,  $unitPrice, $priceSale, $description, $imageFile, $stockQuantity, $isHot);
            if ($iscreateproduct) {
                $_SESSION['result'] = ['class' => 'success',  'msg' => "Thêm sản phẩm thành công"];
            } else {
                $_SESSION['result'] = ['class' => 'danger', 'msg' => "Thêm sản phẩm thất bại"];
            }
            header('Location: quan-ly-san-pham');
            return;
        }
        $categorymodel = $this->model("Category");
        $categories = $categorymodel->getAllCategory();
        $params = [
            "categories" => $categories,
        ];
        $this->view('admin/product/create', $params,  'layouts/_admin');
    }

    public function updateIsHot()
    {
        if (!$this->checkloginadmin()) {
            return;
        }

        if (isset($_POST['product_id']) && isset($_POST['is_hot'])) {
            $productId = $_POST['product_id'];
            $isHot = $_POST['is_hot'];
            $productmodel = $this->model('Product');
            $rs = $productmodel->UpdateIsHot($productId, $isHot);
            if ($rs) {
                echo json_encode(["is_hot" => $isHot]);
            }
        }
    }

    public function detail_products_admin()
    {
        if (!$this->checkloginadmin()) {
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['productid'])) {
                $productId = $_GET['productid'];
                $productmodel = $this->model('Product');
                $productdetail = $productmodel->getproductdetail($productId);
                $params["product"] =  $productdetail;
                $this->view('admin/product/detail', $params,  'layouts/_admin');
            } else {
                header('Location: ' . _WEB_ROOT . '/quan-ly-san-pham');
                exit();
            }
        }
    }


    public function edit_products_admin()
    {
        if (!$this->checkloginadmin()) {
            return;
        }

        $categorymodel = $this->model("Category");
        $categories = $categorymodel->getAllCategory();
        $params = [
            "categories" => $categories,
        ];
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['productid'])) {
                $productid = $_GET['productid'];
                $productmodel = $this->model("Product");
                $product = $productmodel->getProduct($productid);
                $params = [...$params, 'product' => $product];
                $this->view('admin/product/edit',  $params,  'layouts/_admin');
            } else {
                header('Location: ' . _WEB_ROOT . '/quan-ly-danh-muc');
                exit();
            }
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productid = $_POST['productid'];
            $categoryId = $_POST['categoryId'];
            $productName = $_POST['productName'];
            $unitPrice = $_POST['unitPrice'];
            $priceSale = $_POST['priceSale'];
            $description = $_POST['description'];
            $imageFile = $_FILES['imageURL'];
            $stockQuantity = $_POST['stockQuantity'];
            $isHot = isset($_POST['isHot']) ? 1 : 0;
            $productmodel = $this->model("Product");
            $isupdateproduct = $productmodel->updateProduct($productid, $categoryId, $productName,  $unitPrice, $priceSale, $description, $imageFile, $stockQuantity, $isHot);
            if ($isupdateproduct) {
                $_SESSION['result'] = ['class' => 'success',  'msg' => "Cập nhật sản phẩm thành công"];
            } else {
                $_SESSION['result'] = ['class' => 'danger', 'msg' => "Cập nhật sản phẩm thất bại"];
            }
            header('Location: quan-ly-san-pham');
            return;
        }
    }

    public function delete_products_admin()
    {
        if (!$this->checkloginadmin()) {
            return;
        }

        $productmodel = $this->model("Product");

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['productid'])) {
                $productid = $_GET['productid'];
                $product = $productmodel->getProduct($productid);
                $this->view('admin/product/delete',  ["product" => $product],  'layouts/_admin');
            } else {
                header('Location: ' . _WEB_ROOT . '/quan-ly-danh-muc');
                exit();
            }
        }
        // deleteProduct

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['product_id'])) {
                $isdeleteproduct = $productmodel->deleteProduct($_POST['product_id']);
                if ($isdeleteproduct) {
                    $_SESSION['result'] = ['class' => 'success',  'msg' => "Xoá sản phẩm thành công"];
                } else {
                    $_SESSION['result'] = ['class' => 'danger', 'msg' => "Xoá sản phẩm thất bại"];
                }
                header('Location: quan-ly-san-pham');
                return;
            }
        }
    }


    public function orders_admin()
    {
        if (!$this->checkloginadmin()) {
            return;
        }

        $ordermodel = $this->model("Order");

        $params = [];
        if (isset($_GET['keyword'])) {
            $params = ['keyword' => $_GET['keyword']];
        }

        $numberorder = $ordermodel->countAllOrder($params);
        $fetchOrderData = function ($limit, $offset, $params) use ($ordermodel) {
            return $ordermodel->getOrdersCurrentPageForAdmin($limit, $offset, $params);
        };


        $paginationResult = $this->pagination($params, $numberorder, $fetchOrderData, 5);

        $datapagination = [
            ...$paginationResult,
            "baseurl" => _WEB_ROOT . "/quan-ly-don-hang",
        ];
        $this->view('admin/order/orders',  ["datapagination" =>  $datapagination],  'layouts/_admin');
    }

    public function detail_orders_admin()
    {
        if (!$this->checkloginadmin()) {
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['ordercode'])) {
                $ordercode = $_GET['ordercode'];

                $ordermodel = $this->model('Order');
                $orderdetail = $ordermodel->getOrderDetailbyOrdercodeAdmin($ordercode);
                $params["orderdetail"] =  $orderdetail;
                $this->view('admin/order/detail', $params,  'layouts/_admin');
            } else {
                header('Location: ' . _WEB_ROOT . '/quan-ly-danh-muc');
                exit();
            }
        }
    }

    public function confirm_orders_admin()
    {
        if (!$this->checkloginadmin()) {
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['OrderCode'])) {
                $ordercode = $_POST['OrderCode'];
                $ordermodel = $this->model('Order');
                $isconfirm = $ordermodel->confirmOrder($ordercode);
                if ($isconfirm) {
                    $_SESSION['result'] = ['class' => 'success',  'msg' => "Xác nhận đơn hàng thành công"];
                } else {
                    $_SESSION['result'] = ['class' => 'danger', 'msg' => "Xác nhận đơn hàng thất bại"];
                }
                header("Location: xem-chi-tiet-don-hang?ordercode=$ordercode");
                return;
            }
        }
    }

    public function users_admin()
    {
        if (!$this->checkloginadmin()) {
            return;
        }

        $usermodel = $this->model("User");

        $params = [];
        if (isset($_GET['keyword'])) {
            $params = ['keyword' => $_GET['keyword']];
        }

        $numberusercustomer = $usermodel->countUserCustomers($params);
        $fetchUserData = function ($limit, $offset, $params) use ($usermodel) {
            return $usermodel->getUsersCurrentPageForAdmin($limit, $offset, $params);
        };


        $paginationResult = $this->pagination($params, $numberusercustomer, $fetchUserData, 5);

        $datapagination = [
            ...$paginationResult,
            "baseurl" => _WEB_ROOT . "/quan-ly-tai-khoan",
        ];
        $this->view('admin/user/users',   ["datapagination" =>  $datapagination],  'layouts/_admin');
    }

    public function detail_usercustomer_admin()
    {
        if (!$this->checkloginadmin()) {
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['userid'])) {
                $userid = $_GET['userid'];
                $usermodel = $this->model("User");
                $detailusercustomer = $usermodel->getDetailsUserCustomersForAdmin($userid);
                $this->view('admin/user/detail',  ['detailusercustomer' => $detailusercustomer],  'layouts/_admin');
            } else {
                header('Location: ' . _WEB_ROOT . '/quan-ly-tai-khoan');
                exit();
            }
        }
    }


    public function unlock_lock_usercustomer_admin()
    {
        if (!$this->checkloginadmin()) {
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
                $usermodel = $this->model("User");
                $userid =  $_POST['user_id'];
                if (isset($_POST['lock'])) {
                    $islock = $usermodel->lockAccount($userid);
                    if ($islock) {
                        $_SESSION['result'] = ['class' => 'success',  'msg' => "Khoá tài khoản thành công"];
                    } else {
                        $_SESSION['result'] = ['class' => 'danger', 'msg' => "Khoá tài khoản thất bại"];
                    }
                }
                if (isset($_POST['unlock'])) {
                    $isunlock = $usermodel->unlockAccount($userid);
                    if ($isunlock) {
                        $_SESSION['result'] = ['class' => 'success',  'msg' => "Mở khoá tài khoản thành công"];
                    } else {
                        $_SESSION['result'] = ['class' => 'danger', 'msg' => "Mở khoá tài khoản thất bại"];
                    }
                }

                header("Location: chi-tiet-tai-khoan-khach-hang?userid=$userid");
                return;
            }
        }
    }


    public function contacts_admin()
    {
        if (!$this->checkloginadmin()) {
            return;
        }
        $contactmodel = $this->model("Contact");

        $numbermessage = $contactmodel->countAllMessages();
        $fetchMessageData = function ($limit, $offset, $params) use ($contactmodel) {
            return $contactmodel->getMessagesCurrentPageForAdmin($limit, $offset, $params);
        };
        $params = [];
        $paginationResult = $this->pagination($params, $numbermessage, $fetchMessageData, 5);

        $datapagination = [
            ...$paginationResult,
            "baseurl" => _WEB_ROOT . "/quan-ly-lien-he",
        ];

        $this->view('admin/contact/contacts',  ["datapagination" =>  $datapagination],  'layouts/_admin');
    }

    public function detail_contacts_admin()
    {
        if (!$this->checkloginadmin()) {
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['contactid'])) {
                $contactid = $_GET['contactid'];
                $contactmodel = $this->model("Contact");
                $detailcontact = $contactmodel->getDetailMessagesAdmin($contactid);
                $this->view('admin/contact/detail',  ['detailcontact' => $detailcontact],  'layouts/_admin');
            } else {
                header('Location: ' . _WEB_ROOT . '/quan-ly-lien-he');
                exit();
            }
        }
    }

    public function replydetailcontact()
    {
        if (!$this->checkloginadmin()) {
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['contactid'])) {
                $contactid = $_GET['contactid'];
                $contactmodel = $this->model("Contact");
                $isupdate = $contactmodel->UpdateStatusMessage($contactid);
                if ($isupdate) {
                    $_SESSION['result'] = ['class' => 'success',  'msg' => "Xác nhận thành công"];
                    header("Location: " .  _WEB_ROOT . "/chi-tiet-lien-he?contactid=$contactid");
                    return;
                }
            } else {
                $_SESSION['result'] = ['class' => 'danger', 'msg' => "Xác nhận thất bại"];

                header('Location: ' . _WEB_ROOT . '/quan-ly-lien-he');
                exit();
            }
        }
    }

    public function deletecontact()
    {
        if (!$this->checkloginadmin()) {
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['contactid'])) {
                $contactid = $_GET['contactid'];
                $contactmodel = $this->model("Contact");
                $detailcontact = $contactmodel->getDetailMessagesAdmin($contactid);
                $this->view('admin/contact/delete',  ['detailcontact' => $detailcontact],  'layouts/_admin');
            } else {
                header('Location: ' . _WEB_ROOT . '/quan-ly-lien-he');
                exit();
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['contactid'])) {
                $contactid = $_POST['contactid'];
                $contactmodel = $this->model("Contact");
                $isdelete = $contactmodel->DeleteMessage($contactid);
                if ($isdelete) {
                    $_SESSION['result'] = ['class' => 'success',  'msg' => "Xoá thành công"];
                } else {
                    $_SESSION['result'] = ['class' => 'danger', 'msg' => "Xoá thất bại"];
                }

                header('Location: ' . _WEB_ROOT . '/quan-ly-lien-he');
                exit();
            }
        }
    }


    public function pagination($params, $numbercategory, $fetchDataMethod, $limtitrecord = 6)
    {
        $limit = $limtitrecord;
        $page = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1;
        // Tính vị trí của bản ghi đầu tiên trên trang hiện tại
        $offset = ($page - 1) * $limit;

        $totalRow = $numbercategory;
        // Tính tổng số trang
        $totalPages = ceil($totalRow / $limit);

        // Lấy dữ liệu cho trang hiện tại thông qua phương thức được truyền vào
        $datamodel = $fetchDataMethod($limit, $offset, $params);
        return [
            'limit' => $limit,
            'currentpage' => $page,
            'totalPages' => $totalPages,
            'datamodel' =>  $datamodel,
            "queryParams" => $params
        ];
    }
}
