@extends('student.student_dashboard')

@section('student')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Exams</a></li>
        </ol>
    </nav>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
        @foreach($exams as $exam)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <a href="{{ $exam->questioncategory_id === 1 ? route('student.mcq.exam', ['id' => $exam->id]) : route('student.blooms.exam', ['id' => $exam->id]) }}" class="text-decoration-none">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div class="text-center mt-3">
                                <h5 class="card-title" style="font-size: 22px;">{{ $exam->exam_name }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted" style="font-size: 16px;">{{ $exam->questionChapter->name }}</h6>
                                <h6 class="card-subtitle mb-2 text-muted" style="font-size: 16px;">{{ $exam->questionCategory->name }}</h6>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

</div>

@endsection
