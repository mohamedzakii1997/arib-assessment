@extends('layout')

@section('title', 'edit Page')

@section('content')


    <div class="container mt-5">
        <h1 class="mb-4">Edit Task</h1>

        <!-- Form to Edit Department -->
        <form action="{{ route('employee.task.update', $task['id']) }}" method="POST" enctype="multipart/form-data">
        @csrf




            <div class="mb-3">
                <label for="title" class="form-label"> Title:</label>
                <input type="text" name="title" value="{{ $task['title'] }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea  name="description" class="form-control" required>{{ $task['description'] }}</textarea>

            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status:</label>
                <select name="status" class="form-select">


                    <option value="pending" {{ $task['status'] == 'pending' ? 'selected' : '' }}>Pending</option>

                    <option value="in progress" {{ $task['status'] == 'in progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="closed" {{ $task['status'] == 'closed' ? 'selected' : '' }}>Closed</option>

                    <option value="done" {{ $task['status'] == 'done' ? 'selected' : '' }}>Done</option>

                </select>
            </div>


            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('employee.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


@endsection
