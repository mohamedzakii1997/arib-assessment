@extends('layout')

@section('title', 'Create New Task Page')

@section('content')


    <div class="container mt-5">
        <h1 class="mb-4">Add Task</h1>
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
    <!-- Form to Add Task -->
    <form action="{{ route('task.store') }}" method="POST" enctype="multipart/form-data">
        @csrf



        <input type="hidden" value="{{$employee_id}}" name="employee_id">
        <div class="mb-3">
            <label for="title" class="form-label"> Title:</label>
            <input type="text" name="title" value="{{ old('title') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea  name="description" class="form-control" required>{{ old('last_name') }}</textarea>

        </div>




        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Save </button>
            <a href="{{ route('employee.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


@endsection
