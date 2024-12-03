<?php

class Controller
{

    protected $view;

    public function __construct()
    {
        $this->view = new View(); // Khởi tạo lớp View

    }

    public function handelBreadCrumd()
    {
        $currentUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $currentUrl = str_replace('/web_stationery/', '', $currentUrl);
        global $breadcrumbConfig;
        return $this->generateBreadcrumb($currentUrl, $breadcrumbConfig);
    }

    function generateBreadcrumb($currentUrl)
    {
        global $breadcrumbConfig;
        $breadcrumb = [];

        foreach ($breadcrumbConfig as $pattern => $data) {
            if (preg_match("#^$pattern$#", $currentUrl, $matches)) {
                // Thêm phần tử hiện tại vào breadcrumb
                $breadcrumb[] = [
                    'name' => $data['name'],
                    'url' => isset($data['url']) ? $data['url'] : '#'
                ];

                // Kiểm tra parent, nếu có thì thêm
                if (isset($data['parent']) && $data['parent'] !== null) {
                    $parentPattern = $data['parent'];
                    while (isset($breadcrumbConfig[$parentPattern])) {
                        $parentData = $breadcrumbConfig[$parentPattern];
                        $breadcrumb[] = [
                            'name' => $parentData['name'],
                            'url' => $parentData['url']
                        ];
                        $parentPattern = $parentData['parent'] ?? null;
                        if ($parentPattern === null) break;
                    }
                }
                break;
            }
        }

        return array_reverse($breadcrumb);
    }






    public function getHomeData($categoryid = null)
    {
        $productmodel = $this->model('Product'); // Tải model Product

        if ($categoryid) {
            $products = $productmodel->getProductsByCategory($categoryid);
        } else {
            $products = $productmodel->getAllProducts();
        }

        $categorymodel = $this->model("Category");
        $categories = $categorymodel->getAllCategory();
        $categoriesfeature = $categorymodel->getCategoryFeature();
        return ['products' => $products, 'categories' => $categories, 'categoriesfeature' => $categoriesfeature];
    }


    public function view($view, $data = [], $layout = 'layouts/main')
    {
        $this->view->render($view, $data, $layout);
    }


    public function model($model)
    {

        if (file_exists(_DIR_ROOT . "/app/models/" . $model . ".php")) {
            require_once _DIR_ROOT . "/app/models/" . $model . ".php";
            return new $model();
        } else {
            die("Model không tồn tại: " . $model);
        }
    }
}
