@extends('student.student_dashboard')
@section('student')



<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Exam</a></li>
            <li class="breadcrumb-item active" aria-current="page">MCQ Exam</li>
        </ol>
    </nav>

    <div class="row">

        <div class="card mb-3">
            <div class="card-body pt-5 px-5">
                <h5 class="card-title text-primary text-center" style="font-size: 18px;">{{ $questionchapter->name }}</h5>
            </div>
        </div>


        @foreach($mcqs as $mcq)

        <div class="col-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4>{{ $mcq->question_text }}</h4>
                    <form>
                        <div class="form-check pt-2">
                            <input class="form-check-input" type="radio" name="option" id="option_a" value="A">
                            <label class="form-check-label" for="option_a">
                                A: {{ $mcq->option_a }}
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="option" id="option_b" value="B">
                            <label class="form-check-label" for="option_b">
                                B: {{ $mcq->option_b }}
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="option" id="option_c" value="C">
                            <label class="form-check-label" for="option_c">
                                C: {{ $mcq->option_c }}
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="option" id="option_d" value="D">
                            <label class="form-check-label" for="option_d">
                                D: {{ $mcq->option_d }}
                            </label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach


        <input class="btn btn-primary" type="submit" value="Submit">
    </div>
</div>





@endsection