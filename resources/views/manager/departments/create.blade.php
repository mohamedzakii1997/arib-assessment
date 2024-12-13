@extends('layout')

@section('title', 'Create New Department Page')

@section('content')


    <div class="container mt-5">
        <h1 class="mb-4">Add Department</h1>
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
    <!-- Form to Add Department -->
    <form action="{{ route('department.store') }}" method="POST" enctype="multipart/form-data">
        @csrf



        <div class="mb-3">
            <label for="name" class="form-label"> Name:</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="manager_id" class="form-label">Free Managers:</label>
            <select name="manager_id" class="form-select">
                <option value="">-- select manager --</option>
                @foreach($free_managers as $free_manager)
                    <option value="{{$free_manager->id}}" >{{$free_manager->full_name}}</option>
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
