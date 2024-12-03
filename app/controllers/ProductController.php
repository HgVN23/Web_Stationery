<?php

class ProductController extends Controller
{
    function productdetails($productid)
    {
        $categorymodel = $this->model("Category");
        $categories = $categorymodel->getAllCategory();

        $productmodel = $this->model('Product');
        $product = $productmodel->getProduct($productid);

        $params = [];
        $params['breadcrumbs'] = $this->handelBreadCrumd();
        if (isset($_SESSION['user'])) {
            $userid =  $_SESSION['user']['ID'];
            $cartmodel = $this->model("Cart");
            $params['totalcartitem'] = $cartmodel->CountCartItem($userid)[0]['totalcartitem'];
        }
        $params = [...$params, 'product' => $product, 'categories' => $categories];

        $this->view('product/detail', data: $params); // Hiển thị view
    }
}
