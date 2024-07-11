@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Course</a></li>
            <li class="breadcrumb-item active" aria-current="page">Course Name</li>
        </ol>
    </nav>

    <div class="mb-3 d-grid gap-2 d-md-flex justify-content-md-end">
        <a href="{{ route('admin.course.create') }}" class="btn btn-primary btn-lg">Create Course</a>
    </div>

    <div class="row row-cols-2 row-cols-md-4">
        @foreach($courses as $course)
            <div class="col mb-3">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="text-center align-self-center mt-3">
                            <h5 class="card-title" style="font-size: 22px;">{{ $course->name }}</h5>
                        </div>
                        <div class="d-flex justify-content-center mt-3 gap-2">
                            <a href="{{ route('admin.course.edit', $course->id) }}" class="btn btn-warning btn-lg">Edit</a>
                            <form action="{{ route('admin.course.delete', $course->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-lg">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
