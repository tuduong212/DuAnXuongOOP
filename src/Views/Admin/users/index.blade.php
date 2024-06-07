<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách User</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <a href="{{url('admin/users/create')}}" class="btn btn-primary my-3" role="button">Add new user</a>

    <table class="table table-bordered">
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
                <td><?=$user['id']?></td>
                <td><?=$user['name']?></td>
                <td></td>
                <td><?=$user['email']?></td>
                <td><?=$user['created_at']?></td>
                <td><?=$user['updated_at']?></td>
                <td>
                    <a class="btn btn-danger" role="button" href="{{url('admin/users/' .$user['id'] . '/delete' )}}" onclick="return confirm('Confirm delete?')">Delete</a>
                    <a class="btn btn-info" role="button" href="{{url('admin/users/' .$user['id'] . '/show' )}}">Info</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>