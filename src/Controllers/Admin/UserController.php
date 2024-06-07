<?php

namespace Dell\XuongOop\Controllers\Admin;

use Dell\XuongOop\Commons\Controller;
use Dell\XuongOop\Commons\Helper;
use Dell\XuongOop\Models\User;
use Rakit\Validation\Validator;

class UserController extends Controller
{
    private User $user;
    public function __construct()
    {
        $this->user = new User();
    }
    public function index()
    {
        [$data, $totalPage] = $this->user->paginate($_GET['page'] ?? 1);

        $this->renderViewAdmin('users.index', [
            'data' => $data,
            'totalPage' => $totalPage
        ]);
    }
    public function create()
    {
        $this->renderViewAdmin('users.create');
    }
    public function store()
    {
        $validator = new Validator();
        $validation = $validator->make($_POST + $_FILES, [
            'name'                  => 'required',
            'email'                 => 'required|email',
            'password'              => 'required|min:6',
            'confirm_password'      => 'required|same:password',
            'avatar'                => 'required|uploaded_file:0,2M,png,jpg,jpeg',
        ]);
    }
    public function show($id)
    {
        $user = $this->user->findByID($id);

        Helper::debug($user);

        $this->renderViewAdmin('users.show', [
            'user' => $user
        ]);
    }
    public function edit($id)
    {
        echo __CLASS__ . '@' . __FUNCTION__ . 'ID=' . $id;
    }
    public function update($id)
    {
        echo __CLASS__ . '@' . __FUNCTION__ . 'ID=' . $id;
    }
    public function delete($id)
    {
        $this->user->delete($id);
        header("Location: " . url('admin/users'));
        exit();
    }
}