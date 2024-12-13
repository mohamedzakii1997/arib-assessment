@extends('layout')

@section('title', 'edit Page')

@section('content')


    <div class="container mt-5">
        <h1 class="mb-4">Edit Department</h1>

        <!-- Form to Edit Department -->
        <form action="{{ route('department.update', $dept['id']) }}" method="POST" enctype="multipart/form-data">
        @csrf




            <div class="mb-3">
                <label for="name" class="form-label"> Name:</label>
                <input type="text" name="name" value="{{ $dept['name'] }}" class="form-control" required>
            </div>



            <div class="mb-3">
                <label for="manager_id" class="form-label">Free Managers:</label>
                <select name="manager_id" class="form-select">
                    <option value="">-- select manager --</option>
                    @foreach($free_managers as $free_manager)
                    <option value="{{$free_manager->id}}" {{ $dept['manager_id'] == $free_manager->id ? 'selected' : '' }}>{{$free_manager->full_name}}</option>
                    @endforeach
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
