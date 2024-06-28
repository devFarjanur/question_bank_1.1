@extends('student.student_dashboard')

@section('student')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Exams</a></li>
        </ol>
    </nav>

    <div class="row row-cols-2 row-cols-md-4">
        @foreach($exams as $exam)
            <div class="col mb-3">
                <a href="{{ $exam->questioncategory_id === 1 ? route('student.mcq.exam', ['id' => $exam->id]) : route('student.blooms.exam', ['id' => $exam->id]) }}" class="card h-100 text-decoration-none">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="text-center align-self-center mt-3">
                            <h5 class="card-title" style="font-size: 22px;">{{ $exam->exam_name }}</h5>
                            <h5 class="card-title" style="font-size: 16px;">{{ $exam->questionChapter->name }}</h5>
                            <h5 class="card-title" style="font-size: 16px;">{{ $exam->questionCategory->name }}</h5>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

</div>

@endsection