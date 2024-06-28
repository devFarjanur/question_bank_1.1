@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Course</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Course</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Course</h4>
                    <form method="POST" action="{{ route('admin.course.update', $course->id) }}">
                        @csrf
                        <div class="mb-3">
                            <label for="coursename" class="form-label">Course Name:</label>
                            <input id="coursename" class="form-control" name="coursename" type="text"
                                value="{{ $course->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="coursedescription" class="form-label">Course Description:</label>
                            <input id="coursedescription" class="form-control" name="coursedescription" type="text"
                                value="{{ $course->description }}" required>
                        </div>
                        <input class="btn btn-primary" type="submit" value="Update">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection