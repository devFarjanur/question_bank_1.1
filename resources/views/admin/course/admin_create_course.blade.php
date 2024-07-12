@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Course</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Course</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create Course Name</h4>

                    <form method="POST" action="{{ route('admin.course.store') }}" enctype="multipart/form-data">
                        @csrf 
                        <div class="mb-3">
                            <label for="name" class="form-label">Course Name:</label>
                            <input id="name" class="form-control" name="coursename" type="text">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Course Description:</label>
                            <textarea id="description" class="form-control" name="coursedescription" style="height: 200px;"></textarea>
                        </div>

                        <input class="btn btn-primary" type="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
