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
                            <h1 class="m-0">Danh sách user</h1>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <a href="{{ url('admin/users/create') }}" class="btn btn-primary my-3" role="button">Add new user</a>

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
                                    <th>EMAIL</th>
                                    <th>CREATED AT</th>
                                    <th>UPDATED AT</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $user)
                                    <tr>
                                        <td><?= $user['id'] ?></td>
                                        <td><?= $user['name'] ?></td>
                                        <td><img src="{{ asset($user['avatar']) }}" alt="" width="100"></td>
                                        <td><?= $user['email'] ?></td>
                                        <td><?= $user['created_at'] ?></td>
                                        <td><?= $user['updated_at'] ?></td>
                                        <td>
                                            <a class="btn btn-danger" role="button"
                                                href="{{ url('admin/users/' . $user['id'] . '/delete') }}"
                                                onclick="return confirm('Confirm delete?')">Delete</a>
                                            <a class="btn btn-warning" role="button"
                                                href="{{ url('admin/users/' . $user['id'] . '/edit') }}">Edit</a><br>
                                            <a class="btn btn-info mt-2" role="button"
                                                href="{{ url('admin/users/' . $user['id'] . '/show') }}">Info</a>
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
