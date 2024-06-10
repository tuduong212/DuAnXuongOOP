<?php


global $router;

// CRUD bao gồm: Danh sách, thêm, xem, sửa, xóa
// User:
//      GET     -> USER/INDEX   -> INDEX          -> DANH SÁCH
//      GET     -> USER/CREATE  -> CREATE         -> HIỂN THỊ FORM THÊM MỚI+9+9+9/6/575755
//      POST    -> USER/STORE   -> STORE          -> LƯU DỮ LIỆU TỪ FORM THÊM MỚI VÀO DB
//      GET     -> USER/ID/SHOW -> SHOW ($id)     -> XEM CHI TIẾT
//      GET     -> USER/ID/EDIT -> EDIT ($id)     -> HIỂN THỊ FORM CẬP NHẬT
//      PUT     -> USER/ID      -> UPDATE ($id)   -> LƯU DỮ LIỆU TỪ FORM CẬP NHẬT VÀO DB
//      DELETE  -> USER/ID      -> DELETE ($id)   -> XÓA BẢNG

use Dell\XuongOop\Controllers\Admin\DashboardController;
use Dell\XuongOop\Controllers\Admin\UserController;

$router->before('GET|POST', '/admin/*.*', function() {
    if (!isset($_SESSION['user'])) {
        header('location: ' .url('login'));
        exit();
    }
});



$router->mount('/admin', function () use ($router) {
    $router->get('/', DashboardController::class . '@dashboard');
    $router->mount('/users', function () use ($router) {
        // CRUD User
        $router->get('/',           UserController::class . '@index');
        $router->get('/create',     UserController::class . '@create');
        $router->post('/store',     UserController::class . '@store');
        $router->get('/{id}/show',       UserController::class . '@show');
        $router->get('/{id}/edit',  UserController::class . '@edit');
        $router->post('/{id}/update',   UserController::class . '@update');
        $router->get('/{id}/delete',    UserController::class . '@delete');
    });
});

