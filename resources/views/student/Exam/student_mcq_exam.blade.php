@extends('student.student_dashboard')
@section('student')


<div class="page-content">

<div class="page-content">

<div class="row">

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title text-primary text-center" style="font-size: 22px;">{{ $questionchapter->name }}</h5>
        </div>
    </div>

    <div class="col-12 stretch-card">
        <div class="card px-5 pb-4">
            <div class="card-body">
            <form method="POST" action="#" enctype="multipart/form-data">
                @csrf 

                @foreach($questions as $question)
                    <h4 class="pt-5">{{ $question->question_text }}</h4>

                    <div class="form-check pt-2">
                        <input class="form-check-input" type="radio" name="option[{{ $question->id }}]" id="option_a{{ $question->id }}" value="A">
                        <label class="form-check-label" for="option_a{{ $question->id }}">
                            A: {{ $question->option_a }}
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="option[{{ $question->id }}]" id="option_b{{ $question->id }}" value="B">
                        <label class="form-check-label" for="option_b{{ $question->id }}">
                            B: {{ $question->option_b }}
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="option[{{ $question->id }}]" id="option_c{{ $question->id }}" value="C">
                        <label class="form-check-label" for="option_c{{ $question->id }}">
                            C: {{ $question->option_c }}
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="option[{{ $question->id }}]" id="option_d{{ $question->id }}" value="D">
                        <label class="form-check-label" for="option_d{{ $question->id }}">
                            D: {{ $question->option_d }}
                        </label>
                    </div>
                @endforeach

                <div class='mt-4'>
                    <input class="btn btn-primary text-primary" type="submit" value="Submit">
                </div>
                </form>

            </div>
        </div>
    </div>
</div>
</div>
@endsection

</div>


@endsection