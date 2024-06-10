<?php

use Dell\XuongOop\Controllers\Client\AboutController;
use Dell\XuongOop\Controllers\Client\CartController;
use Dell\XuongOop\Controllers\Client\ContactController;
use Dell\XuongOop\Controllers\Client\HomeController;
use Dell\XuongOop\Controllers\Client\LoginController;
use Dell\XuongOop\Controllers\Client\OrderController;
use Dell\XuongOop\Controllers\Client\ProductController;


// Website có các trang là: 
//  Trang chủ
//  Giới thiệu
//  Sản phẩm
//  Chi tiết sản phẩm
//  Liên hệ

//  Để định nghĩa được thì phải tạo controller trước
//  Tiếp theo, khai báo function tương ứng để xử lý
//  Bước cuối, định nghĩa đường dẫn

// HTTP Method: get, post, put (path), delete, option, head

global $router;

$router->get('/', HomeController::class . '@index');

$router->get('/about', AboutController::class . '@index');

$router->get('/contact', ContactController::class . '@index');
$router->post('/contact/store', ContactController::class . '@store');

$router->get('/products', ProductController::class . '@index');
$router->get('/products/{id}', ProductController::class . '@detail');

$router->get('/login', LoginController::class . '@showFormLogin');
$router->post('/handle-login', LoginController::class . '@login');
$router->get('/logout', LoginController::class . '@logout');

$router->get('cart/add', CartController::class . '@add');
$router->get('cart/quantityInc', CartController::class . '@increaseQuantity');
$router->get('cart/quantityDec', CartController::class . '@decreaseQuantity');
$router->get('cart/remove', CartController::class . '@remove');
$router->get('cart/detail', CartController::class . '@detail');

$router->post('order/checkout', OrderController::class . '@checkout');








