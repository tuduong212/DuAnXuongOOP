<?php

namespace Dell\XuongOop\Controllers\Client;

use Dell\XuongOop\Commons\Controller;
use Dell\XuongOop\Commons\Helper;
use Dell\XuongOop\Models\User;

class LoginController extends Controller
{
    private User $user;
    public function __construct()
    {
        $this->user = new User();
    }

    public function showFormLogin()
    {
        auth_check();

        $this->renderViewClient('login');
    }
    public function login()
    {
        $user = $this->user->findByEmail($_POST['email']);

        auth_check();
        try {
            $user = $this->user->findByEmail($_POST['email']);

            if (empty($user)) {
                throw new \Exception('Không tồn tại email: ' . $_POST['email']);
            }

            $flag = password_verify($_POST['password'], $user['password']);
            if ($flag) {
                $_SESSION['user'] = $user;

                unset($_SESSION['cart']);

                if ($user['type'] == 'admin') {
                    header('Location: ' . url('admin/'));
                } else {
                    header('Location: ' . url());
                }
                exit;
            }

            throw new \Exception('Password không đúng: ' . $_POST['email']);

        } catch (\Throwable $th) {
            $_SESSION['error'] = $th->getMessage();

            header('Location: ' . url('login/ '));
            exit;
        }
    }

    public function logout()
    {
        unset($_SESSION['user']);
        unset($_SESSION['cart-' . $_SESSION['user']['id']]);

        header('Location: ' . url('/'));
    }
}