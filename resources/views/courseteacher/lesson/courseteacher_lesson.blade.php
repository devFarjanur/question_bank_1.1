@extends('courseteacher.courseteacher_dashboard')
@section('courseteacher')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Course</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $assignedCourse->name }}</li>
        </ol>
    </nav>
    <div class="mb-3 d-grid gap-2 d-md-flex justify-content-md-end">
        <a href="{{ route('course.teacher.lesson.create', $assignedCourse) }}" class="btn btn-primary btn-lg">Add Lesson</a>
    </div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
        @if(isset($lessons) && $lessons->count() > 0)
            @foreach($lessons as $lesson)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <a href="{{ route('course.teacher.lesson.show', $lesson) }}" class="text-decoration-none">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div class="mt-3">
                                    <h4 class="card-title text-center" style="font-size: 18px">{{ $lesson->title }}</h4>
                                </div>
                            </div>
                        </a>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <small class="text-muted" style="font-size: 16px;">Lesson {{ $loop->iteration }}</small>
                            <div class="btn-group gap-2">
                                <a href="{{ route('course.teacher.lesson.edit', $lesson) }}" class="btn btn-warning btn-lg">Edit</a>
                                <form action="{{ route('course.teacher.lesson.delete', $lesson) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-lg">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="alert alert-warning text-center" role="alert">
                    No lessons found
                </div>
            </div>
        @endif
    </div>
</div>

@endsection
