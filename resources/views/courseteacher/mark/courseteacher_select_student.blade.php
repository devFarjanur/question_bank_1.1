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
          <form id="student_search_form" method="GET" action="{{ route('course.teacher.student.mark.blooms')}}">

            @csrf

            <div class="form-group mb-3">
                <label for="question_category" class="form-label">Select Question Category:</label>
                <select class="form-control" id="question_category" name="questioncategory_id" required>
                    <option value="" selected disabled>-- Select Question Category --</option>
                    @foreach($questioncategories as $questioncategory)
                        <option value="{{ $questioncategory->id }}">{{ $questioncategory->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="exam" class="form-label">Select Exam:</label>
                <select class="form-control" id="exam" name="exam_id" required>
                    <option value="" selected disabled>-- Select Exam --</option>
                    @foreach($exams as $exam)
                        <option value="{{ $exam->id }}">{{ $exam->exam_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3" id="student-dropdown">
                <label for="student" class="form-label">Select Student:</label>
                <select class="form-control" id="student" name="student_id" required>
                    <option value="" selected disabled>-- Select Student --</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
