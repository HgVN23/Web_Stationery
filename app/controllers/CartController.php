<?php
class CartController extends Controller
{
    public function index()
    {
        $params = [];
        $params['breadcrumbs'] = $this->handelBreadCrumd();
        if (!isset($_SESSION['username'])) {
            $this->view(view: 'user/login', data: $params, layout: 'layouts/_user');
            return;
        }
        $userid =  $_SESSION['user']['ID']; // customerid
        $cartmodel = $this->model("Cart");
        $params['totalcartitem'] = $cartmodel->CountCartItem($userid)[0]['totalcartitem'];
        $params = array_merge($params, $cartmodel->GetArrDataCartItemsByUser($userid));
        $this->view('carts/index', $params, "layouts/_user");
    }

    public function delete_Cart_Item()
    {
        $userid =  $_SESSION['user']['ID']; // customerid
        $cartmodel = $this->model("Cart");
        $params = [];
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['item_id'])) {
                $rs = $cartmodel->DeleteCartItem($userid, $_POST['item_id']);
                if ($rs) {
                    $params['result'] =  ['class' => 'success', 'icon' =>  'fa-check-circle',  'title' => "Thông báo",  'msg' => "Xoá thành công"];
                } else {
                    $params['result'] = ['class' => 'danger', 'icon' =>  'fa-times-circle', 'title' => "Lỗi", 'msg' => "Không thể xoá được sản phẩm"];
                }
            }
        }

        $params = [...(array)$params, ...$cartmodel->GetArrDataCartItemsByUser($userid)];
        $this->view('carts/index', $params, "layouts/_user");
    }

    public function change_cart_item()
    {
        $userid =  $_SESSION['user']['ID']; // customerid
        $cartmodel = $this->model("Cart");

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $item_id = isset($_POST['item_id']) ? $_POST['item_id'] : null;
            $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : null;

            if (!empty($item_id) || !empty($quantity)) {
                $cartmodel->ChangeQuantityItem($userid, $item_id, $quantity);
            }
        }

        $cartitemthis = $cartmodel->GetOneCartItemByUser($userid,  $item_id);
        $totalPriceThisCartItem = $cartitemthis['Quantity'] * $cartitemthis['Price'];


        $arrCartitems = $cartmodel->GetArrDataCartItemsByUser($userid);
        $cartitems = $arrCartitems['cartitems'];

        $content = '';
        foreach ($cartitems as $cart) {
            $content .= "<p>" . $cart['ProductName'] . " &nbsp; x &nbsp; " . $cart['Quantity'] . " <span>" . number_format($cart['Price'] * $cart['Quantity'], 0, ',', '.') . " đ</span></p>";
        }

        $params = ['totalPrice' => number_format($totalPriceThisCartItem, 0, ',', '.') . ' đ', "content" => $content, 'totalAmount' =>  number_format($arrCartitems['totalAmount'], 0, ',', '.') . ' đ'];
        echo json_encode($params);
    }


    public function add_product_to_cart()
    {
        if (isset($_SESSION['user'])) {
            $userid =  $_SESSION['user']['ID']; // customerid
            $cartmodel = $this->model("Cart");
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['pr_id'])) {
                    $pr_id = $_POST['pr_id']; // item
                    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1; // quantity
                    $rs =  $cartmodel->AddProductToCart($userid, $pr_id, $quantity);
                    if ($rs) {
                        $totalcartitem = $cartmodel->CountCartItem($userid)[0]['totalcartitem'];
                        echo json_encode(['success' => true, 'totalcartitem' => $totalcartitem]);
                    }
                }
            }
        } else {
            echo json_encode([['success' => false,]]);
        }
    }

    public function checkout()
    {

        $params['breadcrumbs'] = $this->handelBreadCrumd();
        if (isset($_GET['cancle_checkout'])) {
            if (isset($_SESSION['data_cart_to_checkout'])) unset($_SESSION['data_cart_to_checkout']);
        }

        if (!isset($_SESSION['username'])) {
            $this->view(view: 'user/login', data: $params, layout: 'layouts/_user');
            return;
        }

        $userid =  $_SESSION['user']['ID']; // customerid
        $cartmodel = $this->model("Cart");

        $usermodel = $this->model("User"); // user
        $customerinfo = $usermodel->getInfoUserByIdSession();

        $cartitems = $cartmodel->GetCartItemByUser($userid);

        $params['totalcartitem'] = $cartmodel->CountCartItem($userid)[0]['totalcartitem'];
        $params['cartitems'] = $cartitems;
        $params['customerinfo'] = $customerinfo;


        $this->view('carts/checkout', $params, "layouts/_user");
    }

    public function handel_cart_to_order()
    {
        $userid =  $_SESSION['user']['ID']; // customerid
        $cartmodel = $this->model("Cart");
        $procductmodel = $this->model("Product");

        $cartitems = $cartmodel->GetCartItemByUser($userid);
        $filteredCart = [];
        $totalcartitem = 0;
        foreach ($cartitems as $item) {
            $stokproduct = $procductmodel->getStock($item['ProductId']);
            if ($item['Quantity'] <= $stokproduct) {
                $filteredCart[] = $item; // lấy item thoả mã
                $totalcartitem += $item['Quantity'] * $item['Price'];
            }
        }


        if (count($filteredCart) > 0) {
            $data = [
                'filteredCart' => $filteredCart,
                'toltalcartitems' => $totalcartitem,
            ];
            $_SESSION['data_cart_to_checkout'] =  $data;
            echo json_encode(['success' => true,]);
        }
    }

    public function create_order()
    {
        $psmessage = [];
        $is_checkout = false;
        if (isset($_SESSION['data_cart_to_checkout'])) {
            $is_checkout = true;
            $data_cart = $_SESSION['data_cart_to_checkout'];

            $arrcartitems = $data_cart['filteredCart'];


            $totalPrdPay = 0;
            if (count($arrcartitems) > 0) {
                $usermodel = $this->model("User"); // user

                $customerinfo = $usermodel->getInfoUserByIdSession();
                $procductmodel = $this->model("Product");
                $cartitems = [];
                $totalAmount = 0;
                // FILTER PRODUCT BY QUANTITY
                foreach ($arrcartitems as $item) {
                    $stokproduct = $procductmodel->getStock($item['ProductId']);
                    if ($item['Quantity'] <= $stokproduct) {
                        $cartitems[] = $item; // lấy item thoả mã
                        $totalAmount += $item['Quantity'] * $item['Price'];
                    }
                }
                $totalPrdPay = 0;
                if (count($cartitems) > 0) {
                    $totalPrdPay = count($cartitems);

                    $ordermodel = $this->model("Order");
                    $cartmodel = $this->model("Cart");

                    do {
                        $ordercode = $this->generateOrderCode();
                        $check_code = $ordermodel->orderCodeExists($ordercode);
                    } while ($check_code);

                    $params_crOrder = [
                        'OrderCode' => $ordercode,
                        'CustomerId' => $customerinfo['ID'],
                        'OrderDate' => date('Y-m-d H:i:s'),
                        'TotalAmount' => $totalAmount,
                        'OrderStatus' => 'Pending',
                        'ShippingAddress' => $customerinfo['Address']
                    ];
                    $infOrderParam = array_values($params_crOrder);
                    $rscrOrder = $ordermodel->CreateNewOrder($infOrderParam);

                    if ($rscrOrder) {
                        $psmessage['iscreate'] = true;
                        $records = [];
                        $arrprqtt = [];
                        // tạo đơn hàng chi tiết và cập nhập số lượng từng sản phẩm
                        foreach ($cartitems as $item) {
                            $records[] = [
                                $params_crOrder['OrderCode'],
                                $item['ProductId'],
                                $item['Quantity'] * $item['Price'],
                                $item['Quantity'],
                                $item['ProductName'],
                                $item['Price'],
                                $item['ImageURL']
                            ];
                            $arrprqtt[] = ['ID' => $item['ProductId'], 'Quantity' =>  $item['Quantity']];
                        }
                        $rscr = $ordermodel->CreateOrderDetails($records);

                        if ($rscr) {
                            foreach ($arrprqtt as $pr) {
                                $procductmodel->UpdateStock($pr['ID'], $pr['Quantity']);
                            }
                            $arridcitems = array_column($cartitems, 'ID');
                            foreach ($arridcitems as $id) {
                                $cartmodel->DeleteCartItem($customerinfo['ID'], $id);
                            }
                        }

                        unset($_SESSION['data_cart_to_checkout']);
                        $psmessage['totalcartitem'] = $cartmodel->CountCartItem($customerinfo['ID'])[0]['totalcartitem'];
                    }
                }
            }
        }
        $psmessage['success'] = $is_checkout;
        $psmessage['totalPrdPay'] = $totalPrdPay;
        echo json_encode($psmessage);
    }


    function generateOrderCode($length = 8)
    {
        return "ORD" . strtoupper(bin2hex(random_bytes($length / 2)));
    }


    public function orders()
    {

        $params['breadcrumbs'] = $this->handelBreadCrumd();
        if (!isset($_SESSION['username'])) {
            $this->view(view: 'user/login', data: $params,  layout: 'layouts/_user');
            return;
        }

        $userid =  $_SESSION['user']['ID']; // customerid
        $cartmodel = $this->model("Cart");
        $ordermodel = $this->model("Order");
        $params['totalcartitem'] = $cartmodel->CountCartItem($userid)[0]['totalcartitem'];
        $params['myorder'] = $ordermodel->GetOrdersByUserID($userid);
        $params['breadcrumbs'] = $this->handelBreadCrumd();

        $this->view('carts/order', $params, "layouts/_user");
    }

    public function order_detail()
    {
        if (!isset($_SESSION['username'])) {
            $this->view(view: 'user/login', layout: 'layouts/_user');
            return;
        }



        $userid =  $_SESSION['user']['ID']; // customerid
        $cartmodel = $this->model("Cart");
        $ordermodel = $this->model("Order");
        $usermodel = $this->model("User");
        $productmodel = $this->model("Product");

        if ($_SERVER["REQUEST_METHOD"] == "GET") {

            if (isset($_GET['orderCode'])) {
                $orderCode = $_GET['orderCode'];

                $arrayorderdetail = $ordermodel->GetOrdersDetailByOrdercode($orderCode);


                $params['myorder_detail'] = $arrayorderdetail;
                $params['customerinfo'] = $usermodel->getInfoUserByIdSession();
                $myorder = $ordermodel->GetOrdersByOrdercode($orderCode, $userid);

                if (isset($_GET['cancelorder'])) {
                    $ordermodel->CancleOrder($orderCode);
                    $myorder = $ordermodel->GetOrdersByOrdercode($orderCode, $userid);

                    foreach ($arrayorderdetail as $order) {
                        $productmodel->UpdateStockPlus($order['ProductId'], $order['Quantity']);
                    }
                }
            }
        }

        $params['myorder'] = $myorder;
        $params['breadcrumbs'] = $this->handelBreadCrumd();

        $params['totalcartitem'] = $cartmodel->CountCartItem($userid)[0]['totalcartitem'];
        $this->view('carts/order_detail', $params, "layouts/_user");
    }
}
