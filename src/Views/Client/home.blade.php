@extends('layouts.master')
@section('title')
    Home
@endsection

@section('content')
    <h2 class="h5 section-title">Sản phẩm mới</h2>
    <div class="row">
        @foreach ($data as $product)
            <div class="col-lg-4 mb-5">
                <article class="card">
                    <div class="post-slider slider-sm">
                        <a href="{{ url('/products/' . $product['id']) }}">
                            <img src="{{ asset($product['img_thumbnail']) }}" class="card-img-top" alt="post-thumb"
                                style="max-height: 205px">
                        </a>
                    </div>
                    <div class="card-body">
                        <h3 class="h4 mb-3">
                            <a class="post-title" href="{{ url('/products/' . $product['id']) }}">
                                {{ $product['name'] }}
                            </a>
                        </h3>

                        <a href="{{ url('cart/add/') }}?quantity=1&productID={{ $product['id'] }}"
                            class="btn btn-oulined-primary">Thêm vào giỏ hàng</a>
                    </div>
                </article>
            </div>
            
        @endforeach
    </div>

    @for ($i = 1; $i <= $totalPage; $i++)
        @php
        echo '<a href="http://localhost/XuongOOP?page=' . $i . '" class="btn btn-outlined-primary">Page ' . $i . '</a> ';
        @endphp
    @endfor
@endsection
