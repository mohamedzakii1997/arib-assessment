@extends('layout')

@section('title', 'Create New Employee Page')

@section('content')


    <div class="container mt-5">
        <h1 class="mb-4">Add Employee</h1>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <!-- Form to Edit Employee -->
        <form action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
        @csrf




            <div class="mb-3">
                <label for="first_name" class="form-label">First Name:</label>
                <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name:</label>
                <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="full_name" class="form-label">Full Name:</label>
                <input type="text" name="full_name" class="form-control" readonly>
            </div>


            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email"  class="form-control" >
            </div>


            <div class="mb-3">
                <label for="phone" class="form-label">Phone:</label>
                <input type="phone" name="phone"  class="form-control" >
            </div>


            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password"  class="form-control" >
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image:</label>
                <input type="file" name="image" class="form-control">

            </div>

            <div class="mb-3">
                <label for="salary" class="form-label">Salary:</label>
                <input type="number" name="salary"  class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role:</label>
                <select name="role" class="form-select">
                    <option value="employee" >Employee</option>
                    <option value="manager" >Manager</option>
                </select>
            </div>


            <div class="mb-3">
                <label for="role" class="form-label">Department:</label>
                <select name="department_id" class="form-select">
                    <option value="">-- select department --</option>
                    @foreach($depts as $dept)
                        <option value="{{$dept->id}}" >{{$dept->name}}</option>
                    @endforeach
                </select>
            </div>



            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Save </button>
                <a href="{{ route('employee.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


@endsection
