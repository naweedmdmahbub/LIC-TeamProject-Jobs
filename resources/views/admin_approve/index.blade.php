<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <!-- Css Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/brands.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/solid.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>

    <div class="shadow p-2 table-responsive table-responsive-sm w-75 m-auto my-5">
        <table class="table table-striped table-hover">
            <thead>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Types Of Users</th>
                <th scope="col">Status</th>
            </thead>
            <tbody>
               @forelse ($users as $user)
               <tr>
                <th scope="row">1</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    @if ($user->status === 'draft')
                        <h4>
                            <a href="{{ route('user.draft', $user->id) }}"><span class="badge bg-danger">Draft</span></a>
                        </h4>
                    @endif
                    @if ($user->status === 'approved')
                        <h4><a href=""><span class="badge bg-success">Approve</span></a></h4>
                     @endif
                </td>


            </tr>
               @empty

               @endforelse
            </tbody>
        </table>
    </div>


<!-- Js Files -->
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/fontawesome/js/fontawesome.js') }}"></script>
<script src="{{ asset('assets/fontawesome/js/solid.js') }}"></script>
<script src="{{ asset('assets/fontawesome/js/brands.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
</body>
</html>
