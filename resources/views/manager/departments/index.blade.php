@extends('layout')

@section('title', 'departments Page')

@section('content')



    @if (\Illuminate\Support\Facades\Session::has('dept_error'))
        <div class="alert alert-danger">
            <ul>

                    <li>{{ \Illuminate\Support\Facades\Session::get('dept_error') }}</li>

            </ul>
        </div>
    @endif

    <div>

        <a class="btn btn-primary" href="{{route('department.create')}}" title="Add"> <i class="fas fa-plus"></i> Add New Department</a>

    </div>

    <h1>Departments List</h1>

    <!-- Table for employees -->
    <table id="employeeTable" class="display">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Employees Count</th>
            <th>Sum Of Salaries</th>
            <th>Manager</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($depts as $dept)
            <tr>
                <td>{{ $dept['id'] }}</td>
                <td>{{ $dept['name'] }}</td>
                <td>{{ $dept['employees_count'] }}</td>
                <td>{{ $dept['sum_of_salaries'] }}</td>
                <td>{{ $dept['manager_name'] }}</td>
                <td>

                    <a class="btn btn-warning" href="{{ route('department.show', $dept['id']) }}" title="Edit"> <i class="fas fa-edit"></i></a>
                    <a class="btn btn-danger" href="{{ route('department.delete', $dept['id']) }}" title="Delete"> <i class="fas fa-trash"></i></a>

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
