@extends('layouts.master')

@section('title')
    Edit {{ $product['name'] }}
@endsection

@section('content')

    @if (!empty($_SESSION['errors']))
        <div class="alert alert-warning">
            <ul>
                @foreach ($_SESSION['errors'] as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            @php
                unset($_SESSION['errors']);
            @endphp
        </div>
    @endif

    <form action="{{ url('admin/products/store') }}" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-6">
                <label for="name" class="form-label">Product</label>
                <input type="text" name="name" id="" class="form-control" value="{{ $product['name'] }}">
            </div>
            <div class="col-lg-6">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="" class="form-control">
                    <option value="" hidden>--Choose category--</option>
                    @foreach ($category as $item)
                        @php
                            $m = '';
                            if ($item['id'] == $product['category_id']) {
                                $m = 'selected';
                            }
                        @endphp
                        <option value="{{ $item['id'] }}" {{$m}}>
                            {{ $item['name'] }}
                        </option>
                    @endforeach
                </select>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <label for="price_regular" class="form-label">Price regular</label>
                <input type="number" name="price_regular" id="" class="form-control"
                    value="{{ $product['price_regular'] }}">
            </div>
            <div class="col-lg-6 mb-3">
                <label for="price_sale" class="form-label">Price sale</label>
                <input type="number" name="price_sale" id="" class="form-control" placeholder=""
                    value="{{ $product['price_sale'] }}">
            </div>
        </div>
        <div class="row">
            <label for="overview" class="form-label">Overview</label>
            <textarea name="overview" class="my-3" id="" cols="30" rows="10" class="form-control">{{ $product['overview'] }}</textarea>
            <label for="content" class="form-label">Content</label>
            <textarea name="content" class="my-3" id="" cols="30" rows="10" class="form-control">{{ $product['content'] }}</textarea>

        </div>
        <div class="row">
            <div class="col-lg-6">
                <label for="img_thumbnail" class="form-label">Image</label>
                <img src="{{ asset($product['img_thumbnail']) }}" alt="" width="200px">
                <input type="file" name="img_thumbnail" id="" class="form-control">
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Add new</button>
    </form>
@endsection
