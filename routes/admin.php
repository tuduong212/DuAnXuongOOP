<?php


global $router;

// CRUD bao gồm: Danh sách, thêm, xem, sửa, xóa
// User:
//      GET     -> USER/INDEX   -> INDEX          -> DANH SÁCH
//      GET     -> USER/CREATE  -> CREATE         -> HIỂN THỊ FORM THÊM MỚI
//      POST    -> USER/STORE   -> STORE          -> LƯU DỮ LIỆU TỪ FORM THÊM MỚI VÀO DB
//      GET     -> USER/ID/SHOW      -> SHOW ($id)     -> XEM CHI TIẾT
//      GET     -> USER/ID/EDIT -> EDIT ($id)     -> HIỂN THỊ FORM CẬP NHẬT
//      PUT     -> USER/ID      -> UPDATE ($id)   -> LƯU DỮ LIỆU TỪ FORM CẬP NHẬT VÀO DB
//      DELETE  -> USER/ID      -> DELETE ($id)   -> XÓA BẢNG

use Dell\XuongOop\Controllers\Admin\UserController;

$router->mount('/admin', function () use ($router) {
    $router->mount('/users', function () use ($router) {
        // CRUD User
        $router->get('/',           UserController::class . '@index');
        $router->get('/create',     UserController::class . '@create');
        $router->post('/store',     UserController::class . '@store');
        $router->get('/{id}/show',       UserController::class . '@show');
        $router->get('/{id}/edit',  UserController::class . '@edit');
        $router->put('/{id}',       UserController::class . '@update');
        $router->get('/{id}/delete',    UserController::class . '@delete');
    });
});

