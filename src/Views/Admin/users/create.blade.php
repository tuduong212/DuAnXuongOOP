<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new User</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <h1>Add new user</h1>

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

    <form action="{{ url('admin/users/store') }}" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-6">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="" class="form-control">
            </div>
            <div class="col-lg-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <label for="password" class="form-label">Password</label>
                <input type="text" name="password" id="" class="form-control">
            </div>
            <div class="col-lg-6">
                <label for="confirm_password" class="form-label">Confirm password</label>
                <input type="text" name="confirm_password" id="" class="form-control"
                    placeholder="Confirm password">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <label for="avatar" class="form-label">Image</label>
                <input type="file" name="avatar" id="" class="form-control">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Add new</button>
    </form>
</body>

</html>
