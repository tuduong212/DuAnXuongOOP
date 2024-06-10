<?php

namespace Dell\XuongOop\Controllers\Client;

use Dell\XuongOop\Commons\Controller;
use Dell\XuongOop\Models\Cart;
use Dell\XuongOop\Models\CartDetail;
use Dell\XuongOop\Models\Order;
use Dell\XuongOop\Models\OrderDetail;
use Dell\XuongOop\Models\User;

class OrderController extends Controller
{

    public Order $order;
    public OrderDetail $orderDetail;
    private Cart $cart;
    private CartDetail $cartDetail;
    private User $user;

    public function __construct()
    {
        $this->order = new Order();
        $this->orderDetail = new OrderDetail();
        $this->cart = new Cart;
        $this->cartDetail = new CartDetail;
        $this->user = new User();
    }
    public function checkout()
    {

        // Chưa đăng nhập thì phải tạo tài khoản
        $userID = $_SESSION['user']['id'] ?? null;

        if (!$userID) {
            $conn = $this->user->getConnection();

            $this->user->insert([
                'name' => $_POST['user_name'],
                'email' => $_POST['user_email'],
                'password' => password_hash($_POST['user_password'], PASSWORD_DEFAULT),
                'type' => $_POST['member'],
                'is_active' => 0,
            ]);
            $userID = $conn->lastInsertId();
        }

        // Thêm dữ liệu vào order và order detail
        $conn = $this->order->getConnection();

        $this->order->insert([
            'user_id' => $userID,
            'user_name' => $_POST['user_name'],
            'user_email' => $_POST['user_email'],
            'user_phone' => $_POST['user_phone'],
            'user_address' => $_POST['user_address'],
        ]);

        $orderID = $conn->lastInsertId();

        $key = 'cart';
        if (isset($_SESSION['user'])) {
            $key .= '-' . $_SESSION['user']['id'];
        }

        foreach ($_SESSION[$key] as $productID => $item) {
            $this->orderDetail->insert([
                'order_id' => $orderID,
                'product_id' => $productID,
                'quantity' => $item['quantity'],
                'price_regular' => $item['price_regular'],
                'price_sale' => $item['price_sale'],
            ]);

        }

        // Xoá dữ liệu trong cart và cart details theo cart ID - $_SESSION['cartID']
        

        // Xoá trong SESSION
        unset($_SESSION[$key]);
        if (isset($_SESSION['user'])) {
            unset($_SESSION['cart_id']);
        }

        header('Location: ' . url());
        exit;
    }
}