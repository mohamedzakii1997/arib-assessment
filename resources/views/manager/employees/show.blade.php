@extends('layout')

@section('title', 'edit Page')

@section('content')


    <div class="container mt-5">
        <h1 class="mb-4">Edit Employee</h1>

        <!-- Form to Edit Employee -->
        <form action="{{ route('employee.update', $employee['id']) }}" method="POST" enctype="multipart/form-data">
        @csrf


            <!-- Employee ID (hidden as it is not editable) -->
            <input type="hidden" name="id" value="{{ $employee['id'] }}">

            <div class="mb-3">
                <label for="first_name" class="form-label">First Name:</label>
                <input type="text" name="first_name" value="{{ $employee['first_name'] }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name:</label>
                <input type="text" name="last_name" value="{{ $employee['last_name'] }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="full_name" class="form-label">Full Name:</label>
                <input type="text" name="full_name" value="{{ $employee['full_name'] }}" class="form-control" readonly>
            </div>


            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" value="{{ $employee['email'] }}" class="form-control" >
            </div>


            <div class="mb-3">
                <label for="phone" class="form-label">Phone:</label>
                <input type="phone" name="phone" value="{{ $employee['phone'] }}" class="form-control" >
            </div>


            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password"  class="form-control" >
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image:</label>
                <input type="file" name="image" class="form-control">
                @if($employee['image'])
                    <div class="mt-2">
                        <img src="{{ $employee['image'] }}" alt="Employee Image" class="img-thumbnail" width="100">
                    </div>
                @endif
            </div>

            <div class="mb-3">
                <label for="salary" class="form-label">Salary:</label>
                <input type="number" name="salary" value="{{ $employee['salary'] }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role:</label>
                <select name="role" class="form-select">
                    <option value="employee" {{ $employee['role'] == 'employee' ? 'selected' : '' }}>Employee</option>
                    <option value="manager" {{ $employee['role'] == 'manager' ? 'selected' : '' }}>Manager</option>
                </select>
            </div>


            <div class="mb-3">
                <label for="role" class="form-label">Department:</label>
                <select name="department_id" class="form-select">
                    <option value="">-- select department --</option>
                    @foreach($depts as $dept)
                    <option value="{{$dept->id}}" {{ $employee['department_id'] == $dept->id ? 'selected' : '' }}>{{$dept->name}}</option>
                    @endforeach
                </select>
            </div>

{{--            <div class="mb-3">--}}
{{--                <label for="manager_name" class="form-label">Manager Name:</label>--}}
{{--                <input type="text" name="manager_name" value="{{ $employee['manager_name'] }}" class="form-control">--}}
{{--            </div>--}}

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('employee.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <br>
    <br>
    <!-- Display Tasks for the Employee -->
    <h3 class="mt-4">Employee Tasks</h3>
    <table id="tasksTable" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Status</th>
            <th>Manager Name</th>
            <th>Employee Name</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($employee['tasks'] as $task)
            <tr>
                <td>{{ $task['id'] }}</td>
                <td>{{ $task['title'] }}</td>
                <td>{{ $task['description'] }}</td>
                <td>{{ $task['status'] }}</td>
                <td>{{ $task['manager_name'] }}</td>
                <td>{{ $task['employee_name'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#tasksTable').DataTable({
                "paging": true,        // Enable pagination
                "searching": true,     // Enable search functionality
                "ordering": true,      // Enable sorting
                "info": true           // Show info (like "Showing 1 to 10 of 100 entries")
            });
        });
    </script>
@endsection
