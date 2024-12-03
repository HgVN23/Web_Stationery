<?php
require_once _DIR_ROOT . '/core/Controller.php';
require_once _DIR_ROOT . '/core/Model.php';
require_once _DIR_ROOT . '/core/View.php';

class App
{
    private $__controller, $__action, $__params, $__routes;
    function __construct()
    {
        $this->__controller = 'HomeController';
        $this->__action = 'index';
        $this->__params = [];
        $this->__routes = new Route();
        $this->handleUrl();
    }

    function getUrl()
    {
        if (!empty($_SERVER['PATH_INFO'])) {
            $url = $_SERVER['PATH_INFO'];
        } else {
            $url = '/';
        }
        return $url;
    }

    function handleUrl()
    {
        $url = $this->getUrl();

        $url = $this->__routes->handleRoute($url);
        $arrUrl = array_filter(explode('/', $url));
        $arrUrl = array_values($arrUrl); // đưa về đúng cấu trúc mảng start = 0

        $urlCheck = '';
        if (!empty($arrUrl)) {
            foreach ($arrUrl as $key => $item) {
                $urlCheck .= $item . '/';
                $fileCheck = rtrim($urlCheck, '/');
                $fileArray = explode('/', $fileCheck);
                $fileArray[count($fileArray) - 1] = ucfirst($fileArray[count($fileArray) - 1]);
                $fileCheck = implode('/', $fileArray);
                if (!empty($key)) {
                    unset($arrUrl[$key - 1]);
                }
                if (file_exists("./app/controllers/{$fileCheck}Controller.php")) {
                    $urlCheck = $fileCheck . 'Controller';
                    break;
                }
            }
            $arrUrl = array_values($arrUrl);
        } else {
            $urlCheck = $this->__controller;
        }

        // echo '<pre>';
        // print_r($arrUrl);
        // echo '</pre><br/>';
        // echo 'tes=' . $urlCheck;
        if (!empty($arrUrl[0])) {

            $this->__controller = ucfirst($arrUrl[0]) . 'Controller';
        }
        $controllerFile = "./app/controllers/$urlCheck.php";



        if (file_exists($controllerFile)) {
            require_once $controllerFile;

            if (class_exists($this->__controller)) {
                $this->__controller = new  $this->__controller;
                unset($arrUrl[0]);
            } else {
                $this->loaderror("Class", $this->__controller);
            }
        } else {
            $this->loaderror("Controller", $this->__controller);
        }

        if (!empty($arrUrl[1])) {
            $this->__action = isset($arrUrl[1]) ? $arrUrl[1] : 'index';
            unset($arrUrl[1]);
        }

        if (method_exists($this->__controller, $this->__action)) {
            $this->__params = array_values($arrUrl);
            call_user_func_array([$this->__controller, $this->__action], $this->__params);
        } else {
            $this->loaderror("Method", $this->__controller . '/' . $this->__action);
        }
    }


    function loaderror($name = 'Page', $value = "")
    {
        // Nếu controller không tồn tại, xử lý lỗi
        http_response_code(404);
        echo "404 - $name not found: $value";
    }
}
