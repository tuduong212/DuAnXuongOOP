<?php

namespace Dell\XuongOop\Controllers\Client;

use Dell\XuongOop\Commons\Controller;
use Dell\XuongOop\Commons\Helper;
use Dell\XuongOop\Models\Cart;
use Dell\XuongOop\Models\CartDetail;
use Dell\XuongOop\Models\Product;

class CartController extends Controller
{

    private Product $product;
    private Cart $cart;
    private CartDetail $cartDetail;

    public function __construct()
    {
        $this->cart = new Cart;
        $this->product = new Product;
        $this->cartDetail = new CartDetail;
    }

    public function add()
    {
        // Lấy thông tin sản phẩm theo ID
        $product = $this->product->findByID($_GET['productID']);

        // Khởi tạo SESSION cart
        // Check n đang đang đăng nhập hay không
        $key = 'cart';
        if (isset($_SESSION['user'])) {
            $key .= '-' . $_SESSION['user']['id'];
        }

        if (!isset($_SESSION[$key][$product['id']])) {

            $_SESSION[$key][$product['id']] = $product + ['quantity' => $_GET['quantity'] ?? 1];
        } else {

            $_SESSION[$key][$product['id']]['quantity'] += $_GET['quantity'];
        }

        if (isset($_SESSION['user'])) {
            $conn = $this->cart->getConnection();
            // $conn->beginTransaction();
            try {

                $cart = $this->cart->findByUserID($_SESSION['user']['id']);

                if (empty($cart)) {
                    $this->cart->insert([
                        'user_id' => $_SESSION['user']['id']
                    ]);
                }

                $cartID = $cart['id'] ?? $conn->lastInsertId();
                $_SESSION['cart_id'] = $cartID;

                $this->cartDetail->deleteByCartID($cartID);

                foreach ($_SESSION[$key] as $productID => $item) {
                    $this->cartDetail->insert([
                        'cart_id' => $cartID,
                        'product_id' => $productID,
                        'quantity' => $item['quantity']
                    ]);

                }

                // $conn->commit();
            } catch (\Throwable $th) {
                // $conn->rollBack();
            }
        }

        header('Location: ' . url('cart/detail'));
    }



    public function detail()
    {
        $this->renderViewClient('cart', [

        ]);
    }
    public function increaseQuantity()
    {
        // Lấy ra dữ liệu từ cart_details để đảm bảo nó có tồn tại bản ghi

        // Thay đổi trong SESSION
        $key = 'cart';
        if (isset($_SESSION['user'])) {
            $key .= '-' . $_SESSION['user']['id'];
        }

        $_SESSION[$key][$_GET['productID']]['quantity'] += 1;
        // Thay đổi trong DB

        if (isset($_SESSION['user'])) {
            $this->cartDetail->updateByCartIDANDProductID(
                $_GET['cartID'],
                $_GET['productID'],
                $_SESSION[$key][$_GET['productID']]['quantity']
            );
        }
        header('Location: ' . url('cart/detail'));
        exit;
    }
    public function decreaseQuantity()
    {
        // Lấy ra dữ liệu từ cart_details để đảm bảo nó có tồn tại bản ghi

        // Thay đổi trong SESSION
        $key = 'cart';
        if (isset($_SESSION['user'])) {
            $key .= '-' . $_SESSION['user']['id'];
        }

        if ($_SESSION[$key][$_GET['productID']]['quantity'] > 1) {
            $_SESSION[$key][$_GET['productID']]['quantity'] -= 1;
        }

        // Thay đổi trong DB

        if (isset($_SESSION['user'])) {
            $this->cartDetail->updateByCartIDANDProductID(
                $_GET['cartID'],
                $_GET['productID'],
                $_SESSION[$key][$_GET['productID']]['quantity']
            );
        }
        header('Location: ' . url('cart/detail'));
        exit;
    }
    public function remove()
    {
        $key = 'cart';
        if (isset($_SESSION['user'])) {
            $key .= '-' . $_SESSION['user']['id'];
        }
        unset($_SESSION[$key][$_GET['productID']]);

        if (isset($_SESSION['user'])) {
            $this->cartDetail->deleteByCartIDANDProductID($_GET['cartID'], $_GET['productID']);
        }
        header('Location: ' . url('cart/detail'));
        exit;
    }
}