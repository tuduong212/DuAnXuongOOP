<?php

namespace Dell\XuongOop\Controllers\Admin;

use Dell\XuongOop\Commons\Controller;
use Dell\XuongOop\Commons\Helper;
use Dell\XuongOop\Models\User;
use Rakit\Validation\Validator;

class DashboardController extends Controller
{
    public function Dashboard(){
        $this->renderViewAdmin(__FUNCTION__);
    }
}