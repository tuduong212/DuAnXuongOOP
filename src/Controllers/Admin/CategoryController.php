<?php

namespace Dell\XuongOop\Controllers\Admin;

use Dell\XuongOop\Commons\Controller;
use Dell\XuongOop\Commons\Helper;
use Dell\XuongOop\Models\Category;
use Rakit\Validation\Validator;

class CategoryController extends Controller
{
    private Category $category;
    public function __construct()
    {
        $this->category = new Category();
    }
    public function index()
    {
        [$data, $totalPage] = $this->category->paginate($_GET['page'] ?? 1);

        $this->renderViewAdmin('categories.index', [
            'data' => $data,
            'totalPage' => $totalPage
        ]);
    }
    public function create()
    {
        $this->renderViewAdmin('categories.create');
    }
    public function store()
    {
        $validator = new Validator();
        $validation = $validator->make($_POST, [
            'name' => 'required|max:50',
        ]);
        $validation->validate();

        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();
            header('Location: ' . url('admin/categories/create'));
            exit;
        } else {
            $data = [
                'name' => $_POST['name'],
            ];
            
            $this->category->insert($data);

            $_SESSION['status'] = true;
            $_SESSION['msg'] = 'Thao tác thành công';

            header('Location: ' . url('admin/categories/'));
            exit;
        }
    }
    public function show($id)
    {
        $category = $this->category->findByID($id);

        $this->renderViewAdmin('categories.show', [
            'category' => $category
        ]);
    }
    public function edit($id)
    {
        $category = $this->category->findByID($id);

        $this->renderViewAdmin('categories.edit', [
            'category' => $category
        ]);
    }
    public function update($id)
    {
        $category = $this->category->findByID($id);
        $validator = new Validator();
        $validation = $validator->make($_POST , [
            'name' => 'max:50',
        ]);
        $validation->validate();

        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();
            header('Location: ' . url("admin/categories/{$category['id']}/edit"));
            exit;
        } else {
            $data = [
                'name' => $_POST['name'],
            ];

            $flagUpload = false;

            $this->category->update($id, $data);

            $_SESSION['status'] = true;
            $_SESSION['msg'] = 'Thao tác thành công';

            header('Location: ' . url("admin/categories/{$category['idCategory']}/edit"));
            exit;
        }
    }
    public function delete($id)
    {
        $this->category->delete($id);
        header("Location: " . url('admin/categories'));
        exit();
    }
}