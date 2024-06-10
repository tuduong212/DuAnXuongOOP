@extends('layouts.master')

@section('title')
    Danh sách User
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h1 class="m-0">Danh sách sản phẩm</h1>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <a href="{{ url('admin/products/create') }}" class="btn btn-primary my-3" role="button">Add new product</a>

                    @if (!empty($_SESSION['status']) && $_SESSION['status'])
                        <div class="alert alert-success">
                            {{ $_SESSION['msg'] }}
                        </div>
                        @php
                            unset($_SESSION['status']);
                            unset($_SESSION['msg']);
                        @endphp
                    @endif
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NAME</th>
                                    <th>IMAGE</th>
                                    <th>PRICE</th>
                                    <th>PRICE SALE</th>
                                    <th>CREATED AT</th>
                                    <th>UPDATED AT</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $product)
                                    <tr>
                                        <td><?= $product['id'] ?></td>
                                        <td><?= $product['name'] ?></td>
                                        <td><img src="{{ asset($product['img_thumbnail']) }}" alt="" width="100"></td>
                                        <td><?= $product['price_regular'] ?></td>
                                        <td><?= $product['price_sale'] ?></td>
                                        <td><?= $product['created_at'] ?></td>
                                        <td><?= $product['updated_at'] ?></td>
                                        <td>
                                            <a class="btn btn-danger" role="button"
                                                href="{{ url('admin/products/' . $product['id'] . '/delete') }}"
                                                onclick="return confirm('Confirm delete?')">Delete</a><br>
                                            <a class="btn btn-warning my-2" role="button"
                                                href="{{ url('admin/products/' . $product['id'] . '/edit') }}">Edit</a><br>
                                            <a class="btn btn-info" role="button"
                                                href="{{ url('admin/products/' . $product['id'] . '/show') }}">Info</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
