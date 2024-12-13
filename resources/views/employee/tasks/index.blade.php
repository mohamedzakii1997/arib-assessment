@extends('layout')

@section('title', 'tasks Page')

@section('content')



    <h1>Tasks List</h1>

    <!-- Table for tasks -->
    <table id="employeeTable" class="display">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Status</th>
            <th>Manager</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tasks as $task)
            <tr>
                <td>{{ $task['id'] }}</td>
                <td>{{ $task['title'] }}</td>
                <td>{{ $task['description'] }}</td>
                <td>{{ $task['status'] }}</td>
                <td>{{ $task['manager_name'] }}</td>
                <td>

                    <a class="btn btn-warning" href="{{ route('employee.task.show', $task['id']) }}" title="Edit"> <i class="fas fa-edit"></i></a>

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
