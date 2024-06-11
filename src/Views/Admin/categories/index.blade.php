@extends('layouts.master')

@section('title')
    Categories
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h1 class="m-0">Danh sách danh mục</h1>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <a href="{{ url('admin/categories/create') }}" class="btn btn-primary my-3" role="button">Add new
                        category</a>

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
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $category)
                                    <tr>
                                        <td><?= $category['id'] ?></td>
                                        <td><?= $category['name'] ?></td>
                                        <td>
                                            <a class="btn btn-danger" role="button"
                                                href="{{ url('admin/categories/' . $category['id'] . '/delete') }}"
                                                onclick="return confirm('Confirm delete?')">Delete</a>
                                            <a class="btn btn-warning" role="button"
                                                href="{{ url('admin/categories/' . $category['id'] . '/edit') }}">Edit</a>
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
    @for ($i = 1; $i <= $totalPage; $i++)
        @php
        echo '<a href="http://localhost/XuongOOP/admin/categories?page=' . $i . '" class="btn btn-outline-primary">Page ' . $i . '</a> ';
        @endphp
    @endfor
@endsection
