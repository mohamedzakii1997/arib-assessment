@extends('layout')

@section('title', 'employees Page')

@section('content')



    <div>

        <a class="btn btn-primary" href="{{route('employee.create')}}" title="Add"> <i class="fas fa-plus"></i> Add Newe Employee</a>

    </div>

    <h1>My Employee List</h1>

    <!-- Table for employees -->
    <table id="employeeTable" class="display">
        <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Full Name</th>
            <th>Image</th>
            <th>Salary</th>
            <th>Role</th>
            <th>Manager</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($employees as $employee)
            <tr>
                <td>{{ $employee['id'] }}</td>
                <td>{{ $employee['first_name'] }}</td>
                <td>{{ $employee['last_name'] }}</td>
                <td>{{ $employee['full_name'] }}</td>
                <td><img src="{{ $employee['image']  }}" alt="Image" width="50"></td>
                <td>{{ $employee['salary'] }}</td>
                <td>{{ $employee['role'] }}</td>
                <td>{{ $employee['manager_name'] }}</td>
                <td>

                    <a class="btn btn-warning" href="{{ route('employee.show', $employee['id']) }}" title="Edit"> <i class="fas fa-edit"></i></a>
                    <a class="btn btn-danger" href="{{ route('employee.delete', $employee['id']) }}" title="Delete"> <i class="fas fa-trash"></i></a>
                    <a class="btn btn-primary" href="{{ route('task.create', $employee['id']) }}" title="Add Task"> <i class="fas fa-file"></i></a>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Include jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#employeeTable').DataTable();
        });
    </script>

    </body>

@endsection
