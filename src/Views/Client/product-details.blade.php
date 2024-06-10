@extends('layouts.master')
@section('title')
    {{ $product['name'] }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4 mb-2 mt-2">
            <h4 class="card-title">{{ $product['name'] }}</h4>
            <div class="card">
                <div>
                    <img class="card-img-top" src="{{ asset($product['img_thumbnail']) }}" alt="Card image"
                        style="max-height: 200px">
                </div>
                
            </div>
        </div>
        <div class="col-md-8 mb-2 mt-2">
            <form action="{{ url('cart/add/') }}" method="get">
                Giá thường: <p>{{ $product['price_regular'] }}</p>
                Giá sale: <p>{{ $product['price_sale']??'Không có' }}</p>
                <input type="hidden" name="productID" id="" value="{{ $product['id'] }}">
                <input type="number" min="1" name="quantity" id="" value="1" class="form-control"><br>
                <button type="submit" class="btn btn-outline-primary">Thêm vào giỏ hàng</button>
            </form>
        </div>
    </div>
@endsection
