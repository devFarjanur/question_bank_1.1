@extends('courseteacher.courseteacher_dashboard')
@section('courseteacher')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Question</a></li>
            <li class="breadcrumb-item active" aria-current="page">Question Lesson Name</li>
        </ol>
    </nav>

    <div class="mb-3 d-grid gap-2 d-md-flex justify-content-md-end">
        <a href="{{ route('course.teacher.question.add.chapter', $category->id) }}" class="btn btn-primary">Add Question Lesson Name</a>
    </div>

    <div class="row row-cols-2 row-cols-md-4">
        @foreach($questionchapters as $questionchapter)
        <div class="col mb-3">
            <div class="card h-100">
                <a href="{{ $questionchapter->questioncategory_id == 1 ? route('course.teacher.mcq', ['chapterId' => $questionchapter->id]) : route('course.teacher.blooms', ['chapterId' => $questionchapter->id]) }}" class="card h-100 text-decoration-none">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="text-center align-self-center mt-3">
                            <h5 class="card-title" style="font-size: 22px;">{{ $questionchapter->name }}</h5>
                        </div>
                    </div>
                </a>
                <div class="card-footer d-flex justify-content-center mt-3 gap-2">
                    <a href="{{ route('course.teacher.question.chapter.edit', $questionchapter->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('course.teacher.question.chapter.delete', $questionchapter->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-lg">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
