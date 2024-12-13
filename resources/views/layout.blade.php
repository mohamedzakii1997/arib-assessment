<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel App')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">MyApp</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('employee.home')}}">Home</a>
                </li>
                @if(! \Illuminate\Support\Facades\Session::has('user'))
                <li class="nav-item">
                    <a class="nav-link" href="{{route('showLoginForm')}}">Login</a>
                </li>
                @endif

                @if( \Illuminate\Support\Facades\Session::has('user'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('logout')}}">Logout</a>
                    </li>
                @endif

                @if( \Illuminate\Support\Facades\Session::has('user'))
                    @if(auth()->user()->role == 'manager')
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('employee.index')}}">Employees</a>
                    </li>
                    @endif
                @endif


                @if( \Illuminate\Support\Facades\Session::has('user'))
                    @if(auth()->user()->role == 'manager')
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('department.index')}}">Departments</a>
                        </li>
                    @endif
                @endif


                @if( \Illuminate\Support\Facades\Session::has('user'))
                    @if(auth()->user()->role == 'employee')
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('employee.task.index')}}">My Tasks</a>
                        </li>
                    @endif
                @endif

            </ul>
        </div>
    </div>
</nav>

<main class="container mt-4">
    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
