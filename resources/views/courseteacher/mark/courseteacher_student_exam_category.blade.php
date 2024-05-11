@extends('courseteacher.courseteacher_dashboard')
@section('courseteacher')


<div class="page-content">

<nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Question</a></li>
            <li class="breadcrumb-item active" aria-current="page">Question Category</li>
        </ol>
    </nav>




<div class="row row-cols-2 row-cols-md-4">
  @foreach($exams as $exam)
    <div class="col mb-3">
      <a href="{{ route('course.teacher.student.exam.list', $exam->id) }}" class="card h-100 text-decoration-none">
        <div class="card-body d-flex flex-column justify-content-between">
          <div class="text-center align-self-center mt-3"> <!-- Center the content horizontally and vertically -->
            <h5 class="card-title" style="font-size: 24px;">{{ $exam->exam_name }}</h5>
            <h5 class="card-title" style="font-size: 16px;">{{ $exam->questionCategory->name }}</h5>
          </div>
          <div>
            <!-- You can optionally place content or buttons here -->
          </div>
        </div>
      </a>
    </div>
  @endforeach
</div>




</div>



@endsection
