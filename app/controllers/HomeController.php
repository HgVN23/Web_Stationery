<?php
class HomeController extends Controller
{
    public function index($categoryid = null)
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_GET['logout'])) {
                unset($_SESSION['username']);
                unset($_SESSION['user']);
            }
        }

        $params = [];

        if (isset($_SESSION['user'])) {
            $userid =  $_SESSION['user']['ID'];
            $cartmodel = $this->model("Cart");
            $params['totalcartitem'] = $cartmodel->CountCartItem($userid)[0]['totalcartitem'];
        }
        $categorymodel = $this->model("Category");
        $params['categoryfeature'] = $categorymodel->getCategoryFeature();
        $productmodel = $this->model("Product");
        $params['listproductsnew'] = $productmodel->ProductsNew();
        $params['listproductshot'] = $productmodel->ProductsHot();
        $params['breadcrumbs'] = [];
        $params = [...$params, ...$this->getHomeData($categoryid)];
        $this->view('home/index', $params); // Hiển thị view
    }

    public function listproducts($categoryid = null)
    {

        $breadcrumb = $this->handelBreadCrumd();
        $dataparams = [];
        $dataparams['breadcrumbs'] = $breadcrumb;

        $sort = null;
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_GET['sort'])) {
                $sort =  $_GET['sort'];
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_GET['categoryid'])) {
                $categoryid = $_GET['categoryid'];
            }
        }

        $categorymodel = $this->model("Category");
        $categories = $categorymodel->getAllCategory();

        $categoryandcountproduct = $categorymodel->getAllCategoryandCoundProduct();

        $totalcartitem = 0;
        if (isset($_SESSION['user'])) {
            $userid =  $_SESSION['user']['ID'];
            $cartmodel = $this->model("Cart");
            $totalcartitem = $cartmodel->CountCartItem($userid)[0]['totalcartitem'];
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET") {

            if (isset($_GET['search'])) {
                $search = htmlspecialchars($_GET['search']);

                $params = ['categoryid' => $categoryid, 'search' => $search, 'sort' => $sort];

                $datapagination = $this->pagination($params);


                $dataparams = [...$dataparams, ...[
                    'categories' => $categories,
                    'categoryandcountproduct' => $categoryandcountproduct,
                    'datapagination' => $datapagination,
                    'totalcartitem' => $totalcartitem
                ]];

                $this->view('product/product-list', $dataparams);
                return;
            }
        }

        $params = ['categoryid' => $categoryid, 'sort' => $sort];
        $datapagination = $this->pagination($params);

        $dataparams = [...$dataparams, ...[
            'categories' => $categories,
            'categoryandcountproduct' => $categoryandcountproduct,
            'datapagination' => $datapagination,
            'totalcartitem' => $totalcartitem
        ]];
        $this->view('product/product-list',  $dataparams);
    }


    public function pagination($params)
    {

        $limit = 9;

        // Trang hiện tại (mặc định là trang 1)
        // $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1;
        // Tính vị trí của bản ghi đầu tiên trên trang hiện tại
        $offset = ($page - 1) * $limit;

        $productmodel = $this->model('Product');

        $totalRow  = $productmodel->getCountProduct($params);
        $totalProduct = $totalRow['total'];
        // Tính tổng số trang
        $totalPages = ceil($totalProduct / $limit);

        $productcurrentpage =  $productmodel->getProductCurrentPage($limit, $offset, $params);

        return [
            'queryparams' => $params,
            'currentpage' => $page,
            'totalPages' => $totalPages,
            'productcurrentpage' => $productcurrentpage,
        ];
    }



    public function contact()
    {
        if (isset($_SESSION['user'])) {
            $userid =  $_SESSION['user']['ID'];
            $cartmodel = $this->model("Cart");
            $totalcartitem = $cartmodel->CountCartItem($userid)[0]['totalcartitem'];
        } else {
            $totalcartitem = 0;
        }
        $params = [
            'breadcrumbs' => $this->handelBreadCrumd(),
            'totalcartitem' => $totalcartitem
        ];
        $this->view('home/contact', $params, "layouts/_user");
    }


    public function sendmessage()
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['sendmessage'])) {

                if (isset($_SESSION['user'])) {
                    $userid =  $_SESSION['user']['ID'];
                    $cartmodel = $this->model("Cart");
                    $totalcartitem = $cartmodel->CountCartItem($userid)[0]['totalcartitem'];
                } else {
                    $totalcartitem = 0;
                }
                $params = [
                    'breadcrumbs' => $this->handelBreadCrumd(),
                    'totalcartitem' => $totalcartitem
                ];

                $fullname = $_POST['fullname'];
                $email = $_POST['email'];
                $message = $_POST['message'];
                $params  = [...$params, 'fullname' => $fullname, 'email' => $email, 'message' => $message];
                $Contact = $this->model('Contact');
                $rs = $Contact->InsertMessage($params);
                if ($rs) {
                    $params = [...$params, 'result' => ['class' => 'success', 'icon' =>  'fa-check-circle',  'title' => "Thông báo",  'msg' => "Gửi thành công"]];
                } else {
                    $params = [...$params, 'result' => ['class' => 'danger', 'icon' =>  'fa-times-circle', 'title' => "Lỗi", 'msg' => "Gửi thất bại"]];
                }

                $this->view('home/contact', $params, "layouts/_user");
            }
        }
    }
}
