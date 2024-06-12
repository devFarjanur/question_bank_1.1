@extends('courseteacher.courseteacher_dashboard')
@section('courseteacher')



<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Course</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $course->name }}</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add Lesson to {{ $course->name }}</h4>
                    <form method="POST" action="{{ route('course.teacher.lesson.store', $course) }}">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Lesson Title:</label>
                            <input id="title" class="form-control" name="title" type="text" required>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Lesson Content:</label>
                            <textarea id="content" class="form-control" name="content" rows="5" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="video_url" class="form-label">Video URL:</label>
                            <input id="video_url" class="form-control" name="video_url" type="url">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Lesson</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection