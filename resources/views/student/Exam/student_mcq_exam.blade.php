@extends('student.student_dashboard')

@section('student')



<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Exam</a></li>
            <li class="breadcrumb-item active" aria-current="page">MCQ Exam</li>
        </ol>
    </nav>

    <div class="card row">
        <div class="mb-3">
            <div class="card-body pt-5 px-5">
                <h5 class="card-title text-primary text-center" style="font-size: 18px;">{{ $questionchapter->name }}</h5>
            </div>
        </div>

        <form method="POST" action="{{ route('student.mcq.exam.submit', $exam->id) }}" enctype="multipart/form-data">
            @csrf

        <!-- Include hidden input fields for necessary data -->
        <input type="hidden" name="course_id" value="{{ $courseId }}">
        <input type="hidden" name="questioncategory_id" value="{{ $questionCategoryId }}">
        <input type="hidden" name="questionchapter_id" value="{{ $questionchapter->id }}">




            @foreach($mcqs as $mcq)
            <div class="col-12 stretch-card">
                <div>
                    <div class="card-body">
                        <h4 style="font-size: 20px;">{{ $mcq->question_text }}</h4>

                        <div class="form-check pt-3">
                        <input class="form-check-input" type="radio" name="option[{{ $mcq->id }}]" id="option_a{{ $mcq->id }}" value="A">
                        <label class="form-check-label" for="option_a{{ $mcq->id }}">
                                A: {{ $mcq->option_a }}
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="option[{{ $mcq->id }}]" id="option_b{{ $mcq->id }}" value="B">
                            <label class="form-check-label" style="font-size: 16px;" for="option_b{{ $mcq->id }}">
                                B: {{ $mcq->option_b }}
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="option[{{ $mcq->id }}]" id="option_c{{ $mcq->id }}" value="C">
                            <label class="form-check-label" style="font-size: 16px;" for="option_c{{ $mcq->id }}">
                                C: {{ $mcq->option_c }}
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="option[{{ $mcq->id }}]" id="option_d{{ $mcq->id }}" value="D">
                            <label class="form-check-label" style="font-size: 16px;" for="option_d{{ $mcq->id }}">
                                D: {{ $mcq->option_d }}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="col-12">
                <div class="card-body">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <button type="submit" class="btn btn-primary mb-2">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
