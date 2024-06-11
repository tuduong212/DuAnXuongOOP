<?php

namespace Dell\XuongOop\Controllers\Admin;

use Dell\XuongOop\Commons\Controller;
use Dell\XuongOop\Commons\Helper;
use Dell\XuongOop\Models\Category;
use Dell\XuongOop\Models\Product;
use Rakit\Validation\Validator;

class ProductController extends Controller
{
    private Product $product;
    private Category $category;
    public function __construct()
    {
        $this->product = new Product();
    }
    public function index()
    {
        [$data, $totalPage] = $this->product->paginate($_GET['page'] ?? 1);

        $this->renderViewAdmin('products.index', [
            'data' => $data,
            'totalPage' => $totalPage
        ]);
    }
    public function create()
    {
        $category=$this->category->all();
        $this->renderViewAdmin('products.create',[
            'category'=>$category
        ]);
    }
    public function store()
    {
        $validator = new Validator();
        $validation = $validator->make($_POST + $_FILES, [
            'name' => 'required|max:50',
            'category_id' => 'required',
            'price_regular' => 'required|max:10',
            'price_sale' => 'min:0|max:10',
            'overview' => 'required',
            'content' => 'required',
            'img_thumbnail' => 'uploaded_file:0,2M,png,jpg,jpeg',
        ]);
        $validation->validate();

        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();
            header('Location: ' . url('admin/products/create'));
            exit;
        } else {
            $data = [
                'name' => $_POST['name'],
                'category_id' => $_POST['category_id'],
                'price_regular' => $_POST['price_regular'],
                'price_sale' => $_POST['price_sale'],
                'overview' => $_POST['overview'],
                'content' => $_POST['content'],
                
            ];
            if (isset($_FILES['img_thumbnail']) && $_FILES['img_thumbnail']['size'] > 0) {
                $from = $_FILES['img_thumbnail']['tmp_name'];
                $to = 'assets/uploads/' . time() . $_FILES['img_thumbnail']['name'];

                if (move_uploaded_file($from, PATH_ROOT . $to)) {
                    $data['img_thumbnail'] = $to;
                } else {
                    $_SESSION['errors']['img_thumbnail'] = "Upload failed";

                    header('Location: ' . url('admin/products/create'));
                    exit;
                }
            }
            $this->product->insert($data);

            $_SESSION['status'] = true;
            $_SESSION['msg'] = 'Thao tác thành công';

            header('Location: ' . url('admin/products/'));
            exit;
        }
    }
    public function show($id)
    {
        $product = $this->product->findByID($id);

        $this->renderViewAdmin('products.show', [
            'product' => $product
        ]);
    }
    public function edit($id)
    {
        $product = $this->product->findByID($id);
        $category= $this->category->all();

        $this->renderViewAdmin('products.edit', [
            'product' => $product,
            'category' => $category
        ]);
    }
    public function update($id)
    {
        $product = $this->product->findByID($id);
        $validator = new Validator();
        $validation = $validator->make($_POST + $_FILES, [
            'name' => 'required|max:50',
            'category_id' => 'required',
            'price_regular' => 'required|max:10',
            'price_sale' => 'max:10',
            'overview' => 'required',
            'content' => 'required',
            'img_thumbnail' => 'uploaded_file:0,2M,png,jpg,jpeg',
        ]);
        $validation->validate();

        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();
            header('Location: ' . url("admin/products/{$product['id']}/edit"));
            exit;
        } else {
            $data = [
                'name' => $_POST['name'],
                'category_id' => $_POST['category_id'],
                'price_regular' => $_POST['price_regular'],
                'price_sale' => $_POST['price_sale'],
                'overview' => $_POST['overview'],
                'content' => $_POST['content'],
            ];

            $flagUpload = false;
            if (isset($_FILES['img_thumbnail']) && $_FILES['img_thumbnail']['size'] > 0) {
                $flagUpload = false;
                $from = $_FILES['img_thumbnail']['tmp_name'];
                $to = 'assets/uploads/' . time() . $_FILES['img_thumbnail']['name'];

                if (move_uploaded_file($from, PATH_ROOT . $to)) {
                    $data['img_thumbnail'] = $to;
                } else {
                    $_SESSION['errors']['img_thumbnail'] = "Upload failed";

                    header('Location: ' . url("admin/products/{$product['id']}/edit"));
                    exit;
                }

            }

            $this->product->update($id, $data);

            if (
                $flagUpload
                && $product['img_thumbnail']
                && file_exists(PATH_ROOT . $product['img_thumbnail'])
            ) {
                unlink(PATH_ROOT . $product['img_thumbnail']);
            }

            $_SESSION['status'] = true;
            $_SESSION['msg'] = 'Thao tác thành công';

            header('Location: ' . url("admin/products/{$product['id']}/edit"));
            exit;
        }
    }
    public function delete($id)
    {
        $this->product->delete($id);
        header("Location: " . url('admin/products'));
        exit();
    }
}