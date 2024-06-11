@extends('layouts.master')

@section('title')
    Edit {{ $category['name'] }}
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

    <form action="{{ url("admin/categories/{$category['id']}/update") }}" method="POST">
        <div class="row">
            <div class="col-lg-6">
                <label for="id" class="form-label">Category id</label>
                <input type="text" name="id" id="" class="form-control" value="{{ $category['id'] }}"
                    readonly>
            </div>
            <div class="col-lg-6">
                <label for="name" class="form-label">Category name</label>
                <input type="text" name="name" id="" class="form-control" value="{{ $category['name'] }}">
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
@endsection
