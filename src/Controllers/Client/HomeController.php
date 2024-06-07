<?php

namespace Dell\XuongOop\Controllers\Client;

use Dell\XuongOop\Commons\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $name = 'DBC';
        $this->renderViewClient('home', [
            'name' => $name
        ]);
    }
}