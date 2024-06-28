@extends('courseteacher.courseteacher_dashboard')

@section('courseteacher')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Exams</a></li>
        </ol>
    </nav>

    <div class=" mb-3 d-grid gap-2 d-md-flex justify-content-md-end">
        <a href="{{ route('course.teacher.exam.create') }}" class="btn btn-primary">Create Exam</a>
    </div>

    <div class="row row-cols-2 row-cols-md-4">
        @foreach($exams as $exam)
            <div class="col mb-3">
                <div class="card h-100 text-decoration-none">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="text-center align-self-center mt-3">
                            <h5 class="card-title" style="font-size: 22px;">{{ $exam->exam_name }}</h5>
                            @if ($exam->questionChapter)
                                <h5 class="card-title" style="font-size: 16px;">{{ $exam->questionChapter->name }}</h5>
                            @else
                                <h5 class="card-title" style="font-size: 18px;">No Chapter Assigned</h5>
                            @endif
                            @if ($exam->questionCategory)
                                <h5 class="card-title" style="font-size: 16px;">{{ $exam->questionCategory->name }}</h5>
                            @else
                                <h5 class="card-title" style="font-size: 18px;">No Question Category Assigned</h5>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-center mt-3 gap-2">
                        <a href="{{ route('course.teacher.exam.edit', $exam->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('course.teacher.exam.delete', $exam->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </div>
            </div>

        @endforeach
    </div>

</div>
@endsection