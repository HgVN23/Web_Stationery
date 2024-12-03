<?php
class UserController extends Controller
{

    public function login()
    {
        $breadcrumbs = $this->handelBreadCrumd();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            if (!empty($username) && !empty($password)) {
                $params = [
                    'username' => $username,
                    'password' => $password
                ];
                $usermodel = $this->model('User'); // Tải model Product
                $userfind = $usermodel->getInfoUserById($params);
                if ($userfind !== null) {
                    if ($userfind['IsActive'] == 1) {
                        $_SESSION['username'] = $userfind['username'];

                        $_SESSION['user'] = $userfind;
                        header("Location: trang-chu");
                        return;
                    } else {
                        $data = [
                            'result' => ['class' => 'danger', 'icon' =>  'fa-times-circle', 'title' => "Lỗi", 'msg' => "Tài khoản của bạn bị khoá."],
                            'breadcrumbs' => $breadcrumbs
                        ];

                        $this->view('user/login',  $data,  'layouts/_user');
                    }
                } else {
                    $data = [
                        'result' => ['class' => 'danger', 'icon' =>  'fa-times-circle', 'title' => "Lỗi", 'msg' => "Tài khoản hoặc mật khẩu không chính xác."],
                        'breadcrumbs' => $breadcrumbs
                    ];

                    $this->view('user/login',  $data,  'layouts/_user');
                }
            }
        } else {
            $this->view(view: 'user/login', data: ['breadcrumbs' => $breadcrumbs], layout: 'layouts/_user');
        }
    }

    public function register()
    {
        $params['breadcrumbs'] = $this->handelBreadCrumd();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            $fullname = $_POST['fullname'];
            $numberphone = $_POST['numberphone'];
            $email = $_POST['email'];
            $address = $_POST['address'];


            $usermodel = $this->model("User");
            $isusernameexist = $usermodel->CheckExistsUsername($username);
            if ($isusernameexist) {
                $result['isusernameexist'] = $isusernameexist;
            } else {
                $iscreateacc = $usermodel->addNewUser(['username' => $username, 'password' => $password]);
                if ($iscreateacc) {
                    $customermodel = $this->model("Customer");
                    $userid = $usermodel->GetIdByUsername($username)['ID'];

                    $prs = [
                        'fullname' => $fullname,
                        'phone' => $numberphone,
                        'email' => $email,
                        'address' => $address,
                        'userid' => $userid
                    ];
                    $iscreateacus = $customermodel->AddNewCustomer($prs);
                    if ($iscreateacus) {
                        $cusid = $customermodel->GetCustomerByuserId($userid)['ID'];
                        $cartmodel = $this->model("Cart");
                        $cartmodel->AddNewCartForUser($cusid);
                        $result['iscreatenewacc'] = true;
                    }
                }
            }

            echo json_encode($result);
            return;
        }

        $this->view('user/register',  $params,  'layouts/_user');
    }

    public function my_account()
    {
        $params = [];
        if (isset($_SESSION['user'])) {
            $userid =  $_SESSION['user']['ID'];
            $cartmodel = $this->model("Cart");
            $usermodel = $this->model('User');

            $totalcartitem = $cartmodel->CountCartItem($userid)[0]['totalcartitem'];
            $infouser = $usermodel->getInfoUserByIdSession($userid);
            $action = 'user/my-account';
            $params['infouser'] = $infouser;
        } else {
            $totalcartitem = 0;
            $action = 'user/login';
        }
        $params['totalcartitem'] = $totalcartitem;
        $params['breadcrumbs'] = $this->handelBreadCrumd();

        $this->view($action,  $params,  'layouts/_user');
    }

    public function update_my_account()
    {
        $result = [];
        $result['success'] = false;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['address'])) {
                $customermodel = $this->model('Customer');
                $params = [
                    'phone' => $_POST['phone'],
                    'email' => $_POST['email'],
                    'address' => $_POST['address'],
                    'userid' => $_SESSION['user']['ID'],
                ];
                $rs = $customermodel->UpdateInfo($params);
                if ($rs) {
                    $result['success'] = true;
                }
            }

            if (isset($_POST['curent_password']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
                $username = $_SESSION['user']['username'];
                $params['username']  =  $username;
                $params['currentpass']  = $_POST['curent_password'];
                $usermodel = $this->model('User');
                $currentpass = $usermodel->checkpassword($params);

                if ($currentpass) {
                    $newpass = $_POST['new_password'];
                    $confirm_password = $_POST['confirm_password'];
                    if ($newpass === $confirm_password) {
                        $params = [];
                        $params['username']  =  $username;
                        $params['newpass']  =  $newpass;
                        $isupdate = $usermodel->UpdatePassword($params);
                        $result['isupdatepass'] =  $isupdate;
                    }
                } else {
                    $result['erroroldpass'] = true;
                }
            }
        }
        echo json_encode($result);
    }
}
