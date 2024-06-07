<?php

namespace Dell\XuongOop\Controllers\Client;

use Dell\XuongOop\Commons\Controller;

class ProductController extends Controller
{
    public function index()
    {
        echo __CLASS__ . '@' . __FUNCTION__;
    }
    public function detail($id)
    {
        echo __CLASS__ . '@' . "$id" . '@' . __FUNCTION__;
    }
}