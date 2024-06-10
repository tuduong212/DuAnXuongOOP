<!DOCTYPE html>
@extends('layouts.master')
@section('title')
    Giỏ hàng
@endsection

@section('content')
    <div class="row">
        @if (!empty($_SESSION['cart']) || !empty($_SESSION['cart-' . $_SESSION['user']['id']]))
            <div class="col-md-8 mb-2 mt-2">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Ảnh</th>
                            <th>Số lượng</th>
                            <th>Giá tiền</th>
                            <th>Thành tiền</th>
                            <th>Xoá</th>
                        </tr>
                    </thead>
                    <tbody>

                        @php
                            $cart = $_SESSION['cart'] ?? $_SESSION['cart-' . $_SESSION['user']['id']];
                        @endphp

                        @foreach ($cart as $item)
                            <tr>
                                <td>
                                    {{ $item['name'] }}

                                </td>
                                <td>
                                    <img src="{{ asset($item['img_thumbnail']) }}" width="100px" alt="">
                                </td>
                                <td>
                                    @php
                                        $url = url('cart/quantityDec') . '?productID=' . $item['id'];
                                        if (isset($_SESSION['cart-' . $_SESSION['user']['id']])) {
                                            $url .= '&cartID=' . $_SESSION['cart_id'];
                                        }

                                    @endphp
                                    <a class="btn btn-danger" href="{{ $url }}">-</a>
                                    {{ $item['quantity'] }}
                                    @php
                                        $url = url('cart/quantityInc') . '?productID=' . $item['id'];
                                        if (isset($_SESSION['cart-' . $_SESSION['user']['id']])) {
                                            $url .= '&cartID=' . $_SESSION['cart_id'];
                                        }

                                    @endphp
                                    <a class="btn btn-primary" href="{{ $url }}">+</a>
                                </td>
                                <td>
                                    {{ $item['price_sale'] ?: $item['price_regular'] }}
                                </td>
                                <td>
                                    {{ $item['quantity'] * ($item['price_sale'] ?: $item['price_regular']) }}
                                </td>
                                <td>
                                    @php
                                        $url = url('cart/remove') . '?productID=' . $item['id'];
                                        if (isset($_SESSION['cart-' . $_SESSION['user']['id']])) {
                                            $url .= '&cartID=' . $_SESSION['cart_id'];
                                        }
                                    @endphp
                                    <a onclick="return confirm('Xoá')" href="{{ $url }}"
                                        class="btn btn-danger">Xoá</a>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-4 mb-2 mt-2">
                <form action="{{ url('order/checkout') }}" method="POST">

                    <div class="mb-3 mt-3">
                        <label for="user_name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="user_name"
                            value="{{ $_SESSION['user']['name'] ?? null }}" placeholder="Enter name" name="user_name">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="user_email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="user_email"
                            value="{{ $_SESSION['user']['email'] ?? null }}" placeholder="Enter email" name="user_email">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="user_phone" class="form-label">Phone:</label>
                        <input type="text" class="form-control" id="user_phone"
                            value="{{ $_SESSION['user']['phone'] ?? null }}" placeholder="Enter phone" name="user_phone">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="user_address" class="form-label">Address:</label>
                        <input type="text" class="form-control" id="user_address"
                            value="{{ $_SESSION['user']['address'] ?? null }}" placeholder="Enter address"
                            name="user_address">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        @else
            <h1 style="text-align: center">GIỎ HÀNG TRỐNG</h1>
        @endif


    </div>
@endsection
