@extends('student.student_dashboard')
@section('student')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Exam</a></li>
            <li class="breadcrumb-item active" aria-current="page">BLOOMS Exam</li>
        </ol>
    </nav>

    <div class="mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card pb-5">
                    <div class="card-body pt-5 px-5">
                        <h5 class="card-title text-primary text-center" style="font-size: 22px;">{{ $questionchapter->name }}</h5>

                        <form method="POST" action="{{ route('student.blooms.exam.submit', $exam->id) }}" enctype="multipart/form-data">
                            @csrf 

                            <input type="hidden" name="course_id" value="{{ $courseId }}">
                            <input type="hidden" name="questioncategory_id" value="{{ $questionCategoryId }}">
                            <input type="hidden" name="questionchapter_id" value="{{ $questionchapter->id }}">

                            @php $prevQuestionDescription = null; @endphp
                            @foreach($questions as $taxonomy => $taxonomyQuestions)
                                @foreach($taxonomyQuestions as $key => $question)
                                    @if($question->question_description !== $prevQuestionDescription)
                                        <h3 class='mt-5 mb-4' style="font-size: 22px;">{{ $question->question_description }}</h3>
                                        @php $prevQuestionDescription = $question->question_description; @endphp
                                    @endif
                                    @if($loop->first || $question->question_description !== $taxonomyQuestions[$key-1]->question_description)
                                        <h4 class='mt-3' style="font-size: 18px;">{{ $taxonomy }}</h4>
                                    @endif
                                    <div class='mt-2'>
                                        <p class="pt-2 px-4" style="font-size: 16px;">
                                            {{ chr(97 + $key) }}) {{ $question->question_text }} [{{ $question->question_mark }}]
                                        </p>
                                    </div>
                                    <div class="answer mt-1 pt-2 px-4">
                                        <input type="hidden" name="bloom_ids[]" value="{{ $question->id }}">
                                        <textarea class="form-control" name="response_answers[]" rows="4" cols="50" placeholder="Question Answer"></textarea>
                                    </div>
                                @endforeach
                            @endforeach

                            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                                <input class="btn btn-primary mt-5" type="submit" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

