@extends('courseteacher.courseteacher_dashboard')
@section('courseteacher')




@extends('courseteacher.courseteacher_dashboard')
@section('courseteacher')

<div class="page-content">
  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Exam</a></li>
      <li class="breadcrumb-item active" aria-current="page">Create Exam</li>
    </ol>
  </nav>

  <div class="row">
    <div class="col-12 stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Student Exam List</h4>
          <form method="post" action="#">

            @csrf

            @php $prevQuestionDescription = null; @endphp
                @foreach($questions as $taxonomy => $taxonomyQuestions)
                    @foreach($taxonomyQuestions as $key => $question)
                        @if($question->question_description !== $prevQuestionDescription)
                            <h3 class='mt-5 mb-4'>{{ $question->question_description }}</h3>
                                @php $prevQuestionDescription = $question->question_description; @endphp
                                @endif
                                @if($loop->first || $question->question_description !== $taxonomyQuestions[$key-1]->question_description)
                                    <h4 class='mt-3'>{{ $taxonomy }}</h4>
                                @endif
                    <div class='mt-1'>
                        <p class="pt-2 px-4" style="font-size: 16px;">
                            {{ chr(97 + $key) }}) {{ $question->question_text }} [{{ $question->question_mark }}]
                        </p>
                    </div>


                    <div class='mt-1'>
                        @foreach($bloomsresponces as $response)
                            @if($response->question_id == $question->id)
                                <p class="pt-2 px-4" style="font-size: 16px;">Response: {{ $response->response_answer }}</p>
                            @endif
                        @endforeach
                    </div>



                @endforeach
            @endforeach



            <button type="submit" class="btn btn-primary mt-3">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection






@endsection