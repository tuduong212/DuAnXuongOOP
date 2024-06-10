<?php

namespace Dell\XuongOop\Controllers\Client;

use Dell\XuongOop\Commons\Controller;
use Dell\XuongOop\Commons\Helper;
use Dell\XuongOop\Models\Product;

class HomeController extends Controller
{
    private Product $product;

    public function __construct()
    {
        $this->product = new Product;
    }

    public function index()
    {

        [$data, $totalPage] = $this->product->paginate($_GET['page'] ?? 1);

        $this->renderViewClient('home', [
            'data' => $data,
            'totalPage' => $totalPage,
        ]);
    }
}